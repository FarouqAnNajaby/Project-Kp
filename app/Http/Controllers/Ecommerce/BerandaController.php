<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Banner;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = Barang::where('barang.stok', '>', 0)
			->select(['barang.kode', 'barang.slug', 'barang.nama', 'barang.harga', 'barang_foto.file as foto'])
			->join('barang_kategori', 'barang.uuid_barang_kategori', '=', 'barang_kategori.uuid')
			->join('barang_foto', 'barang_foto.uuid_barang', '=', 'barang.uuid')
			->where('barang_foto.is_highlight', 1)
			->orderBy('barang.created_at', 'desc')
			->limit(9)
			->get();
		return view('ecommerce.app.index', compact('data'));
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
	public function update(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->route('admin.index');
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
