<?php

namespace App\Http\Controllers\Admin\MasterData;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Warna;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\MasterData\WarnaBarangDataTable;

class WarnaBarangController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(WarnaBarangDataTable $dataTable)
	{
		return $dataTable->render('admin.app.master-data.warna-barang.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.master-data.warna-barang.create');
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
			'nama' => 'Warna'
		]);

		$slug = Str::slug($request->nama);

		if (Warna::where('slug', $slug)->exists()) {
			return back()->withErrors(['nama' => 'Warna sudah tersedia.'])->withInput();
		}

		Warna::create([
			'nama' => $request->nama,
			'slug' => $slug
		]);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.warna-barang.create');
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
		$data = Warna::findOrFail($uuid);
		return view('admin.app.master-data.warna-barang.edit', compact('data'));
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
		$data = Warna::findOrFail($uuid);

		$request->validate([
			'nama' => 'required|string|max:50'
		], [], [
			'nama' => 'Warna'
		]);

		$slug = Str::slug($request->nama);
		$slug_exists = Warna::where('slug', $slug)->exists();

		if ($slug != $data->slug && $slug_exists) {
			return back()->withErrors(['nama' => 'Warna sudah tersedia.'])->withInput();
		}

		$data->update([
			'nama' => $request->nama,
			'slug' => $slug
		]);

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.warna-barang.edit', $uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uuid)
	{
		$data = Warna::findOrFail($uuid);
		$data->delete();
		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.warna-barang.index');
	}
}
