<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\DataTables\Admin\MasterData\KategoriBarangDataTable;
use App\Http\Controllers\Controller;
use App\Models\BarangKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBarangController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(KategoriBarangDataTable $dataTable)
	{
		return $dataTable->render('admin.app.master-data.kategori-barang.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.master-data.kategori-barang.create');
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
			'nama' => 'required|string|max:50'
		], [], [
			'nama' => 'Kategori Barang'
		]);

		$slug = Str::slug($request->nama);

		if (BarangKategori::where('slug', $slug)->exists()) {
			return back()->withErrors(['nama' => 'Kategori barang sudah tersedia.'])->withInput();
		}

		BarangKategori::create([
			'nama' => $request->nama,
			'slug' => Str::slug($request->nama)
		]);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.kategori-barang.create');
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
	public function edit($uuid)
	{
		$data = BarangKategori::findOrFail($uuid);
		return view('admin.app.master-data.kategori-barang.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $uuid)
	{
		$data = BarangKategori::findOrFail($uuid);

		$request->validate([
			'nama' => 'required|string|max:50',
			'is_dropdown' => 'nullable|in:ya,tidak'
		], [], [
			'nama' => 'Kategori Barang',
			'is_dropdown' => 'Dropdown E-Commerce'
		]);

		$slug = Str::slug($request->nama);
		$slug_exists = BarangKategori::where('slug', $slug)->exists();

		if ($slug != $data->slug && $slug_exists) {
			return back()->withErrors(['nama' => 'Kategori barang sudah tersedia.'])->withInput();
		}

		$dropdown = $request->is_dropdown == 'ya' ? 1 : 0;

		$data->update([
			'nama' => $request->nama,
			'slug' => $slug,
			'is_dropdown' => $dropdown
		]);

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.kategori-barang.edit', $uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uuid)
	{
		$data = BarangKategori::findOrFail($uuid);
		$data->delete();
		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.kategori-barang.index');
	}
}
