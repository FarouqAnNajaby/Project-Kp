<?php

namespace App\Http\Controllers\Kasir;

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
		$total = Transaksi::count();

		$bulan = [];
		for ($i = 1; $i <= 12; $i++) {
			$bulan[$i] = strftime('%B', mktime(0, 0, 0, $i));
		}
		$tahun = Transaksi::select(DB::raw('YEAR(created_at) year'))
			->groupBy('year')
			->pluck('year', 'year');

		return $dataTable->render('kasir.app.laporan.index', compact('bulan', 'tahun', 'pending', 'selesai', 'total'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Transaksi $data)
	{
		return view('kasir.app.laporan.print', compact('data'));
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
	public function show(Transaksi $data)
	{
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
