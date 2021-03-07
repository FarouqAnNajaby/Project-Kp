<?php

namespace App\DataTables\Admin\Barang;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use App\Models\Barang;

class HistoryDataTable extends DataTable
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
				return '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Detail" href="' . route('admin.barang.history.show', $query->uuid) . '">
							<i class="fas fa-eye"></i>
						</a>';
			})
			->rawColumns(['action' => 'action'])
			->editColumn('created_at', function ($query) {
				return $query->created_at->isoFormat('dddd, Do MMMM YYYY');
			})
			->editColumn('stok_awal', function ($query) {
				return number_format($query->stok_awal, 0, '', '.');
			})
			->editColumn('harga', function ($query) {
				return 'Rp' . number_format($query->harga, 2, ',', '.');
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\Barang\History $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Barang $model)
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
			->setTableId('history-table')
			->columns($this->getColumns())
			->minifiedAjax()
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
				->printable(false)
				->exportable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('nama')
				->title('Nama Barang'),
			Column::make('stok_awal'),
			Column::make('harga')->title('Harga Satuan'),
			Column::make('created_at')
				->title('Tanggal Input'),
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
		return 'Admin-History Barang-' . date('YmdHis');
	}
}
