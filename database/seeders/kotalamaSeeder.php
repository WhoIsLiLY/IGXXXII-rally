<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class kotalamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kotalama')->insert([
            [
                'total_passengers'=>0,
                'total_duration'=>0,
                'location_id'=>1,
                'player_id'=>1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'total_passengers'=>69,
                'total_duration'=>69,
                'location_id'=>1,
                'player_id'=>2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
