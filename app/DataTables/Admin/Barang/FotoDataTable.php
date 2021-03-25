<?php

namespace App\DataTables\Admin\Barang;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Collective\Html\FormFacade as Form;
use App\Models\BarangFoto;
use App\Models\Barang;

class FotoDataTable extends DataTable
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

				$opsi = Form::open(['route' => ['admin.barang.foto.destroy', [$query->uuid_barang, $query->uuid]], 'method' => 'delete', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
							<i class="fas fa-trash"></i>
						</button>';
				$opsi .= Form::close();

				return $opsi;
			})
			->editColumn('file', function ($query) {
				return '<img src="' . asset('storage/barang/' . $query->file) . '" width="40px">';
			})
			->rawColumns(['action', 'file']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\Barang\GambarDataTable $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(BarangFoto $model)
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
			->setTableId('barang-foto-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
						"<\'row\'<\'col-sm-12\'tr>>" + 
						"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(2, 'desc')
			->buttons(
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
			Column::make('file')
				->title('Foto')
				->orderable(false)
				->searchable(false),
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
		return 'Admin-Barang-Gambar-' . date('YmdHis');
	}
}
