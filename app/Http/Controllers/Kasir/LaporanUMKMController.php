<?php

namespace App\Http\Controllers\Kasir;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\UMKMKategori;
use App\Models\UMKM;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;
use App\Exports\Kasir\BarangExport;
use App\DataTables\Kasir\LaporanUMKMDataTable;
use App\DataTables\Kasir\DetailLaporanUMKMDatatable;

class LaporanUMKMController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(LaporanUMKMDataTable $dataTable)
	{
		$kategori = UMKMKategori::pluck('nama', 'uuid');
		return $dataTable->render('kasir.app.laporan-umkm.index', compact('kategori'));
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
	public function show(DetailLaporanUMKMDatatable $dataTable, UMKM $data)
	{
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return $dataTable
			->with(['uuid' => $data->uuid])
			->render('kasir.app.laporan-umkm.show', compact('data', 'kategori'));
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

	public function export(Request $request, UMKM $data)
	{
		$search = $request->search['value'];
		$kategori = $request->kategori;
		$columns = $request->columns;
		$orders = $request->order;
		// $data = Barang::where('barang.uuid', 'e54a7882-6ac6-4cba-bb91-4c90cc1f74c1')->select('barang.*');
		// foreach ($orders as $key => $value) {
		// 	foreach ($columns as $index => $val) {
		// 		if ($value['column'] == $index) {
		// 			$dir = $orders[$key]['dir'];
		// 			if ($columns[$index]['name'] == 'kategori.nama') {
		// 				$data = $data->with(['kategori' => function ($query) use ($dir) {
		// 					$query->orderBy('nama', $dir);
		// 				}]);
		// 			} else if ($columns[$index]['name'] == 'transaksi') {
		// 				$data = $data->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid')
		// 					->groupBy('uuid_barang')->orderByRaw('SUM(jumlah) ' . $dir);
		// 			} else {
		// 				$data = $data->orderBy($columns[$index]['name'], $dir);
		// 			}
		// 		}
		// 	}
		// }
		// return $data->get();
		if ($request->action == 'csv') {
			$ext = '.csv';
		} else {
			$ext = '.xlsx';
		}
		$export = new BarangExport($data->uuid, $search, $kategori, $columns, $orders);
		return Excel::download($export, 'Detail Laporan UMKM-' . date('Ymdhis') . $ext);
	}
}
