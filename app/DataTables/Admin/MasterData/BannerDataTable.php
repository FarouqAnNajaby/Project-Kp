<?php

namespace App\DataTables\Admin\MasterData;

use App\Models\Banner;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Collective\Html\FormFacade as Form;

class BannerDataTable extends DataTable
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
				$opsi = '<a class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ubah" href="' . route('admin.master-data.banner.edit', $query->uuid) . '">
							<i class="fas fa-pencil-alt"></i>
						</a>';
				$opsi .= Form::open(['route' => ['admin.master-data.banner.destroy', 			$query->uuid], 'method' => 'delete', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
							<i class="fas fa-trash"></i>
						</button>';
				$opsi .= Form::close();

				return $opsi;
			})
			->editColumn('foto', function ($query) {
				return '<img src="' . asset('storage/banner/' . $query->foto) . '" width="40px">';
			})
			->rawColumns(['action', 'foto']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\MasterData\Banner $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Banner $model)
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
			->setTableId('admin-banner-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
						"<\'row\'<\'col-sm-12\'tr>>" + 
						"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(1)
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
			Column::make('foto')
				->title('Foto')
				->sortable(false),
			Column::make('judul'),
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
		return 'Admin-MasterData-Banner-' . date('YmdHis');
	}
}
