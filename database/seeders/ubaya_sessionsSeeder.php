<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ubaya_sessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("ubaya_sessions")->insert([
            ['current'=>1,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()],
        ]);
    }
}
