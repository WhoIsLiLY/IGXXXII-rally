<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class roadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //origin pasti yang id nya lebih kecil
        DB::table("roads")->insert([
            [
                'origin_id'=>1,
                'destination_id'=> 2,
                'distance'=> 10,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>1,
                'destination_id'=>5,
                'distance'=> 20,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>1,
                'destination_id'=>8,
                'distance'=> 15,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>2,
                'destination_id'=>4,
                'distance'=> 15,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>2,
                'destination_id'=>7,
                'distance'=> 10,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>2,
                'destination_id'=>8,
                'distance'=> 10,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>3,
                'destination_id'=>5,
                'distance'=> 15,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>3,
                'destination_id'=>6,
                'distance'=> 10,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>3,
                'destination_id'=>8,
                'distance'=> 10,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>3,
                'destination_id'=>9,
                'distance'=> 20,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>4,
                'destination_id'=>7,
                'distance'=> 5,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>4,
                'destination_id'=>8,
                'distance'=> 5,
                'speed'=>20,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>4,
                'destination_id'=>9,
                'distance'=> 5,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>5,
                'destination_id'=>6,
                'distance'=> 10,
                'speed'=>40,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>5,
                'destination_id'=>8,
                'distance'=> 5,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>6,
                'destination_id'=>9,
                'distance'=> 5,
                'speed'=>50,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'origin_id'=>7,
                'destination_id'=>9,
                'distance'=> 10,
                'speed'=>40,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
