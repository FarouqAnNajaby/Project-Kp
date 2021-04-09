<?php

namespace App\Http\Controllers\Ecommerce;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		$data = $user
			->Keranjang()
			->has('barang')->get();
		$total = 0;
		$outOfStock = 0;
		return view('ecommerce.app.keranjang.index', compact('data', 'total', 'outOfStock'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = Auth::user();
		$data = $user
			->select('keranjang.*', 'barang.harga', 'barang.kode', 'barang.slug', 'barang.nama')
			->join('keranjang', 'keranjang.uuid_user', '=', 'users.uuid')
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->get();
		if (!$data->count()) {
			abort(403);
		}
		$total = 0;
		return view('ecommerce.app.keranjang.create', compact('data', 'total'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'bukti_transfer' => 'required|mimes:jpg,jpeg,png|image|max:3072'
		]);
		$user = Auth::user();
		$cart = $user
			->select('barang.uuid as uuid_barang', 'barang.harga', 'keranjang.jumlah', 'keranjang.uuid')
			->join('keranjang', 'keranjang.uuid_user', '=', 'users.uuid')
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->get();

		$total = 0;
		$uuid = [];
		foreach ($cart as $index => $item) {
			$total += $item->jumlah * $item->harga;
			$uuid[$index] = $item->uuid;
		};

		$logo = Image::make($request->file('bukti_transfer'))->encode('jpg', 100);
		$nama_file = Str::random(50) . ".jpg";

		$transaksi = $user->Transaksi()->create([
			'jenis' => 'online',
			'status' => 'pending',
			'total' => $total,
			'foto_bukti' => $nama_file
		]);

		$transaksi->TransaksiBarang()->createMany($cart->toArray());
		$user->Keranjang()->whereIn('uuid', $uuid)->delete();
		Storage::disk('bukti-transfer')->put($nama_file, $logo);

		alert()
			->success('Bukti Pembayaran Berhasil Dikirim.<br>Untuk Informasi Lebih Lanjut akan di Informasikan ke Whatsapp Anda.', 'Sukses!')
			->html()
			->persistent('Tutup');

		return redirect()->route('ecommerce.history.show', $transaksi->kode);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
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
	public function update(Request $request)
	{
		if (!$request->has('uuid')) {
			return response()->json([], 400);
		}
		$user = Auth::user();
		$data = $user
			->select('keranjang.*', 'barang.harga', 'barang.kode', 'barang.slug', 'barang.nama', 'barang.stok')
			->join('keranjang', 'keranjang.uuid_user', '=', 'users.uuid')
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->where('keranjang.uuid', $request->uuid)
			->first();
		if (!$data) {
			return response()->json([], 400);
		}

		$validator = Validator::make($request->all(), [
			'jumlah' => 'required|integer|min:1|max:' . $data->stok,
		], [
			'jumlah.min' => ':Attribute barang minimal :min.',
			'jumlah.max' => 'Stok barang yang tersisa adalah ' . $data->stok . '.'
		]);
		if ($validator->fails()) {
			$response = [
				'msg' => $validator->errors()
			];
			return response()->json($response, 400);
		}
		$data = $user->Keranjang()->where('uuid', $request->uuid)->first();
		$data->update([
			'jumlah' => $request->jumlah
		]);
		$total = 0;
		$keranjang = $user
			->select('keranjang.jumlah', 'barang.harga')
			->join('keranjang', 'keranjang.uuid_user', '=', 'users.uuid')
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->get();
		foreach ($keranjang as $index => $item) {
			$total += $item->jumlah * $item->harga;
		}
		$total = 'Rp' . number_format($total, 2, ',', '.');
		$response = [
			'msg' => [
				'sub_total' => $data->sub_total,
				'total' => $total
			]
		];
		return response()->json($response, 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		if (!$request->has('uuid')) {
			abort(403);
		}
		$uuid = $request->uuid;
		$data = Auth::user()->Keranjang()->where('uuid', $uuid)->firstOrFail();
		$data->delete();
		alert()
			->success('Barang Berhasil Dihapus dari Keranjang.', 'Sukses!')
			->persistent('Tutup');
		return redirect()->route('ecommerce.cart.index');
	}
}
