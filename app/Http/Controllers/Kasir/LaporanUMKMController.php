<?php

namespace App\Http\Controllers\Kasir;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\UMKMKategori;
use App\Models\UMKM;
use App\Models\TransaksiBarang;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;
use App\Exports\Kasir\BarangExport;
use App\DataTables\Kasir\LaporanUMKM\LaporanUMKMDataTable;
use App\DataTables\Kasir\LaporanUMKM\LaporanTransaksiBarangDatatable;
use App\DataTables\Kasir\LaporanUMKM\DetailLaporanUMKMDatatable;

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

		if ($request->action == 'csv') {
			$ext = '.csv';
		} else {
			$ext = '.xlsx';
		}
		$export = new BarangExport($data->uuid, $search, $kategori, $columns, $orders);
		return Excel::download($export, 'Detail Laporan UMKM-' . date('Ymdhis') . $ext);
	}

	public function transaksi(LaporanTransaksiBarangDatatable $dataTable, $uuid_umkm, $uuid)
	{
		$umkm = UMKM::where('uuid', $uuid_umkm)->firstOrFail();
		$barang = Barang::where('uuid', $uuid)->where('uuid_umkm', $umkm->uuid)->firstOrFail();
		return $dataTable
			->with(['uuid' => $uuid])
			->render('kasir.app.laporan-umkm.transaksi', compact('barang', 'umkm'));
	}
}
