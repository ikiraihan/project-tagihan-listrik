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
            'id_tahun' => $this->faker->randomElement(['1', '2', '3', '4','5']),
            'bulan' => $this->faker->randomElement(['Januari', 'Februari', 'Maret', 'April', 'Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']),
            'KWH' => $this->faker->randomElement(['900', '1300', '450', '2000', '4000']),
            'kelas_tarif' => $this->faker->randomElement(['a', 'b', 'c', 'd', 'e']),
            'total_tagihan' => $this->faker->randomNumber(7, true),
        ];
    }
}
