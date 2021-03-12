<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BarangHistory;
use App\Models\Barang;

class HistoryBarangFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = BarangHistory::class;

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
