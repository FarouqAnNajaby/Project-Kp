<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
	public function getBarangByKategori(Request $request, $uuid)
	{

		$kategori = BarangKategori::where('uuid', $uuid)->first();
		if ($kategori) {

			$data = $kategori->Barang();

			if ($term = $request->has('term')) {
				$data = $data->orWhere('nama', 'LIKE', "%$term%");
			}
			$data = $data->get()
				->map(function ($barang) {
					return ['id' => $barang->uuid, 'text' => $barang->nama];
				})->toArray();

			array_unshift($data, ['id' => '', 'text' => 'Pilih']);
			$status   = 200;
			$response = ['message' => ['data' => $data]];
		} else {
			$status   = 404;
			$response = ['message' => 'Data tidak ditemukan.'];
		}
		return response()->json($response, $status);
	}

	public function getDetailBarang($uuid)
	{
		$barang = Barang::where('uuid', $uuid)->first();

		if ($barang) {

			$foto = $barang->Foto()->get()
				->map(function ($foto) {
					return $foto->file;
				});

			$status   = 200;
			$response = ['message' => ['data' => [
				'nama'		=> $barang->nama,
				'harga'		=> $barang->harga,
				'deskripsi' => $barang->deskripsi,
				'foto'      => $foto
			]]];
		} else {
			$status   = 404;
			$response = ['message' => 'Data tidak ditemukan.'];
		}
		return response()->json($response, $status);
	}
}
