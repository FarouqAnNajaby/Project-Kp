<?php

namespace App\Exports\Admin;

use Propaganistas\LaravelPhone\PhoneNumber;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\UMKM;

class UMKMExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
	use Exportable;

	public function headings(): array
	{
		return [
			'Nama UMKM',
			'Kategori UMKM',
			'Nama Pemilik UMKM',
			'Email UMKM',
			'Nomor Telepon UMKM',
			'Alamat UMKM',
		];
	}

	public function map($row): array
	{
		return [
			$row->nama,
			$row->UMKM_Kategori->nama,
			$row->nama_pemilik,
			$row->email,
			PhoneNumber::make($row->nomor_telp)->formatNational(),
			$row->alamat
		];
	}

	public function query()
	{
		return UMKM::query();
	}
}
