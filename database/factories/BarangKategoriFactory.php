<?php

namespace Database\Factories;

use App\Models\BarangKategori;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BarangKategoriFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = BarangKategori::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$this->faker->addProvider(new Commerce($this->faker));
		return [
			'nama' => $slug = $this->faker->department,
			'slug' => Str::slug($slug),
			'is_dropdown' => rand(0, 1)
		];
	}
}
