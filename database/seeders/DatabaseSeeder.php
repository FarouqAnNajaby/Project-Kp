<?php

namespace Database\Seeders;

use App\Models\UMKM;
use App\Models\UMKMKategori;
use Illuminate\Database\Seeder;

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
		// 	->has(HistoryBarang::factory(1))
		// 	->create();
	}
}
