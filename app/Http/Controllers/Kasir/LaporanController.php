<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use App\DataTables\Kasir\LaporanTransaksiDataTable;

class LaporanController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(LaporanTransaksiDataTable $dataTable)
	{
		$pending = Transaksi::where('status', 'pending')->count();
		$selesai = Transaksi::where('status', 'selesai')->count();
		$batal = Transaksi::where('status', 'batal')->count();

		$bulan = [];
		for ($i = 1; $i <= 12; $i++) {
			$bulan[$i] = strftime('%B', mktime(0, 0, 0, $i));
		}
		$tahun = Transaksi::select(DB::raw('YEAR(created_at) year'))
			->groupBy('year')
			->pluck('year', 'year');

		return $dataTable->render('kasir.app.laporan.index', compact('bulan', 'tahun', 'pending', 'selesai', 'batal'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Transaksi $data)
	{
		return view('kasir.app.laporan.detail-print', compact('data'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $uuid)
	{
		if ($request->method() == 'POST') {
			$validator = Validator::make($request->all(), [
				'alasan' => 'required|in:1,2,3'
			]);
			$data = Transaksi::where('status', 'batal')->where('uuid', $uuid)->first();
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
					'nomor_telepon' => $data->user->nomor_telepon
				]
			];
			return response()->json($response, 200);
		} else {
			$data = Transaksi::where('status', 'selesai')->findOrFail($uuid);
			$text = 'Pelanggan%20terhormat%2C%20kami%20dari%20lamonganmart.com%20mengkonfirmasi%20bahwa%20pesanan%20dengan%20kode%20transaksi%20#' . $data->kode . '%20telah%20kami%20verifikasi.%20Harap%20datang%20satu%20hari%20setelah%20informasi%20ini%20diberikan%20ke%20lamongan%20mart%20di%20Jl.%20Basuki%20Rahmat%20No.176%2C%20Groyok%2C%20Sukomulyo%2C%20Lamongan%20untuk%20mengambil%20barang%20yang%20anda%20beli.%20Terima%20kasih%20telah%20melakukan%20transaksi.%0A%0ALamongan%20Mart%20buka%0AHari%20%3A%20Senin%20s%2Fd%20Jumat%0APukul%20%3A%2008.00%20-%2015.00%0A%0ASalam%20%2C%20Admin';
			return redirect()->away('whatsapp://send?phone=' . $data->user->nomor_telepon . '&text=' . $text);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($uuid)
	{
		$data = Transaksi::whereIn('status', ['selesai', 'batal'])->where('uuid', $uuid)->firstOrFail();
		return view('kasir.app.laporan.show', compact('data'));
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
	public function destroy($id)
	{
		//
	}
}
