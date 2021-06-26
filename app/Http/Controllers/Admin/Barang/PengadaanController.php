<?php

namespace App\Http\Controllers\Admin\Barang;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\HumanName;
use App\Rules\FilteredNumeric;
use App\Models\UMKMKategori;
use App\Models\UMKM;
use App\Models\BarangKategori;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\Barang\Pengadaan\PengadaanUMKM;
use App\DataTables\Admin\Barang\Pengadaan\PengadaanBarang;

class PengadaanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(PengadaanUMKM $dataTable)
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');
		return $dataTable->render('admin.app.barang.pengadaan.index', compact('kategori'));
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
	public function show(PengadaanBarang $dataTable, UMKM $data)
	{
		$ktBarang = $data->Barang()->groupBy('uuid_barang_kategori')->pluck('uuid_barang_kategori');
		$kategori = BarangKategori::whereIn('uuid', $ktBarang)->pluck('nama', 'uuid');
		return $dataTable
			->with([
				'uuid' => $data->uuid
			])
			->render('admin.app.barang.pengadaan.show', compact('data', 'kategori'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($uuid_umkm, $uuid_barang)
	{
		$umkm = UMKM::where('uuid', $uuid_umkm)->firstOrFail();
		$data = $umkm->Barang()->where('uuid', $uuid_barang)->firstOrFail();
		return view('admin.app.barang.pengadaan.edit', compact('data', 'umkm'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $uuid_umkm, $uuid_barang)
	{
		$umkm = UMKM::where('uuid', $uuid_umkm)->firstOrFail();
		$data = $umkm->Barang()->where('uuid', $uuid_barang)->firstOrFail();

		$request->validate([
			'tambah_stok'  => ['required', 'numeric', new FilteredNumeric, 'min:1'],
			'nama_pengirim' => ['required', 'string', new HumanName, 'max:100'],
			'foto_bukti'   => 'required|mimes:jpg,jpeg,png|image|max:3072'
		]);

		$auth = Auth::guard('admin')->user();
		$stok_awal = $data->stok;
		$stok = $data->stok + $request->tambah_stok;

		$logo = Image::make($request->file('foto_bukti'))->resize(500,  null, function ($constraint) {
			$constraint->aspectRatio();
		})->encode('jpg', 75);
		$foto_bukti = Str::random(50) . ".jpg";

		$data->update([
			'stok' => $stok
		]);
		$data->log()->create([
			'stok_awal'     => $stok_awal,
			'stok_tambahan' => $request->tambah_stok,
			'harga'         => $data->harga,
			'nama_pengirim'	=> $request->nama_pengirim,
			'foto_bukti'	=> $foto_bukti,
			'admin_uuid'    => $auth->uuid,
			'jenis'			=> 'stock'
		]);

		Storage::disk('foto-bukti')->put($foto_bukti, $logo);

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.pengadaan.show', [$uuid_umkm, $data->uuid]);
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
