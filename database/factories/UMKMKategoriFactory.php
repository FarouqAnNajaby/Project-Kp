<?php

namespace Database\Factories;

use App\Models\UMKMKategori;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

class UMKMKategoriFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = UMKMKategori::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$this->faker->addProvider(new Commerce($this->faker));
		return [
			'nama' => $this->faker->unique()->department
		];
	}
}
