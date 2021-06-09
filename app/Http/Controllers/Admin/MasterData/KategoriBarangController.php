<?php

namespace App\Http\Controllers\Admin\MasterData;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\BarangKategori;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\MasterData\KategoriBarangDataTable;

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
	public function edit(BarangKategori $data)
	{
		return view('admin.app.master-data.kategori-barang.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, BarangKategori $data)
	{
		$request->validate([
			'nama'        => 'required|string|max:50',
			'is_dropdown' => 'required|in:ya,tidak'
		], [], [
			'nama'        => 'Kategori Barang',
			'is_dropdown' => 'Dropdown E-Commerce'
		]);

		$arr = $request->only('nama');

		$slug        = Str::slug($request->nama);
		$slug_exists = BarangKategori::where('slug', $slug)->exists();

		if ($slug != $data->slug && $slug_exists) {
			return back()->withErrors(['nama' => 'Kategori barang sudah tersedia.'])->withInput();
		} else if ($slug != $data && !$slug_exists) {
			$arr = Arr::add($arr, 'slug', $slug);
		}

		$count_dropdown = BarangKategori::where('is_dropdown', 1)->count();
		if ($count_dropdown == 3 && $request->is_dropdown == 'ya') {
			alert()
				->error('Maksimal hanya boleh 3 kategori barang pada menu dropdown.', 'Gagal!')
				->persistent('Tutup');
		} else {
			$dropdown = $request->is_dropdown == 'ya' ? 1 : 0;
			$arr = Arr::add($arr, 'is_dropdown', $dropdown);

			$data->update($arr);
			alert()
				->success('Data berhasil diubah', 'Sukses!')
				->persistent('Tutup')
				->autoclose(3000);
		}


		return redirect()->route('admin.master-data.kategori-barang.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(BarangKategori $data)
	{
		if ($data->Barang()->count()) {
			alert()
				->error('Terdapat barang pada kategori ini.<br/>Harap ubah kategori pada barang terkait terlebih dahulu.', 'Gagal!')
				->html()
				->persistent('Tutup');
		} else {
			$data->delete();
			alert()
				->success('Data berhasil dihapus', 'Sukses!')
				->persistent('Tutup')
				->autoclose(3000);
		}

		return redirect()->route('admin.master-data.kategori-barang.index');
	}
}
