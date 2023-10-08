<?php

namespace Database\Seeders;

use App\Models\Tahun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = [
            [
           'tahun' => '2019',
            ],
            [
           'tahun' => '2020',
            ],
            [
           'tahun' => '2021',
            ],
            [
           'tahun' => "2022",
            ],
            [
            'tahun' => "2023",
            ],
            [
            'tahun' => '2024',
            ],
            [
            'tahun' => "2025",
            ],
            [
            'tahun' => "2026",
            ]
        ];

       foreach ($tahun as $t) {
           Tahun::create($t);
       }
    }
}
