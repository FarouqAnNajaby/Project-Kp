<?php

namespace App\Exports\Admin\Barang;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Barang;

class BarangExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
	use Exportable;

	public function __construct($uuid, $search = null, $kategori = null)
	{
		$this->uuid = $uuid;
		$this->search = $search;
		$this->kategori = $kategori;
	}

	public function headings(): array
	{
		return [
			'Kode Barang',
			'Nama Barang',
			'Kategori',
			'Stok',
			'Harga',
			'UMKM'
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
			$row->UMKM->nama
		];
	}

	public function query()
	{
		$data = Barang::query()->where('stok', '>', 10);
		if ($this->search) {
			$search = $this->search;
			$data = $data->where(function ($query) use ($search) {
				$query->orWhere('kode', 'LIKE', "%$search%")
					->orWhere('nama', 'LIKE', "%$search%")
					->orWhere('stok', $search)
					->orWhere(function ($query) use ($search) {
						$search = preg_replace("/[^0-9,]/", "", $search);
						if (strpos($search, ',')) {
							$search = trim($search, 0);
						}
						$search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
						if (filter_var($search, FILTER_VALIDATE_INT)) {
							$query->orWhere('harga', 'LIKE', "%$search%");
						}
					});
			});
		}
		if ($this->kategori) {
			$kategori = $this->kategori;
			$data = $data->where('uuid_barang_kategori', $kategori);
		}
		return $data;
	}
}
