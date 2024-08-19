<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class componentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("components")->insert([
                ['product_id'=>1,
                'commodity_id'=>10,
                'amount'=>2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>12,
                'amount'=>1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],

                ['product_id'=>2,
                'commodity_id'=>14,
                'amount'=>1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>9,
                'amount'=>3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],

                ['product_id'=>3,
                'commodity_id'=>2,
                'amount'=>2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>3,
                'commodity_id'=>4,
                'amount'=>1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()]
        ]);
    }
}
