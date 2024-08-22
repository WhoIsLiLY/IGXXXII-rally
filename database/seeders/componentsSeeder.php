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
                'commodity_id'=>7,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>6,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>15,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>16,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>1,
                'commodity_id'=>13,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],

                ['product_id'=>2,
                'commodity_id'=>6,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>14,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>10,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>12,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>9,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>8,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>1,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>2,
                'commodity_id'=>5,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],

                ['product_id'=>3,
                'commodity_id'=>11,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>3,
                'commodity_id'=>3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>3,
                'commodity_id'=>2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>3,
                'commodity_id'=>4,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()],
                ['product_id'=>3,
                'commodity_id'=>17,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()]
        ]);
    }
}
