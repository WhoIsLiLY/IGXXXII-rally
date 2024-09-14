<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class tupalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("tupals")->insert([
            ['player_id'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>2,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>3,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>4,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>5,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>6,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>7,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>8,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>9,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>10,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>11,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>12,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>13,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>14,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],

            
            ['player_id'=>15,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>16,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>17,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>18,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>19,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>20,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>21,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>22,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>23,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>24,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()]
        ]);
    }
}
