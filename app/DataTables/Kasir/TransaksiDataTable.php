<?php

namespace App\DataTables\Kasir;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;
use Collective\Html\FormFacade as Form;
use Carbon\Carbon;
use App\Models\Transaksi;

class TransaksiDataTable extends DataTable
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

				$opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Lihat" href="' . route('kasir.transaksi.show', $query->uuid) . '">
						<i class="fas fa-eye"></i>
					</a>';

				$opsi .= Form::open(['route' => ['kasir.transaksi.update', [$query->uuid, 'terima']], 'method' => 'patch', 'class' => 'table-action-column mr-1']);
				$opsi .= '<button class="btn btn-icon btn-success terima" data-toggle="tooltip" title="Terima">
                            <i class="fas fa-check"></i>
                            </button>';
				$opsi .= Form::close();

				$opsi .= '<button class="btn btn-icon btn-danger tolak" data-uuid="' . $query->uuid . '" data-toggle="tooltip" title="Tolak">
                            <i class="fas fa-times"></i>
                            </button>';

				return $opsi;
			})
			->editColumn('user.nama', function ($query) {
				return Str::limit($query->user->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $query->user->nama . '">...</p>');
			})
			->editColumn('total', function ($query) {
				return 'Rp' . number_format($query->total, 2, ',', '.');
			})
			->editColumn('created_at', function ($query) {
				return Carbon::parse($query->created_at)->isoFormat('dddd, Do MMMM YYYY');
			})
			->filterColumn('total', function ($query, $keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$query->where('total', 'LIKE', "%$keyword%");
				}
			})
			->rawColumns(['action', 'user.nama']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Kasir\Transaksi $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Transaksi $model)
	{
		$model = $model->where('jenis', 'online')
			->where('status', 'pending')
			->with('user')
			->select('transaksi.*')
			->newQuery();

		if ($bulan = $this->request()->get('bulan')) {
			$model->whereMonth('transaksi.created_at', $bulan);
		}
		if ($tahun = $this->request()->get('tahun')) {
			$model->whereYear('transaksi.created_at', $tahun);
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
			->setTableId('transaksi-table')
			->columns($this->getColumns())
			->ajax([
				'data' => "function(data) {
					data.bulan = $('select[name=bulan]').val();
					data.tahun = $('select[name=tahun]').val();
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
				->exportable(false)
				->printable(false)
				->addClass('text-center')
				->renderRaw('function (data, type, row, meta) {return meta.row + 1;}'),
			Column::make('kode')->title('Kode Transaksi'),
			Column::make('user.nama')->title('Nama Pembeli'),
			Column::make('total')->title('Total'),
			Column::make('created_at')
				->title('Tanggal')
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
		return 'Kasir\Transaksi_' . date('YmdHis');
	}
}
