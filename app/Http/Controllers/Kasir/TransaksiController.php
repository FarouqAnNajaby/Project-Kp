<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use App\DataTables\Kasir\TransaksiDataTable;

class TransaksiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(TransaksiDataTable $dataTable)
	{
		$bulan = [];
		for ($i = 1; $i <= 12; $i++) {
			$bulan[$i] = strftime('%B', mktime(0, 0, 0, $i));
		}
		$tahun = Transaksi::select(DB::raw('YEAR(created_at) year'))
			->groupBy('year')
			->pluck('year', 'year');

		return $dataTable->render('kasir.app.transaksi.index', compact('bulan', 'tahun'));
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
	public function show($uuid)
	{
		$data = Transaksi::where('jenis', 'online')->where('status', 'pending')->findOrFail($uuid);
		return view('kasir.app.transaksi.show', compact('data'));
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
	public function update(Request $request, $uuid, $status)
	{
		if ($request->status == 'terima') {
			$data = Transaksi::where('jenis', 'online')->where('status', 'pending')->findOrFail($uuid);
			foreach ($data->TransaksiBarang()->get() as $index => $item) {
				if ($item->Barang->stok == 0 || $item->Barang->stok < $item->jumlah) {
					alert()
						->error('Stok pada salah satu barang tidak tersedia.', 'Gagal!')
						->persistent('Tutup');
					return redirect()->back();
				}
			}

			foreach ($data->TransaksiBarang()->get() as $index => $item) {
				$item->Barang->update([
					'stok' => $item->Barang->stok - $item->jumlah
				]);
			}
			$data->update([
				'status' => 'selesai'
			]);

			$link = route('kasir.laporan.whatsapp', $data->uuid);

			alert()
				->success('Transaksi berhasil dikonfirmasi.<br>Untuk mengkonfirmasi transaksi ke whatsapp pelanggan, silahkan klik link <a href="' . $link . '">berikut</a>.', 'Sukses!')
				->html()
				->persistent('Tutup');

			return redirect()->route('kasir.laporan.show', $data->uuid);
		} else if ($request->status == 'tolak') {
			$validator = Validator::make($request->all(), [
				'alasan' => 'required|in:1,2,3'
			]);
			$data = Transaksi::where('status', 'pending')->where('uuid', $uuid)->first();
			if ($validator->fails() || !$data) {
				$data = [
					'msg' => $validator->errors()
				];
				return response()->json($data, 400);
			}
			if ($request->alasan == 1) {
				$alasan = 'stok pada salah satu barang yang Anda beli tidak tersedia';
			} else if ($request->alasan == 2) {
				$alasan = 'bukti transfer yang Anda kirim tidak sesuai';
			} else {
				$alasan = 'jumlah pembayaran yang Anda kirimkan tidak sesuai';
			}
			$text = 'Pelanggan%20terhormat%2C%20kami%20dari%20lamonganmart.com%20mengkonfirmasi%20bahwa%20pesanan%20dengan%20kode%20transaksi%20#' . $data->kode . '%20telah%20kami%20tolak%20karena%20' . $alasan . '.%20Kami%20akan%20mengembalikan%20nominal%20uang%20yang%20anda%20transfer%20ke%20rekening%20Anda%20kembali.%20Terima%20kasih%20dan%20Mohon%20maaf.%0A%0ALamongan%20Mart%20buka%0AHari%20%3A%20Senin%20s%2Fd%20Jumat%0APukul%20%3A%2008.00%20-%2015.00%0A%0ASalam%20%2C%20Admin';
			$response = [
				'msg' => [
					'text' => $text,
					'nomor_telepon' => $data->user->nomor_telepon,
				]
			];
			$data->update([
				'status' => 'batal'
			]);
			return response()->json($response, 200);
		}
		abort(403);
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
