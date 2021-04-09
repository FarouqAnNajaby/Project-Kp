<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\TransaksiBarang;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($kode)
	{
		$user = Auth::user();
		$transaksi = Transaksi::where('uuid_user', $user->uuid)->where('kode', $kode)->firstOrFail();
		$data = $transaksi->TransaksiBarang()->get();
		return view('ecommerce.app.review.index', compact('transaksi', 'data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($kode, $uuid)
	{
		$user = Auth::user();
		$transaksi = Transaksi::where('uuid_user', $user->uuid)->where('kode', $kode)->firstOrFail();
		$data = TransaksiBarang::where('uuid', $uuid)->firstOrFail();
		return view('ecommerce.app.review.create', compact('transaksi', 'data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $kode, $uuid)
	{
		$user = Auth::user();
		$transaksi = Transaksi::where('uuid_user', $user->uuid)->where('kode', $kode)->firstOrFail();
		$data = TransaksiBarang::where('uuid', $uuid)->firstOrFail();
		if ($data->Review()->exists()) {
			$tgl_review = strtotime('+1 week', strtotime($data->Review->created_at));
			if (strtotime(now()) > $tgl_review) {
				abort(403);
			}
		}
		$request->validate([
			'nilai' => 'required|in:1,2,3,4,5',
			'keterangan' => 'nullable|max:200'
		]);

		if ($data->Review()->exists()) {
			$data->Review->update($request->only('nilai', 'keterangan'));

			alert()
				->success('Penilaian Berhasil Diubah', 'Sukses!')
				->persistent('Tutup');
		} else {
			$arr = $request->only('nilai', 'keterangan');
			$arr = Arr::add($arr, 'uuid_user', $user->uuid);
			$arr = Arr::add($arr, 'uuid_barang', $data->uuid_barang);

			$data->Review()->create($arr);

			alert()
				->success('Penilaian Berhasil Dibuat', 'Sukses!')
				->persistent('Tutup');
		}
		return redirect()->route('ecommerce.review.index', $kode);
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
