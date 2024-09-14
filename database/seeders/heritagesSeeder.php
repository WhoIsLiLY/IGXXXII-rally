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
                    'product_id'=>3,
                    'amount'=>5,
                    'profit'=>12500,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>3,
                    'amount'=>2,
                    'profit'=>4500,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>3,
                    'amount'=>8,
                    'profit'=>22000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>3,
                    'amount'=>10,
                    'profit'=>30000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>3,
                    'amount'=>15,
                    'profit'=>56250,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>2,
                    'profit'=>8500,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>5,
                    'profit'=>25000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>4,
                    'profit'=>17200,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>10,
                    'profit'=>6000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>12,
                    'profit'=>78000,
                    'session'=> 1,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],


                [
                    'product_id'=>1,
                    'amount'=>2,
                    'profit'=>4200,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>1,
                    'amount'=>20,
                    'profit'=>60000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>1,
                    'amount'=>5,
                    'profit'=>12250,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>1,
                    'amount'=>12,
                    'profit'=>31200,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>1,
                    'amount'=>10,
                    'profit'=>25000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>2,
                    'profit'=>8500,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>5,
                    'profit'=>25000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>4,
                    'profit'=>17200,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>10,
                    'profit'=>6000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'product_id'=>2,
                    'amount'=>12,
                    'profit'=>78000,
                    'session'=> 2,
                    'created_at'=> Carbon::now(),
                    'updated_at'=> Carbon::now()
                ]
        ]);
    }
}
