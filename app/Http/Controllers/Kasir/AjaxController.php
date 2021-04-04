<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
	public function getBarangByKategori(Request $request, $uuid)
	{
		$kategori = BarangKategori::where('uuid', $uuid)->first();
		if ($kategori) {
			$data = Barang::select('nama', 'uuid')
				->where('uuid_barang_kategori', $uuid)
				->where('stok', '>', 0)
				->has('foto');
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

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'cart.*.id' => ['required', Rule::exists('barang', 'uuid')->where(function ($query) {
				$query->where('stok', '>', 0);
			})],
			'cart.*.jumlah' => 'required|integer|min:1',
		]);
		if ($validator->fails()) {
			$data = [
				'msg' => 'Terjadi Kesalahan!'
			];
			return response()->json($data, 400);
		}
		$barang = [];
		$total = 0;
		foreach ($request->cart as $index => $item) {
			$data = Barang::where('uuid', $item['id'])->first();
			$barang[$index]['uuid_barang'] = $data->uuid;
			$barang[$index]['jumlah'] = $item['jumlah'];
			$barang[$index]['harga'] = $data->harga;
			$total += $item['jumlah'] * $data->harga;
		}
		$transaksi = [
			'jenis' => 'offline',
			'status' => 'selesai',
			'total' => $total
		];
		$transaksi = Transaksi::create($transaksi);
		$transaksi->TransaksiBarang()->createMany($barang);

		$response = [
			'msg' => $transaksi
		];

		return response()->json($response, 200);
	}
}
