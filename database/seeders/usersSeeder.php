<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'admin',
                'email'=> 'admin@gmail.com',
                'email_verified_at'=>Carbon::now(),
                'password'=> Hash::make('password'),
                'role'=> 'SI',
                'remember_token'=> Str::random(10),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'io15',
                'email'=> 'io15@gmail.com',
                'email_verified_at'=>Carbon::now(),
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'remember_token'=> Str::random(10),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'moon69',
                'email'=> 'moon69@gmail.com',
                'email_verified_at'=>Carbon::now(),
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'remember_token'=> Str::random(10),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
