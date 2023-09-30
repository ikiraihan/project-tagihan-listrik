<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = [
            [
           'name' => 'Testing Bang',
           'email' => 'testing@gmail.com',
           'username' => 'Testing',
           'password' => '12345678',
            ],
        ];

       foreach ($tahun as $t) {
           User::create($t);
       }
    }
}
