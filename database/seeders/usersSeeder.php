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
                'password'=> Hash::make('KingKenso'),
                'role'=> 'penpos',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'io15',
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'moon69',
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'hash32',
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tiptoe22',
                'password'=> Hash::make('password'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_1',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_2',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_3',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_4',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_5',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_6',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_7',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_8',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_9',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'tim_10',
                'password'=> Hash::make('peserta123'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            
            [
                'name'=>'SMH',
                'password'=> Hash::make('81088016'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'TRIO SOSIS',
                'password'=> Hash::make('80365015'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'Icikiwir',
                'password'=> Hash::make('05972524'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'VLT',
                'password'=> Hash::make('85688463'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'Pecinta Kimia',
                'password'=> Hash::make('64838728'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'Merak Dempo',
                'password'=> Hash::make('54958482'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'POHMH',
                'password'=> Hash::make('70645744'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'SINKULI',
                'password'=> Hash::make('19637854'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'VAMOSS',
                'password'=> Hash::make('60003969'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'name'=>'KOPASTAM',
                'password'=> Hash::make('23275218'),
                'role'=> 'peserta',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
