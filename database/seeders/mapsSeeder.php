<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class mapsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("maps")->insert([
            [
                'city_id'=>1,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>2,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>3,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>4,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>5,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>6,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>7,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>1,
                'player_id'=> 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            
            // Tim Hari H
            [
                'city_id'=>8,
                'player_id'=> 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 16,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 17,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 17,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 18,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 18,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 19,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 21,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 21,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 22,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 23,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 23,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>8,
                'player_id'=> 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'city_id'=>9,
                'player_id'=> 24,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
