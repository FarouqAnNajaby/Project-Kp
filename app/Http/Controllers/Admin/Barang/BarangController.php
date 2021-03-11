<?php

namespace App\Http\Controllers\Admin\Barang;

use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Bezhanov\Faker\Provider\Commerce;
use App\Models\UMKM;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$kategori = [
			'pakaian' => 'Pakaian',
			'minuman' => 'Minuman',
			'makanan' => 'Makanan'
		];

		return view('admin.app.barang.index', compact('kategori'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{

		$umkm = UMKM::pluck('nama', 'uuid');
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return view('admin.app.barang.create', compact('umkm', 'kategori'));
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
	public function show()
	{
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		return view('admin.app.barang.edit');
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
