<?php

namespace App\DataTables\Admin;

use App\Models\UMKM;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Form;

class UMKMListDataTable extends DataTable
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
			->addColumn('opsi', function ($query) {
				$opsi = '<a class="btn btn-icon btn-success" data-toggle="tooltip" title="Detail" href="' . route('admin.umkm.edit', $query->uuid) . '">
							<i class="fas fa-pencil-alt"></i>
						</a>';
				$opsi .= Form::open(['route' => ['admin.umkm.destroy', $query->uuid], 'method' => 'delete', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
							<i class="fas fa-trash"></i>
						</button>';
				$opsi .= Form::close();
				return $opsi;
			})
			->rawColumns(['opsi' => 'opsi']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKMList $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(UMKM $model)
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
			->setTableId('umkmlist-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->parameters([
				'dom' => '"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"',
				'buttons' => [
					'pdf', 'excel', 'print', 'reload'
				],
			])
			->orderBy(1, 'asc');
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'id' => [
				'title' => 'No',
				'orderable' => false,
				'searchable' => false,
				'printable' => false,
				'exportable' => false,
				'render' => function () {
					return 'function (data, type, row, meta) {return meta.row + 1;}';
				}
			],
			Column::make('nama'),
			Column::make('email'),
			Column::make('opsi')
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'Admin-UMKMList-' . date('YmdHis');
	}
}
