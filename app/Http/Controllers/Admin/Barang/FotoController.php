<?php

namespace App\Http\Controllers\Admin\Barang;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class FotoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Barang $data)
	{
		$foto = $data->Foto()->orderBy('is_highlight', 'desc')->orderBy('created_at', 'desc')->paginate();
		return view('admin.app.barang.foto.index', compact('data', 'foto'));
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
		if ($data->Foto()->count() == 5) {
			alert()
				->error('Maksimal hanya boleh 5 foto barang.', 'Gagal!')
				->persistent('Tutup');
			return redirect()->route('admin.barang.foto.create', $data->uuid);
		}

		$request->validate([
			'foto' => 'required|mimes:jpg,jpeg,png|image|max:3072'
		]);

		$logo = Image::make($request->file('foto'))->resize(500,  null, function ($constraint) {
			$constraint->aspectRatio();
		})->encode('jpg', 75);
		$nama_file = Str::random(50) . ".jpg";

		$highlight = 0;
		if (!$data->Foto()->where('is_highlight', 1)->count()) {
			$highlight = 1;
		}

		$admin = Auth::user();

		$data->Foto()->create([
			'file' => $nama_file,
			'is_highlight' => $highlight,
			'uuid_admin' => $admin->uuid
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
	public function edit(Request $request, Barang $data, $uuid)
	{
		$foto = $data->Foto()->findOrFail($uuid);
		$foto->file = 'storage/barang/' . $foto->file;
		return view('admin.app.barang.foto.edit', compact('data', 'foto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Barang $data, $uuid)
	{
		$foto = $data->Foto()->findOrFail($uuid);

		$request->validate([
			'foto' => 'sometimes|mimes:jpg,jpeg,png|image|max:3072',
			'is_highlight' => 'required|in:0,1'
		], [], [
			'is_highlight' => 'Highlight'
		]);

		$arr = $request->only('is_highlight');

		if ($request->is_highlight == 0 && !$data->Foto()->where('is_highlight', 1)->count()) {

			alert()
				->error('Harus terdapat 1 foto barang sebagai highlight.', 'Gagal!')
				->persistent('Tutup');
			return redirect()->route('admin.barang.foto.edit', [$data->uuid, $foto->uuid])->withInput();
		}

		if ($request->hasFile('foto')) {
			$logo = Image::make($request->file('foto'))->resize(500,  null, function ($constraint) {
				$constraint->aspectRatio();
			})->encode('jpg', 75);
			$nama_file = Str::random(50) . ".jpg";
			$arr = Arr::add($arr, 'file', $nama_file);
		}

		if ($request->is_highlight == 1 && $data->Foto()->where('is_highlight', 1)->count()) {
			$highlight = $data->Foto()->where('is_highlight', 1)->first();
			$highlight->update(['is_highlight' => 0]);
		}

		$foto->update($arr);

		if ($request->hasFile('foto')) {
			Storage::disk('barang')->put($nama_file, $logo);
		}

		alert()
			->success('Data berhasil diubah.', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);
		return redirect()->route('admin.barang.foto.edit', [$data->uuid, $foto->uuid]);
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
		if ($data->Foto()->count() != 1) {
			if ($foto->is_highlight == 0) {
				$foto->delete();
				Storage::disk('barang')->delete($foto->file);
				alert()
					->success('Data berhasil dihapus', 'Sukses!')
					->persistent('Tutup')
					->autoclose(3000);
			} else {
				alert()
					->error('Harus ada 1 foto barang sebagai highlight.', 'Gagal!')
					->persistent('Tutup')
					->autoclose(3000);
			}
		} else {
			alert()
				->error('Minimal terdapat 1 foto barang.', 'Gagal!')
				->persistent('Tutup')
				->autoclose(3000);
		}
		return redirect()->route('admin.barang.foto.index', $data->uuid);
	}
}
