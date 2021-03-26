<?php

namespace App\Http\Controllers\Admin\MasterData;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\DataTables\Admin\MasterData\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Rules\Deskripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(BannerDataTable $dataTable)
	{
		return $dataTable->render('admin.app.master-data.banner.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.master-data.banner.create');
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
			'foto' => 'required|mimes:jpg,jpeg,png|image|max:3072',
			'judul' => 'required|string|max:20',
			'deskripsi' => 'required|string|max:100'
		]);

		$logo = Image::make($request->file('foto'))->fit(800)->encode('jpg', 75);
		$nama_file = Str::random(50) . ".jpg";

		Banner::create([
			'foto' => $nama_file,
			'judul' => $request->judul,
			'deskripsi' => $request->deskripsi
		]);

		Storage::disk('banner')->put($nama_file, $logo);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.banner.create');
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
	public function edit(Banner $data)
	{
		$data->foto = 'storage/banner/' . $data->foto;

		return view('admin.app.master-data.banner.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Banner $data)
	{
		$request->validate([
			'foto' => 'sometimes|mimes:jpg,jpeg,png|image|max:3072',
			'judul' => 'required|string|max:20',
			'deskripsi' => 'required|string|max:100'
		]);

		$arr = $request->only('judul', 'deskripsi');

		if ($request->hasFile('foto')) {
			$foto = Image::make($request->file('foto'))->fit(800)->encode('jpg', 75);
			$nama_file = Str::random(50) . ".jpg";
			$arr = Arr::add($arr, 'foto', $nama_file);

			if ($data->foto && Storage::disk('banner')->exists($data->foto)) {
				Storage::disk('banner')->delete($data->foto);
			}
		}

		$data->update($arr);

		if ($request->hasFile('foto')) {
			Storage::disk('banner')->put($nama_file, $foto);
		}

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.banner.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Banner $data)
	{
		$data->delete();

		Storage::disk('banner')->delete($data->foto);

		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.master-data.banner.index');
	}
}
