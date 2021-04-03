<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Support\Facades\DB;
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
		$data = Barang::where('barang.stok', '>', 0)
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

		$kategori = Barang::where('barang.stok', '>', 0)
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
		return view('ecommerce.app.produk', compact('data', 'kategori'));
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
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Barang $data)
	{
		return view('ecommerce.app.detail-barang', compact('data'));
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
