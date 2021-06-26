<?php

namespace App\DataTables\Kasir\LaporanUMKM;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Barang;

class DetailLaporanUMKMDatatable extends DataTable
{
	/**
	 * DataTables print preview view.
	 *
	 * @var string
	 */
	protected $printPreview = 'kasir.app.laporan-umkm.print';

	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query)
	{
		$query = $query->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid');
		return datatables()
			->eloquent($query)
			->addColumn('action', function ($query) {
				return '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Daftar Transaksi" href="' . route('kasir.laporan-umkm.transaksi', [$query->uuid_umkm, $query->uuid]) . '">
							<i class="fas fa-list"></i>
						</a>';
			})
			->editColumn('nama', function ($query) {
				return Str::limit($query->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama . '">...</p>');
			})
			->editColumn('terjual', function ($query) {
				return $query->Transaksi()->sum('jumlah');
			})
			->orderColumn('terjual', function ($query, $order) {
				return $query
					->groupBy('uuid_barang')->orderByRaw('SUM(jumlah) ' . $order);
			})
			->editColumn('pendapatan', function ($query) {
				return 'Rp. ' . number_format($query->Transaksi()->sum(DB::raw('harga * jumlah')), 0, '', '.');
			})
			->orderColumn('pendapatan', function ($query, $order) {
				return $query->groupBy('uuid_barang')->orderByRaw('SUM(transaksi_barang.jumlah*transaksi_barang.harga) ' . $order);
			})
			->filterColumn('terjual', function ($query, $keyword) {
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->whereHas('transaksi',  function (Builder $q) use ($keyword) {
						$q->select(DB::raw('sum(jumlah)'))
							->havingRaw('sum(jumlah) = ?', [$keyword]);
					});
				}
			})
			->filterColumn('pendapatan', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->whereHas('transaksi',  function (Builder $q) use ($keyword) {
						$q->select(DB::raw('sum(jumlah*harga)'))
							->havingRaw('sum(jumlah*harga) = ?', [$keyword]);
					});
				}
			})
			->rawColumns(['action', 'nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\DaftarBarang $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Barang $model)
	{
		return $model
			->where('uuid_umkm', $this->uuid)
			->select('barang.*')->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
			->setTableId('detail-laporan-umkm-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orders([[3, 'desc'], [4, 'desc'], [2, 'asc']])
			->buttons(
				Button::make('postExport'),
				Button::make('print'),
				Button::make('reload')
			);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			Column::computed('no', 'No')
				->printable(false)
				->exportable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('kode')
				->title('Kode Barang'),
			Column::make('nama')
				->title('Nama Barang'),
			Column::make('terjual')
				->title('Terjual')
				->addClass('text-center'),
			Column::make('pendapatan')
				->title('Total Pendapatan')
				->addClass('text-center'),
			Column::computed('action', 'Opsi')
				->printable(false)
				->exportable(false)
				->addClass('text-center'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'Admin-UMKM-DaftarBarang' . date('YmdHis');
	}
}
