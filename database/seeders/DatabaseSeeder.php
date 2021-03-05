<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\UMKM;
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
		UMKM::factory(10)->create();
		Barang::factory(10)
			->has(HistoryBarang::factory(1))
			->create();
	}
}
