<?php

namespace App\Http\Controllers\Admin\UMKM;

use Propaganistas\LaravelPhone\PhoneNumber;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\UMKMKategori;
use App\Models\UMKM;
use App\Models\BarangKategori;
use App\Http\Requests\Admin\UMKMRequest;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\UMKM\UMKMListDataTable;
use App\DataTables\Admin\UMKM\DaftarBarangDataTable;

class UMKMController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(UMKMListDataTable $dataTable)
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');
		return $dataTable->render('admin.app.umkm.index', compact('kategori'));
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
	public function store(UMKMRequest $request)
	{
		$validated = $request->validated();

		$nomor_telp = PhoneNumber::make($request->nomor_telp, 'ID')->formatE164();

		$validated = Arr::except($validated, ['nomor_telp', 'syarat_ketentuan', 'kategori']);
		$validated = Arr::add($validated, 'uuid_umkm_kategori', $request->kategori);
		$validated = Arr::add($validated, 'nomor_telp', $nomor_telp);

		$data = UMKM::create($validated);

		alert()
			->success('Data berhasil ditambahkan, Harap unggah logo UMKM.', 'Sukses!')
			->persistent('Tutup');

		return redirect()->route('admin.umkm.edit', $data->uuid);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(DaftarBarangDataTable $dataTable, UMKM $data)
	{
		$kategori = BarangKategori::pluck('nama', 'uuid');
		if (!$data->logo) {
			$data->logo = 'assets/img/umkm-default.png';
		} else {
			$data->logo = 'storage/logo-umkm/' . $data->logo;
		}
		return $dataTable
			->with([
				'uuid' => $data->uuid
			])
			->render('admin.app.umkm.show', compact('data', 'kategori'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(UMKM $data)
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');

		if (!$data->logo) {
			$data->logo = 'assets/img/umkm-default.png';
		} else {
			$data->logo = 'storage/logo-umkm/' . $data->logo;
		}

		return view('admin.app.umkm.edit', compact('data', 'kategori'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UMKMRequest $request, UMKM $data)
	{
		$validated = $request->validated();

		$nomor_telp = PhoneNumber::make($request->nomor_telp, 'ID')->formatE164();

		$validated = Arr::except($validated, ['nomor_telp', 'kategori', 'logo']);
		$validated = Arr::add($validated, 'uuid_umkm_kategori', $request->kategori);
		$validated = Arr::add($validated, 'nomor_telp', $nomor_telp);

		if ($request->hasFile('logo')) {
			$logo = Image::make($request->file('logo'))->resize(215, null)->encode('jpg', 75);
			$nama_file = Str::random(50) . ".jpg";
			$validated = Arr::add($validated, 'logo', $nama_file);

			if ($data->logo && Storage::disk('logo-umkm')->exists($data->logo)) {
				Storage::disk('logo-umkm')->delete($data->logo);
			}
		}

		$data->update($validated);

		if ($request->hasFile('logo')) {
			Storage::disk('logo-umkm')->put($nama_file, $logo);
		}

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.umkm.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(UMKM $data)
	{
		$data->delete();
		$data->Barang()->delete();
		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.umkm.index');
	}
}
