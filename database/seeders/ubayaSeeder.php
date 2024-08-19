<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ubayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("ubaya")->insert([
            ['player_id'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
            ['player_id'=>2,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
        ]);
    }
}
