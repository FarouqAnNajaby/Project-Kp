<?php

namespace App\DataTables\Admin\MasterData;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Collective\Html\FormFacade as Form;
use App\Models\BarangKategori;

class KategoriBarangDataTable extends DataTable
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
				$opsi = '<a class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ubah" href="' . route('admin.master-data.kategori-barang.edit', $query->uuid) . '">
							<i class="fas fa-pencil-alt"></i>
						</a>';
				$opsi .= Form::open(['route' => ['admin.master-data.kategori-barang.destroy', $query->uuid], 'method' => 'delete', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger delete" data-toggle="tooltip" title="Hapus">
							<i class="fas fa-trash"></i>
						</button>';
				$opsi .= Form::close();

				return $opsi;
			})
			->editColumn('is_dropdown', function ($query) {
				return $query->is_dropdown ? 'Ya' : 'Tidak';
			})
			->editColumn('count_barang', function ($query) {
				return number_format($query->Barang()->count(), 0, '', '.');
			})
			->orderColumn('count_barang', function ($query, $order) {
				$query->withCount('barang')
					->orderBy('barang_count', $order);
			})
			->filterColumn('is_dropdown', function ($query, $keyword) {
				$keyword = strtolower($keyword);
				if ($keyword == 'ya') {
					$keyword = 1;
				} else if ($keyword == 'tidak') {
					$keyword = 0;
				}
				if ($keyword === 1 || $keyword === 0) {
					$query->where('is_dropdown', $keyword);
				}
			})
			->rawColumns(['action']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\Kategori $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(BarangKategori $model)
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
			->setTableId('kategori-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orders([[2, 'desc'], [1, 'asc']])
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
			Column::make('nama'),
			Column::make('is_dropdown')
				->title('Dropdown E-Commerce <i class="fad fa-question-circle" data-toggle="tooltip" title="Kategori yang akan ditampilkan pada menu e-commerce."></i>'),
			Column::make('count_barang')
				->title('Jumlah Barang')
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
		return 'Admin-KategoriList-' . date('YmdHis');
	}
}
