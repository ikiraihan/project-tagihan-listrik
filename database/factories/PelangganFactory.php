<?php

namespace Database\Factories;
use App\Models\Pelanggan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{   
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggan::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pelanggan' => $this->faker->randomNumber(9, true),
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
            'daya' => $this->faker->randomElement(['900', '1300', '450', '2000', '4000']),
        ];
    }
}
