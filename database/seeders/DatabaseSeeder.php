<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(usersSeeder::class);
        $this->call(playersSeeder::class);
        $this->call(kotalamaSeeder::class);
        $this->call(busesSeeder::class);
        $this->call(citiesSeeder::class);
        $this->call(mapsSeeder::class);
        $this->call(roadsSeeder::class);
    }
}
