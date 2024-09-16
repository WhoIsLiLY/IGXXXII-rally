<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class tupalSessions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tupal_sessions')->insert([
            [
                'open' => now(),
                'close' => now()->addHour(),
                'boost' => null,
                'status' => 'actived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'open' => now()->addHour(),
                'close' => now()->addHours(2),
                'boost' => '25% Stand Ad Score Reduction',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'open' => now()->addHours(2),
                'close' => now()->addHours(3),
                'boost' => 'Question Point Boost 50%',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'open' => now()->addHours(3),
                'close' => now()->addHours(4),
                'boost' => null,
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
