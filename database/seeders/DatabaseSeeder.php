<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Tahun;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        //Pelanggan::factory(2000)->create();
        //Tagihan::factory(200000)->create();
        $this->call(TahunSeeder::class);
        $this->call(BulanSeeder::class);
        // $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
