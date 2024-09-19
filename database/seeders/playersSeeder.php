<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class playersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('players')->insert([
            [
                'username'=>'io15',
                'user_id'=> 2,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'moona69',
                'user_id'=> 3,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'hash32',
                'user_id'=> 4,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tiptoe22',
                'user_id'=> 5,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_1',
                'user_id'=> 6,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_2',
                'user_id'=> 7,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_3',
                'user_id'=> 8,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_4',
                'user_id'=> 9,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_5',
                'user_id'=> 10,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_6',
                'user_id'=> 11,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_7',
                'user_id'=> 12,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_8',
                'user_id'=> 13,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_9',
                'user_id'=> 14,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'tim_10',
                'user_id'=> 15,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],

            
            [
                'username'=>'SMH',
                'user_id'=> 16,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'TRIO SOSIS',
                'user_id'=> 17,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'Icikiwir',
                'user_id'=> 18,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'VLT',
                'user_id'=> 19,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'Pecinta Kimia',
                'user_id'=> 20,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'Merak Dempo',
                'user_id'=> 21,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'POHMH',
                'user_id'=> 22,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'SINKULI',
                'user_id'=> 23,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'VAMOSS',
                'user_id'=> 24,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'KOPASTAM',
                'user_id'=> 25,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'username'=>'jabar',
                'user_id'=> 26,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
