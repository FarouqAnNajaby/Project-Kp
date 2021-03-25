<?php

namespace App\Http\Controllers\Admin\Barang;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\DataTables\Admin\Barang\FotoDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangFoto;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(FotoDataTable $dataTable, Barang $data)
	{
		return $dataTable->render('admin.app.barang.foto.index', compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Barang $data)
	{
		return view('admin.app.barang.foto.create', compact('data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Barang $data)
	{
		$request->validate([
			'foto' => 'required|mimes:jpg,jpeg,png|image|max:3072'
		]);

		$logo = Image::make($request->file('foto'))->fit(300)->encode('jpg', 75);
		$nama_file = Str::random(50) . ".jpg";

		$data->Foto()->create([
			'file' => $nama_file
		]);

		Storage::disk('barang')->put($nama_file, $logo);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.foto.create', $data->uuid);
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
	public function destroy(Barang $data, $uuid)
	{
		$foto = $data->Foto()->findOrFail($uuid);
		$foto->delete();

		Storage::disk('barang')->delete($foto->file);

		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.foto.index', $data->uuid);
	}
}
