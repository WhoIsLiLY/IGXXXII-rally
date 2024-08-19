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
        //kotalama
        $this->call(kotalamaSeeder::class);
        $this->call(busesSeeder::class);
        $this->call(citiesSeeder::class);
        $this->call(mapsSeeder::class);
        $this->call(roadsSeeder::class);
        //tugupahlawan
        $this->call(tupalsSeeder::class);
        $this->call(stands_adsSeeder::class);
        $this->call(players_ads_standsSeeder::class);
        $this->call(loketsSeeder::class);
        $this->call(tupalSessions::class);
        //ubaya
        $this->call(debt_optionsSeeder::class);
        $this->call(ubayaSeeder::class);
        $this->call(commoditiesSeeder::class);
        $this->call(productsSeeder::class);
        $this->call(heritagesSeeder::class);
        $this->call(componentsSeeder::class);
    }
}
