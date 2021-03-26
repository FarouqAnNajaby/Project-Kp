<?php

namespace App\Http\Controllers\Admin\MasterData;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = Banner::paginate();
		return view('admin.app.master-data.banner.index', compact('data'));
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
		if (Banner::count() < 5) {
			$request->validate([
				'foto' => 'required|mimes:jpg,jpeg,png|image|max:3072|dimensions:width=1900,height=700',
				'judul' => 'required|string|min:5|max:20',
				'deskripsi' => 'required|string|min:10|max:100'
			]);


			$logo = Image::make($request->file('foto'))->encode('jpg', 100);
			$nama_file = Str::random(50) . ".jpg";

			$arr = $request->only('judul', 'deskripsi');
			$arr = Arr::prepend($arr, $nama_file, 'foto');

			Banner::create($arr);
			Storage::disk('banner')->put($nama_file, $logo);

			alert()
				->success('Data berhasil ditambahkan', 'Sukses!')
				->persistent('Tutup')
				->autoclose(3000);
		} else {
			alert()
				->error('Maksimal hanya boleh 5 banner.<br/>Harap hapus banner lainnya terlebih dahulu.', 'Gagal!')
				->html()
				->persistent('Tutup');
		}

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
			'foto' => 'sometimes|mimes:jpg,jpeg,png|image|max:3072|dimensions:width=1900,height=700',
			'judul' => 'required|string|min:5|max:20',
			'deskripsi' => 'required|string|min:10|max:100'
		]);

		$arr = $request->only('judul', 'deskripsi');

		if ($request->hasFile('foto')) {
			$foto = Image::make($request->file('foto'))->encode('jpg', 100);
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
		if (Banner::count() > 1) {

			$data->delete();

			Storage::disk('banner')->delete($data->foto);

			alert()
				->success('Data berhasil dihapus', 'Sukses!')
				->persistent('Tutup')
				->autoclose(3000);
		} else {
			alert()
				->error('Minimal terdapat 1 foto banner', 'Gagal!')
				->persistent('Tutup');
		}

		return redirect()->route('admin.master-data.banner.index');
	}
}
