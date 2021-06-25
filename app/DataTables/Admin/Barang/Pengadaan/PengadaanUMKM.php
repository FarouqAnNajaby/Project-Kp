<?php

namespace App\DataTables\Admin\Barang\Pengadaan;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use App\Models\UMKM;

class PengadaanUMKM extends DataTable
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

				return '<a class="btn btn-icon btn-info mr-1" data-toggle="tooltip" title="Daftar Barang" target="_blank" href="' . route('admin.barang.pengadaan.show', $query->uuid) . '">
						<i class="fas fa-list"></i>
					</a>';
			})
			->editColumn('nama', function ($query) {
				return Str::limit($query->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama . '">...</p>');
			})
			->editColumn('nama_pemilik', function ($query) {
				return Str::limit($query->nama_pemilik, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama_pemilik . '">...</p>');
			})
			->editColumn('count_barang', function ($query) {
				return $query->Barang()->count();
			})
			->orderColumn('count_barang', function ($query, $order) {
				$query->withCount('barang')
					->orderBy('barang_count', $order);
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
			Column::make('nama')
				->title('Nama UMKM'),
			Column::make('umkm_kategori.nama')
				->title('Kategori')
				->searchable(false),
			Column::make('nama_pemilik')
				->title('Pemilik'),
			Column::make('count_barang')
				->title('Jumlah Barang'),
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
