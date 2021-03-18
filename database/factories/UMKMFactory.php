<?php

namespace Database\Factories;

use App\Models\UMKM;
use Illuminate\Database\Eloquent\Factories\Factory;

class UMKMFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = UMKM::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'nama' => $this->faker->unique()->company,
			'alamat' => $this->faker->unique()->address,
			'nama_pemilik' => $this->faker->unique()->name,
			'email' => $this->faker->unique()->safeEmail,
			'nomor_telp' => $this->faker->unique()->phoneNumber,
			'foto' => 'foto.jpg',
		];
	}
}
