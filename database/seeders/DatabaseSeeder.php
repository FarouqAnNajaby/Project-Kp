<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UMKMKategori;
use App\Models\UMKM;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		UMKM::factory()
			->count(10)
			->for(UMKMKategori::factory()->create())
			// ->has(Barang::factory()
			// 	->count(2)
			// 	->for(BarangKategori::factory(10)
			// 		->create()))
			->create();
		// Barang::factory(10)
		// 	->has(BarangLog::factory(1))
		// 	->create();
	}
}
