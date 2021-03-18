<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BarangLog;
use App\Models\Barang;

class BarangLogFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = BarangLog::class;

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
