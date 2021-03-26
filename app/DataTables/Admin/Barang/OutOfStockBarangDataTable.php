<?php

namespace App\DataTables\Admin\Barang;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Str;
use App\Models\Barang;

class OutOfStockBarangDataTable extends DataTable
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
				return '<a class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Whatsapp" href="edit_umkm.php"><i class="fab fa-whatsapp"></i></a>';
			})
			->editColumn('nama', function ($query) {
				return Str::limit($query->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->nama . '">...</p>');
			})
			->editColumn('umkm.nama', function ($query) {
				return Str::limit($query->umkm->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->umkm->nama . '">...</p>');
			})
			->editColumn('stok', function ($query) {
				return number_format($query->stok, 0, '', '.');
			})
			->editColumn('harga', function ($query) {
				return 'Rp' . number_format($query->harga, 2, ',', '.');
			})
			->filterColumn('harga', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('harga', 'LIKE', "%$keyword%");
				}
			})
			->rawColumns(['action', 'nama', 'umkm.nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Barang $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Barang $model)
	{
		$model = $model
			->where('stok', '<=', 10)
			->with('umkm')
			->with('kategori')
			->select('barang.*')
			->newQuery();

		if ($kategori = $this->request()->get('kategori')) {
			$model->where('uuid_barang_kategori', $kategori);
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
			->setTableId('list-barang-table')
			->columns($this->getColumns())
			->ajax([
				'data' => "function(data) {
				data.kategori = $('select[name=kategori]').val();
			}"
			])
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
						"<\'row\'<\'col-sm-12\'tr>>" + 
						"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(3, 'ASC');
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
			Column::make('nama')->title('Nama Barang'),
			Column::make('kategori.nama')
				->title('Kategori')
				->searchable(false)
				->addClass('text-center'),
			Column::make('stok')
				->addClass('text-center'),
			Column::make('harga')
				->addClass('text-center'),
			Column::make('umkm.nama')->title('UMKM'),
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
		return 'Admin\Barang\OutOfStockBarang_' . date('YmdHis');
	}
}