<?php

namespace App\Exports\Kasir;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TransaksiBarang;
use App\Models\Barang;

class BarangExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
	use Exportable;

	public function __construct($uuid, $search = null, $kategori = null, $columns = null, $orders = null)
	{
		$this->uuid = $uuid;
		$this->search = $search;
		$this->kategori = $kategori;
		$this->columns = $columns;
		$this->orders = $orders;
	}

	public function headings(): array
	{
		return [
			'Kode Barang',
			'Nama Barang',
			'Terjual',
			'Total Pendapatan',
		];
	}

	public function map($row): array
	{
		return [
			$row->kode,
			$row->nama,
			number_format($row->Transaksi()->sum('jumlah'), 0, '', '.'),
			'Rp. ' . number_format($row->Transaksi()->sum(DB::raw('harga * jumlah')), 0, '', '.'),
		];
	}

	public function query()
	{
		$data = Barang::query()
			->where('uuid_umkm', $this->uuid)
			->select('barang.*')->newQuery();

		if ($this->search) {
			$keyword = $this->search;
			$data = $data
				->where(function ($query) use ($keyword) {
					$query
						->orWhere('nama', 'LIKE', "%$keyword%")
						->orWhere('kode', 'LIKE', "%$keyword%")
						->orWhere(function ($q) use ($keyword) {
							$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
							if (filter_var($keyword, FILTER_VALIDATE_INT)) {
								$q->whereHas('transaksi',  function (Builder $qq) use ($keyword) {
									$qq->select(DB::raw('sum(jumlah)'))
										->havingRaw('sum(jumlah) = ?', [$keyword]);
								});
							}
						})
						->orWhere(function ($q) use ($keyword) {
							$keyword = preg_replace("/[^0-9,]/", "", $keyword);
							if (strpos($keyword, ',')) {
								$keyword = trim($keyword, 0);
							}
							$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
							if (filter_var($keyword, FILTER_VALIDATE_INT)) {
								$q->whereHas('transaksi',  function (Builder $qq) use ($keyword) {
									$qq->select(DB::raw('sum(jumlah*harga)'))
										->havingRaw('sum(jumlah*harga) = ?', [$keyword]);
								});
							}
						});
				});
		}
		$data = $data->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid');
		foreach ($this->orders as $key => $value) {
			foreach ($this->columns as $index => $val) {
				if ($value['column'] == $index) {
					$dir = $this->orders[$key]['dir'];
					if ($this->columns[$index]['data'] == 'terjual') {
						$data =  $data->groupBy('transaksi_barang.uuid_barang')->orderByRaw('SUM(jumlah) ' . $dir);
					} else if ($this->columns[$index]['data'] == 'pendapatan') {
						$data = $data->groupBy('transaksi_barang.uuid_barang')->orderByRaw('SUM(transaksi_barang.jumlah*transaksi_barang.harga) ' . $dir);
					} else {
						$data = $data->orderBy($this->columns[$index]['data'], $dir);
					}
				}
			}
		}
		return $data;
	}
}
