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
           'nama' => '2019',
            ],
            [
           'nama' => '2020',
            ],
            [
           'nama' => '2021',
            ],
            [
           'nama' => "2022",
            ],
            [
            'nama' => "2023",
            ]
        ];

       foreach ($tahun as $t) {
           Tahun::create($t);
       }
    }
}
