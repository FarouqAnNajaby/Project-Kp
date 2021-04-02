<?php

namespace App\Exports\Kasir;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
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
			'Kategori',
			'Stok',
			'Harga',
			'Jumlah Transaksi',
		];
	}

	public function map($row): array
	{
		return [
			$row->kode,
			$row->nama,
			$row->Kategori->nama,
			number_format($row->harga, 0, '', '.'),
			'Rp' . number_format($row->harga, 2, ',', '.'),
			number_format($row->Transaksi()->sum('jumlah'), 0, '', '.'),
		];
	}

	public function query()
	{
		$data = Barang::query()->select('barang.*')->where('uuid_umkm', $this->uuid);
		if ($this->search) {
			$search = $this->search;
			$data = $data->where(function ($query) use ($search) {
				$query->orWhere('barang.kode', 'LIKE', "%$search%")
					->orWhere('barang.nama', 'LIKE', "%$search%")
					->orWhere('barang.stok', $search)
					->orWhere(function ($query) use ($search) {
						$search = preg_replace("/[^0-9,]/", "", $search);
						if (strpos($search, ',')) {
							$search = trim($search, 0);
						}
						$search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
						if (filter_var($search, FILTER_VALIDATE_INT)) {
							$query->orWhere('barang.harga', 'LIKE', "%$search%");
						}
					})
					->orWhere(function ($transaksi) use ($search) {
						$search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
						if (filter_var($search, FILTER_VALIDATE_INT)) {
							$transaksi->whereHas('transaksi',  function (Builder $q) use ($search) {
								$q->select(DB::raw('sum(jumlah)'))
									->havingRaw('sum(jumlah) = ?', [$search]);
							});
						}
					});
			});
		}
		if ($this->kategori) {
			$kategori = $this->kategori;
			$data = $data->where('barang.uuid_barang_kategori', $kategori);
		}
		foreach ($this->orders as $key => $value) {
			foreach ($this->columns as $index => $val) {
				if ($value['column'] == $index) {
					$dir = $this->orders[$key]['dir'];
					if ($this->columns[$index]['name'] == 'kategori.nama') {
						$data = $data->with(['kategori' => function ($query) use ($dir) {
							$query->orderBy('nama', $dir);
						}]);
					} else if ($this->columns[$index]['name'] == 'transaksi') {
						$data = $data->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid')
							->groupBy('uuid_barang')->orderByRaw('SUM(jumlah) ' . $dir);
					} else {
						$data = $data->orderBy($this->columns[$index]['name'], $dir);
					}
				}
			}
		}
		return $data;
	}
}
