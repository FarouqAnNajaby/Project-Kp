<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\HistoryBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryBarangFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = HistoryBarang::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'uuid' => $this->faker->uuid,
			'uuid_barang' => Barang::factory(),
			'created_at' => $this->faker->dateTimeBetween('-1 week', 'now')
		];
	}
}
