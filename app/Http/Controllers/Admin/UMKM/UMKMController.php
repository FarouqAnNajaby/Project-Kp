<?php

namespace App\Http\Controllers\Admin\UMKM;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\UMKMKategori;
use App\Models\UMKM;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\UMKM\UMKMListDataTable;

class UMKMController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(UMKMListDataTable $dataTable)
	{
		return $dataTable->render('admin.app.umkm.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');
		return view('admin.app.umkm.create', compact('kategori'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$kategori = UMKMKategori::pluck('uuid');
		$decode_kategori = json_decode($kategori);
		if ($kategori->count() > 1) {

			$kategori = implode(',', $decode_kategori);
		} else {
			$kategori = $decode_kategori[0];
		}

		$request->validate([
			'nama' => 'required|max:100',
			'kategori' => 'required|in:' . $kategori,
			'nama_pemilik' => 'required|max:50',
			'email' => 'required|email',
			'nomor_telp' => 'required|numeric',
			'alamat' => 'required',
			'syarat_ketentuan' => 'required'
		], [
			'syarat_ketentuan.required' => ':Attribute wajib dicentang.',
			'kategori.required' => ':Attribute wajib dipilih.'
		], [
			'nama' => 'Nama UMKM',
			'kategori' => 'Kategori UMKM',
			'nama_pemilik' => 'Nama Pemilik UMKM',
			'email' => 'Email UMKM',
			'nomor_telp' => 'Nomor Telepon',
			'alamat' => 'Alamat UMKM',
			'syarat_ketentuan' => 'Syarat dan Ketentuan'
		]);

		$data = UMKM::create($request->except('kategori', 'syarat_ketentuan') + [
			'uuid_umkm_kategori' => $request->kategori
		]);

		// $data = UMKM::create($request->all());

		alert()
			->success('Data berhasil ditambahkan, Harap unggah logo UMKM.', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.umkm.edit', $data->uuid);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($uuid)
	{
		$data = UMKM::findOrFail($uuid);
		return view('admin.app.umkm.show', compact('data'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($uuid)
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');
		$data = UMKM::findOrFail($uuid);
		return view('admin.app.umkm.edit', compact('data', 'kategori'));
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
		$data = UMKM::findOrFail($uuid);
		$kategori = UMKMKategori::pluck('uuid');
		$decode_kategori = json_decode($kategori);
		if ($kategori->count() > 1) {

			$kategori = implode(',', $decode_kategori);
		} else {
			$kategori = $decode_kategori[0];
		}

		$request->validate([
			'logo' => 'required|mimes:jpg,jpeg,png|image|max:3072',
			'nama' => 'required|max:100',
			'kategori' => 'required|in:' . $kategori,
			'nama_pemilik' => 'required|max:50',
			'email' => 'required|email',
			'nomor_telp' => 'required|numeric',
			'alamat' => 'required'
		], [
			'kategori.required' => ':Attribute wajib dipilih.'
		], [
			'nama' => 'Nama UMKM',
			'kategori' => 'Kategori UMKM',
			'nama_pemilik' => 'Nama Pemilik UMKM',
			'email' => 'Email UMKM',
			'nomor_telp' => 'Nomor Telepon',
			'alamat' => 'Alamat UMKM'
		]);

		$logo = Image::make($request->file('logo'))->fit(215)->encode('jpg', 75);
		$nama_file = Str::random(50) . ".jpg";

		if ($data->logo && Storage::disk('logo-umkm')->exists($data->logo)) {
			Storage::disk('logo-umkm')->delete($data->logo);
		}

		$data->update($request->except('kategori', 'logo') + [
			'uuid_umkm_kategori' => $request->kategori,
			'logo' => $nama_file
		]);

		Storage::disk('logo-umkm')->put($nama_file, $logo);

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.umkm.edit', $uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uuid)
	{
		$data = UMKM::findOrFail($uuid);
		$data->delete();
		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.umkm.index');
	}
}
