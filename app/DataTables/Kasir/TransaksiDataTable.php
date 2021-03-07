<?php

namespace App\DataTables\Kasir;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Collective\Html\FormFacade as Form;
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

				$opsi .= Form::open(['method' => 'terima', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-success terima" data-toggle="tooltip" title="Terima">
                            <i class="fas fa-check"></i>
                            </button>';

				$opsi .= Form::open(['method' => 'tolak', 'class' => 'table-action-column']);
				$opsi .= '<button class="btn btn-icon btn-danger tolak" data-toggle="tooltip" title="Tolak">
                            <i class="fas fa-times"></i>
                            </button>';

				$opsi .= Form::close();

				return $opsi;
			})
			->rawColumns(['action' => 'action'])
			->editColumn('created_at', function ($query) {
				return $query->created_at->isoFormat('dddd, Do MMMM YYYY');
			})
			->editColumn('total', function ($query) {
				return 'Rp' . number_format($query->total, 2, ',', '.');
			});
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Kasir\Transaksi $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Transaksi $model)
	{
		return $model->with('user')->select('transaksi.*')->newQuery();
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
			->minifiedAjax()
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
			Column::make('user.name')->title('Nama'),
			Column::make('created_at')->title('Tanggal'),
			Column::make('total')->title('Total'),
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
