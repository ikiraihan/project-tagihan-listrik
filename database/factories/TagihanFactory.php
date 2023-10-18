<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pelanggan' => $this->faker->numberBetween(0, 300),
            'id_tahun' => $this->faker->randomElement(['1', '2', '3', '4','5','6','7','8','9','10']),
            'id_bulan' => $this->faker->randomElement(['1', '2', '3', '4', '5','6','7','8','9','10','11','12']),
            'KWH' => $this->faker->randomElement(['900', '1300', '450', '2000', '4000']),
            'kelas_tarif' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e']),
            'total_tagihan' => $this->faker->randomNumber(7, true),
        ];
    }
}
