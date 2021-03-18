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
			'kode' => $this->faker->regexify('[A-Za-z0-9]{20}'),
			'nama' => $this->faker->productName,
			'stok' => rand(40, 100),
			'harga' => rand(10000, 50000),
			'deskripsi' => $this->faker->paragraph
		];
	}
}
