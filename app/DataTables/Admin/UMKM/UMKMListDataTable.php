<?php

namespace App\DataTables\Admin\UMKM;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use Collective\Html\FormFacade as Form;
use App\Models\UMKM;

class UMKMListDataTable extends DataTable
{
	/**
	 * DataTables print preview view.
	 *
	 * @var string
	 */
	protected $printPreview = 'admin.app.umkm.print';

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

				$opsi = '<a class="btn btn-icon btn-info mr-1" data-toggle="tooltip" title="Detail" target="_blank" href="' . route('admin.umkm.show', $query->uuid) . '">
						<i class="fas fa-eye"></i>
					</a>';

				$opsi .= '<a class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ubah" href="' . route('admin.umkm.edit', $query->uuid) . '">
							<i class="fas fa-pencil-alt"></i>
						</a>';

				$opsi .= Form::open(['route' => ['admin.umkm.destroy', $query->uuid], 'method' => 'delete', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
							<i class="fas fa-trash"></i>
						</button>';
				$opsi .= Form::close();

				return $opsi;
			})
			->editColumn('nama', function ($query) {
				return Str::limit($query->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama . '">...</p>');
			})
			->editColumn('nama_pemilik', function ($query) {
				return Str::limit($query->nama_pemilik, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama_pemilik . '">...</p>');
			})
			->rawColumns(['action', 'nama_pemilik', 'nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKMList $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(UMKM $model)
	{
		$model = $model->with('umkm_kategori')
			->select('umkm.*')
			->newQuery();
		if ($kategori = $this->request()->get('kategori')) {
			$model->where('uuid_umkm_kategori', $kategori);
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
			->setTableId('umkmlist-table')
			->columns($this->getColumns())
			->ajax([
				'data' => "function(data) {
					data.kategori = $('select[name=kategori]').val();
				}"
			])
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" +
							"<\'row\'<\'col-sm-12\'tr>>" +
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->buttons(
				Button::make('export'),
				Button::make('print'),
				Button::make('reload')
			)
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
			Column::computed('no', 'No')
				->printable(false)
				->exportable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('nama'),
			Column::make('umkm_kategori.nama')->title('Kategori'),
			Column::make('nomor_telp')->title('No Telepon'),
			Column::make('nama_pemilik')->title('Pemilik'),
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
		return 'Admin-Daftar UMKM-' . date('YmdHis');
	}
}
