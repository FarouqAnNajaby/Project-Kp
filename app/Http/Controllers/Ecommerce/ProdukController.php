<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$data = Barang::whereHas('umkm', function (Builder $query) {
			$query->whereNull('deleted_at');
		})
			->where('barang.stok', '>', 0)
			->select(['barang.kode', 'barang.slug', 'barang.nama', 'barang.harga', 'barang_foto.file as foto'])
			->join('barang_kategori', 'barang.uuid_barang_kategori', '=', 'barang_kategori.uuid')
			->join('barang_foto', 'barang_foto.uuid_barang', '=', 'barang.uuid')
			->where('barang_foto.is_highlight', 1)
			->when($request->has('keyword'), function ($query) use ($request) {
				$keyword = $request->keyword;
				$query->where('barang.nama', 'LIKE', "%$keyword%");
			})
			->when($request->has('min_price') && $request->has('max_price'), function ($query) use ($request) {
				$min_price = $request->min_price;
				$max_price = $request->max_price;
				$query->whereBetween('barang.harga', [$min_price, $max_price]);
			})
			->when($request->has('kategori'), function ($query) use ($request) {
				$query->where('barang_kategori.slug', $request->kategori);
			})
			->when($request->has('orderby'), function ($query) use ($request) {
				$orderBy = explode('-', $request->orderby);
				$column = $orderBy[0];
				$direction = $orderBy[1];
				if (in_array($column, ['nama', 'harga']) && in_array($direction, ['asc', 'desc'])) {
					$query->orderBy('barang.' . $column, $direction);
				}
			}, function ($query) {
				$query->orderBy('barang.nama', 'asc');
			})
			->orderBy('barang.created_at', 'desc')
			->paginate();

		$kategori = Barang::whereHas('umkm', function (Builder $query) {
			$query->whereNull('deleted_at');
		})
			->where('barang.stok', '>', 0)
			->select([DB::raw('count(barang.uuid_barang_kategori) as total'), 'barang_kategori.nama', 'barang_kategori.slug'])
			->join('barang_kategori', 'barang.uuid_barang_kategori', '=', 'barang_kategori.uuid')
			->whereHas('foto', function (Builder $query) {
				$query->where('barang_foto.is_highlight', 1);
			})
			->when($request->has('keyword'), function ($query) use ($request) {
				$keyword = $request->keyword;
				$query->where('barang.nama', 'LIKE', "%$keyword%");
			})
			->when($request->has('min_price') && $request->has('max_price'), function ($query) use ($request) {
				$min_price = $request->min_price;
				$max_price = $request->max_price;
				$query->whereBetween('barang.harga', [$min_price, $max_price]);
			})
			->when($request->has('kategori'), function ($query) use ($request) {
				$query->where('barang_kategori.slug', $request->kategori);
			})
			->groupBy('barang.uuid_barang_kategori')
			->orderBy('total', 'desc')
			->get();
		return view('ecommerce.app.barang.index', compact('data', 'kategori'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $kode, $slug)
	{
		if (!Auth::check()) {
			$response = [
				'msg' => 'Silahkan login terlebih dahulu.'
			];
			return response()->json($response, 403);
		}
		$data = Barang::whereHas('umkm', function (Builder $query) {
			$query->whereNull('deleted_at');
		})
			->select('barang.*')
			->join('barang_kategori', 'barang.uuid_barang_kategori', '=', 'barang_kategori.uuid')
			->join('barang_foto', 'barang_foto.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->where('barang.kode', $kode)
			->where('barang.slug', $slug)
			->where('barang_foto.is_highlight', 1)
			->first();
		if (!$data) {
			$response = [
				'msg' => 'Data tidak ditemukan.'
			];
			return response()->json($response, 404);
		}
		$validator = Validator::make($request->all(), [
			'quantity' => 'required|integer|min:1|max:' . $data->stok,
		], [
			'quantity.min' => ':Attribute barang minimal :min.',
			'quantity.max' => "Stok barang yang tersisa adalah $data->stok."
		], [
			'quantity' => 'Jumlah'
		]);
		if ($validator->fails()) {
			$response = [
				'msg' => $validator->errors()
			];
			return response()->json($response, 400);
		}

		$user = Auth::user();
		$keranjang = $user->Keranjang();
		if ($keranjang->where('uuid_barang', $data->uuid)->exists()) {
			$item = $keranjang->where('uuid_barang', $data->uuid)->first();
			$quantity = $item->jumlah + $request->quantity;
			if ($quantity > $data->stok) {
				$response = [
					'msg' => 'Jumlah Barang di Keranjang Melebihi Stok.'
				];
				return response()->json($response, 400);
			}
			$item->update([
				'jumlah' => $quantity
			]);
		} else {
			$keranjang->create([
				'jumlah'      => $request->quantity,
				'uuid_barang' => $data->uuid
			]);
		}
		return response()->json([], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($kode, $slug)
	{
		$data = Barang::whereHas('umkm', function (Builder $query) {
			$query->whereNull('deleted_at');
		})
			->select('barang.*')
			->join('barang_kategori', 'barang.uuid_barang_kategori', '=', 'barang_kategori.uuid')
			->join('barang_foto', 'barang_foto.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->where('barang.kode', $kode)
			->where('barang.slug', $slug)
			->where('barang_foto.is_highlight', 1)
			->firstOrFail();
		return view('ecommerce.app.barang.show', compact('data'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
