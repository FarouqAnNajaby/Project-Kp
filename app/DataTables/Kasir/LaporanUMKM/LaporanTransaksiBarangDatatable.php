<?php

namespace App\DataTables\Kasir\LaporanUMKM;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Models\TransaksiBarang;

class LaporanTransaksiBarangDatatable extends DataTable
{

	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query)
	{
		return datatables()
			->eloquent($query)
			->editColumn('kode', function ($query) {
				return $query->Transaksi->kode;
			})
			->orderColumn('kode', function ($query, $order) {
				$query->whereHas('transaksi',  function (Builder $q) use ($order) {
					$q->orderBy('kode', $order);
				});
			})
			->editColumn('terjual', function ($query) {
				return $query->jumlah;
			})
			->orderColumn('terjual', function ($query, $order) {
				return $query->orderBy('jumlah', $order);
			})
			->editColumn('harga', function ($query) {
				return 'Rp. ' . number_format($query->harga, 0, '', '.');
			})
			->editColumn('total', function ($query) {
				return 'Rp. ' . number_format($query->harga * $query->jumlah, 0, '', '.');
			})
			->orderColumn('total', function ($query, $order) {
				return $query->groupBy('uuid_barang')->orderByRaw('transaksi_barang.jumlah*transaksi_barang.harga ' . $order);
			})
			->editColumn('created_at', function ($query) {
				return Carbon::parse($query->created_at)->isoFormat('dddd, Do MMMM YYYY, hh:mm');
			})
			->filterColumn('kode', function ($query, $keyword) {
				$query->whereHas('transaksi',  function (Builder $q) use ($keyword) {
					$q->where('kode', 'LIKE', "%$keyword%");
				});
			})
			->filterColumn('terjual', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('jumlah', 'LIKE', "%$keyword%");
				}
			})
			->filterColumn('total', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where(DB::raw('jumlah*harga'), 'LIKE', "%$keyword%");
				}
			})
			->filterColumn('harga', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('harga', 'LIKE', "%$keyword%");
				}
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\DaftarBarang $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(TransaksiBarang $model)
	{
		return $model
			->where('uuid_barang', $this->uuid)
			->select('transaksi_barang.*')
			->newQuery();
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
			->ajax([
				'data' => "function(data) {
					data.kategori = $('select[name=kategori]').val();
				}"
			])
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orders([5, 'desc'])
			->buttons(
				Button::make('export'),
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
				->title('Kode Transaksi'),
			Column::make('terjual')
				->title('Terjual')
				->addClass('text-center'),
			Column::make('harga')
				->title('Harga')
				->addClass('text-center'),
			Column::make('total')
				->title('Total')
				->addClass('text-center'),
			Column::make('created_at')
				->title('Tanggal'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'Kasir-UMKM-DaftarTransaksiBarang' . date('YmdHis');
	}
}
