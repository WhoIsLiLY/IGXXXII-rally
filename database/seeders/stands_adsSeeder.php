<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class stands_adsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("stands_ads")->insert([
            [
                'name'=>'brosur',
                'type'=> 'Ad',
                'probability'=> 0.28,
                'base_price'=> 310,
                'multiplier'=> 1.2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'spanduk',
                'type'=> 'Ad',
                'probability'=> 0.54,
                'base_price'=> 540,
                'multiplier'=> 1.27,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'online ads',
                'type'=> 'Ad',
                'probability'=> 0.64,
                'base_price'=> 600,
                'multiplier'=> 1.38,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'game stand',
                'type'=> 'Stand',
                'probability'=> 0.39,
                'base_price'=> 390,
                'multiplier'=> 1.27,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'photo stand',
                'type'=> 'Stand',
                'probability'=> 0.15,
                'base_price'=> 165,
                'multiplier'=> 1.2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'food stand',
                'type'=> 'Stand',
                'probability'=> 0.48,
                'base_price'=> 450,
                'multiplier'=> 1.35,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
