<?php

namespace Database\Factories;

use App\Models\Barang;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Barang::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$this->faker->addProvider(new Commerce($this->faker));
		return [
			'uuid' => $this->faker->uuid,
			'nama' => $this->faker->productName,
			'stok_awal' => $stok_awal = rand(40, 100),
			'stok_sekarang' => $stok_awal - rand(1, 20),
			'harga' => rand(10000, 50000),
			'uuid_umkm' => $this->faker->uuid,
			'created_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
			'updated_at' => now()
		];
	}
}
