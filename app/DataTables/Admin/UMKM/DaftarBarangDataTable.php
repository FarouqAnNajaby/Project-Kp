<?php

namespace App\DataTables\Admin\UMKM;

use App\Models\Admin\UMKM\DaftarBarang;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DaftarBarangDataTable extends DataTable
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
				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Detail" href="' . route('admin.umkm.show', $query->uuid) . '">
						<i class="fas fa-eye"></i>
					</a>';
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\DaftarBarang $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(DaftarBarang $model)
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
			->setTableId('admin\umkm\daftarbarang-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(1)
			->buttons(
				Button::make('create'),
				Button::make('export'),
				Button::make('print'),
				Button::make('reset'),
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
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-center'),
			Column::make('id'),
			Column::make('add your columns'),
			Column::make('created_at'),
			Column::make('updated_at'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'Admin\UMKM\DaftarBarang_' . date('YmdHis');
	}
}
