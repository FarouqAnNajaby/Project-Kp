<?php

namespace App\Exports\Admin\UMKM;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Barang;

class BarangExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
	use Exportable;

	public function __construct($uuid)
	{
		$this->uuid = $uuid;
	}

	public function headings(): array
	{
		return [
			'Kode Barang',
			'Nama Barang',
			'Kategori',
			'Stok',
			'Harga',
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
		];
	}

	public function query()
	{
		return Barang::query()->where('uuid_umkm', $this->uuid);
	}
}
