<?php

namespace App\DataTables\Admin\UMKM;

use App\Models\Barang;
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
				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Detail" 			href="' . route('admin.umkm.show', $query->uuid) . '">
						<i class="fas fa-eye"></i>
						</a>';

				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Detail" 			href="' . route('admin.umkm.show', $query->uuid) . '">
						<i class="far fa-images"></i>
						</a>';

				return $opsi;
			})
			->rawColumns(['action']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\DaftarBarang $model
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
			->setTableId('daftar-barang-umkm-table')
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
				->printable(false)
				->exportable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('kode')
				->title('Kode Barang'),
			Column::make('nama')
				->title('Nama Barang'),
			Column::make('Harga'),
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
