<?php

namespace App\DataTables\Kasir;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Barang;

class DetailLaporanUMKMDatatable extends DataTable
{
	/**
	 * DataTables print preview view.
	 *
	 * @var string
	 */
	protected $printPreview = 'kasir.app.laporan-umkm.print';

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
			->editColumn('transaksi', function ($query) {
				return $query->Transaksi()->sum('jumlah');
			})
			->orderColumn('transaksi', function ($query, $order) {
				return $query->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid')
					->groupBy('uuid_barang')->orderByRaw('SUM(jumlah) ' . $order);
			})
			->filterColumn('transaksi', function ($query, $keyword) {
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->whereHas('transaksi',  function (Builder $q) use ($keyword) {
						$q->select(DB::raw('sum(jumlah)'))
							->havingRaw('sum(jumlah) = ?', [$keyword]);
					});
				}
			})
			->filterColumn('harga', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('barang.harga', 'LIKE', "%$keyword%");
				}
			})
			->rawColumns(['action', 'nama', 'umkm.nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin\UMKM\DaftarBarang $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Barang $model)
	{
		$model = $model
			->where('uuid_umkm', $this->uuid)
			->with('kategori')
			->select('barang.*');

		if ($kategori = $this->request()->get('kategori')) {
			$model->where('uuid_barang_kategori', $kategori);
		}
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
			->setTableId('detail-laporan-umkm-table')
			->columns($this->getColumns())
			->ajax([
				'data' => "function(data) {
					data.kategori = $('select[name=kategori]').val();
				}"
			])
			->dom('"<\'row\'<\'col-sm-12 col-md-2\'l><\'col-sm-12 col-md-5\'B><\'col-sm-12 col-md-5\'f>>" + 
							"<\'row\'<\'col-sm-12\'tr>>" + 
							"<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>"')
			->orders([[6, 'desc'], [4, 'asc'], [2, 'asc']])
			->buttons(
				Button::make('postExport'),
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
			Column::make('nama')->title('Nama Barang'),
			Column::make('kategori.nama')
				->title('Kategori')
				->searchable(false)
				->orderable(false)
				->addClass('text-center'),
			Column::make('stok')
				->addClass('text-center'),
			Column::make('harga')
				->addClass('text-center'),
			Column::make('transaksi')
				->title('Transaksi')
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
