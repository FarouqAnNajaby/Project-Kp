<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryBarangFactory extends Factory
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
		return [
			'uuid' => $this->faker->uuid,
			'nama' => $this->faker->word(),
			'stock_awal' => rand(1, 100),
			'uuid_umkm' => $this->faker->uuid,
			'created_at' => $this->faker->dateTime(),
			'updated_at' => $this->faker->dateTime()
		];
	}
}
