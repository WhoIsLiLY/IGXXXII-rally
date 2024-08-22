<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class player_productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("player_products")->insert([
            [
                'player_id'=> 1,
                'product_id'=> 1,
                'amount'=>1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'player_id'=> 1,
                'product_id'=> 2,
                'amount'=>0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'player_id'=> 1,
                'product_id'=> 3,
                'amount'=>0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'player_id'=> 2,
                'product_id'=> 1,
                'amount'=>1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'player_id'=> 2,
                'product_id'=> 2,
                'amount'=>0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'player_id'=> 2,
                'product_id'=> 3,
                'amount'=>0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
