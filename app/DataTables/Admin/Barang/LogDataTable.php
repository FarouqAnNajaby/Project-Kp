<?php

namespace App\DataTables\Admin\Barang;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\BarangLog;

class LogDataTable extends DataTable
{
	/**
	 * DataTables print preview view.
	 *
	 * @var string
	 */
	protected $printPreview = 'admin.app.barang.log.print';
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
				return '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Detail" href="' . route('admin.barang.log.show', $query->uuid) . '">
							<i class="fas fa-eye"></i>
						</a>';
			})
			->editColumn('barang.nama', function ($query) {
				return Str::limit($query->Barang->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->Barang->nama . '">...</p>');
			})
			->editColumn('stok', function ($query) {
				return number_format($query->stok, 0, '', '.');
			})
			->editColumn('harga', function ($query) {
				return 'Rp' . number_format($query->harga, 2, ',', '.');
			})
			->editColumn('admin.nama', function ($query) {
				return Str::limit($query->Admin->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->Admin->nama . '">...</p>');
			})
			->editColumn('created_at', function ($query) {
				return Carbon::parse($query->created_at)->isoFormat('dddd, Do MMMM YYYY');
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
			->rawColumns(['action', 'barang.nama', 'admin.nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\BarangLog $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(BarangLog $model)
	{
		return $model
			->with('barang')
			->with('admin')
			->select('barang_log.*')
			->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
			->setTableId('log-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orderBy(5, 'desc')
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
			Column::make('barang.nama')
				->title('Nama Barang'),
			Column::make('stok'),
			Column::make('harga')
				->title('Harga Satuan'),
			Column::make('admin.nama')
				->title('Di Inputkan Oleh'),
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
		return 'Admin-Log Barang-' . date('YmdHis');
	}
}
