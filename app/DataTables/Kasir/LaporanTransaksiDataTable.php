<?php

namespace App\DataTables\Kasir;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
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
				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Lihat" href="' . route('kasir.laporan.show', $query->uuid) . '">
						<i class="fas fa-eye"></i>
					</a>';

				return $opsi;
			})
			->rawColumns(['action' => 'action'])
			->editColumn('created_at', function ($query) {
				return $query->created_at->isoFormat('dddd, Do MMMM YYYY');
			})
			->editColumn('total', function ($query) {
				return 'Rp' . number_format($query->total, 2, ',', '.');
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Kasir\LaporanTransaksi $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Transaksi $model)
	{
		return $model->newQuery();
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
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" +
            "<\'row\'<\'col-sm-12\'tr>>" +
            "<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(1)
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
			Column::make('created_at')->title('Tanggal'),
			Column::make('total')->title('Total Pembelian'),
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
		return 'Kasir\LaporanTransaksi_' . date('YmdHis');
	}
}
