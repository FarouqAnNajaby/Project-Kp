<?php

namespace App\DataTables\Kasir;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaksi;

class LaporanTransaksiDataTable extends DataTable
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
			->addColumn('action', function ($query) {
				if ($query->status == 'pending' && $query->jenis == 'online') {
					$url = route('kasir.transaksi.show', $query->uuid);
				} else {
					$url = route('kasir.laporan.show', $query->uuid);
				}
				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Lihat" href="' . $url . '" target="_blank">
					<i class="fas fa-eye"></i>
				</a>';
				return $opsi;
			})
			->editColumn('created_at', function ($query) {
				return Carbon::parse($query->created_at)->isoFormat('dddd, Do MMMM YYYY');
			})
			->editColumn('total', function ($query) {
				return 'Rp' . number_format($query->total, 2, ',', '.');
			})
			->editColumn('status', function ($query) {
				$status = ucfirst($query->status);
				if ($query->status == 'pending') {
					$class = 'badge-warning';
				} else {
					$class = 'badge-success';
				}
				return "<span class=\"badge $class\">$status</span>";
			})
			->filterColumn('total', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9]/", "", trim($keyword, 0));
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('total', 'LIKE', "%$keyword%");
				}
			})
			->rawColumns(['action', 'status']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Kasir\LaporanTransaksi $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Transaksi $model)
	{
		$model = $model->newQuery();
		if ($status = $this->request()->get('status')) {
			$model->where('status', $status);
		}
		if ($bulan = $this->request()->get('bulan')) {
			$model->whereMonth('created_at', $bulan);
		}
		if ($tahun = $this->request()->get('tahun')) {
			$model->whereYear('created_at', $tahun);
		}
		return $model;
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
			->setTableId('laporantransaksi-table')
			->columns($this->getColumns())
			->ajax([
				'data' => "function(data) {
					data.status = $('select[name=status]').val();
					data.bulan = $('select[name=bulan]').val();
					data.tahun = $('select[name=tahun]').val();
				}"
			])
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" +
            "<\'row\'<\'col-sm-12\'tr>>" +
            "<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(4, 'desc')
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
				->exportable(false)
				->printable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('kode')
				->title('Kode Transaksi')
				->addClass('text-center'),
			Column::make('status')
				->searchable(false)
				->addClass('text-center'),
			Column::make('total')
				->title('Total Pembelian')
				->addClass('text-center'),
			Column::make('created_at')
				->searchable(false)
				->title('Tanggal')
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
		return 'Kasir-Laporan Transaksi-' . date('YmdHis');
	}
}
