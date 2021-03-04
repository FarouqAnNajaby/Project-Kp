<?php

namespace Database\Factories;

use App\Models\Kategori;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Kategori::class;

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
			'nama' => $this->faker->department
		];
	}
}
