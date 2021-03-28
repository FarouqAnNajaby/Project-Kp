<?php

namespace App\Exports\Admin\UMKM;

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

	public function __construct($search = null, $kategori = null)
	{
		$this->search = $search;
		$this->kategori = $kategori;
	}

	public function headings(): array
	{
		return [
			'Nama UMKM',
			'Kategori',
			'Nama Pemilik',
			'Email',
			'Nomor Telepon',
			'Alamat',
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
		$data = UMKM::query();
		if ($this->search) {
			$search = $this->search;
			$data = $data->where(function ($query) use ($search) {
				$query->orWhere('nama', 'LIKE', "%$search%")
					->orWhere('nomor_telp', 'LIKE', "%$search%")
					->orWhere('nama_pemilik', 'LIKE', "%$search%");
			});
		}
		if ($this->kategori) {
			$kategori = $this->kategori;
			$data = $data->where('uuid_umkm_kategori', $kategori);
		}
		return $data;
	}
}
