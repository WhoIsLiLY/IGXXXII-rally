<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class players_ads_standsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("players_stands_ads")->insert([
            [
                'player_id'=>1,
                'stand_ad_id'=> 1,
                'amount'=> 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'player_id'=>1,
                'stand_ad_id'=> 3,
                'amount'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'player_id'=>1,
                'stand_ad_id'=> 5,
                'amount'=> 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'player_id'=>2,
                'stand_ad_id'=> 2,
                'amount'=> 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'player_id'=>2,
                'stand_ad_id'=> 3,
                'amount'=> 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'player_id'=>2,
                'stand_ad_id'=> 5,
                'amount'=> 1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
