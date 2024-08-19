<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class heritagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("heritages")->insert([
                [
                    'product_id'=>1,
                    'amount'=>3,
                    'profit'=>5000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>5,
                    'profit'=>10000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>3,
                    'amount'=>2,
                    'profit'=>5000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>1,
                    'profit'=>4000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ]
        ]);
    }
}
