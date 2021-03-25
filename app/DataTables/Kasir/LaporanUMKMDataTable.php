<?php

namespace App\DataTables\Kasir;

use App\Models\UMKM;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaporanUMKMDataTable extends DataTable
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
                $opsi = '<a class="btn btn-icon btn-info" data-toggle="tooltip" title="Lihat" href="' . route('kasir.laporan_umkm.show', $query->uuid) . '">
                            <i class="fas fa-eye"></i>
						</a>';
                return $opsi;
            })
            ->editColumn('nama', function ($query) {
                return $query->nama;
            })
            ->editColumn('nama_pemilik', function ($query) {
                return $query->nama_pemilik;
            })
            ->escapeColumns([])
            ->rawColumns(['action' => 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Kasir\LaporanUMKMDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UMKM $model)
    {
        return $model->with('umkm_kategori')->select('umkm.*')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('laporanumkmdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
        return 'Kasir\LaporanUMKM_' . date('YmdHis');
    }
}
