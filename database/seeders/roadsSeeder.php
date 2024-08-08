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
        DB::table("roads")->insert([
            [
                'origin_id'=>1,
                'destination_id'=> 2,
                'distance'=> 10,
                'speed'=>10
            ],
            [
                'origin_id'=>2,
                'destination_id'=>1,
                'distance'=> 10,
                'speed'=>10
            ],
        ]);
    }
}
