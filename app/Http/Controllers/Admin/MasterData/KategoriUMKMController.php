<?php

namespace App\Http\Controllers\Admin\MasterData;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UMKMKategori;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\MasterData\KategoriUMKMDataTable;

class KategoriUMKMController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(KategoriUMKMDataTable $dataTable)
	{
		return $dataTable->render('admin.app.master-data.kategori-umkm.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.master-data.kategori-umkm.create');
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
			'nama' => 'Kategori UMKM'
		]);

		$slug = Str::slug($request->nama);

		if (UMKMKategori::where('slug', $slug)->exists()) {
			return back()->withErrors(['nama' => 'Kategori UMKM sudah tersedia.'])->withInput();
		}

		UMKMKategori::create([
			'nama' => $request->nama,
			'slug' => $slug
		]);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.kategori-umkm.create');
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
	public function edit(UMKMKategori $data)
	{
		return view('admin.app.master-data.kategori-umkm.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, UMKMKategori $data)
	{
		$request->validate([
			'nama' => 'required|string|max:50'
		], [], [
			'nama' => 'Kategori UMKM'
		]);

		$slug = Str::slug($request->nama);
		$slug_exists = UMKMKategori::where('slug', $slug)->exists();

		if ($slug != $data->slug && $slug_exists) {
			return back()->withErrors(['nama' => 'Kategori UMKM sudah tersedia.'])->withInput();
		} else if ($slug != $data && !$slug_exists) {
			$data->update([
				'nama' => $request->nama,
				'slug' => $slug
			]);
		}
		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.kategori-umkm.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(UMKMKategori $data)
	{
		if ($data->UMKM()->count()) {
			alert()
				->error('Terdapat UMKM dengan kategori tersebut.<br/>Harap ubah kategori pada UMKM terkait terlebih dahulu.', 'Gagal!')
				->html()
				->persistent('Tutup');
		} else {
			$data->delete();
			alert()
				->success('Data berhasil dihapus', 'Sukses!')
				->persistent('Tutup')
				->autoclose(3000);
		}
		return redirect()->route('admin.master-data.kategori-umkm.index');
	}
}
