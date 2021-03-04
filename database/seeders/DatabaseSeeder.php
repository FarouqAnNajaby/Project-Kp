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
		// UMKM::factory(100)->create();
		Barang::factory(100)->create();
	}
}
