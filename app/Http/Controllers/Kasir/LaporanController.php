<?php

namespace App\Http\Controllers\Kasir;

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
		$total = Transaksi::count();
		$bulan = [
			'jan' => 'Januari',
			'feb' => 'Februari',
			'mar' => 'Maret',
			'apr' => 'April',
			'mei' => 'Mei',
			'jun' => 'Juni',
			'jul' => 'Juli',
			'agu' => 'Agustus',
			'sep' => 'September',
			'okt' => 'Oktober',
			'nov' => 'November',
			'des' => 'Desember'
		];
		$tahun = [];
		$x = 0;
		for ($i = date('Y'); $i > date('Y') - 21; $i--) {
			$tahun[$x++] = $i;
		};
		// return view('kasir.app.laporan.index', compact('bulan', 'tahun'));
		return $dataTable->render('kasir.app.laporan.index', compact('bulan', 'tahun', 'pending', 'selesai', 'total'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
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
		$data = Transaksi::findOrFail($uuid);
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
