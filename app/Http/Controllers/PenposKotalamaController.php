<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenposKotalamaController extends Controller
{
    public function penposData(){
        $daftarPeserta = DB::table('players')->get();
        $daftarKota = DB::table('cities')->get();
        return view('penpos/kotalama',compact('daftarPeserta','daftarKota'));
    }
}
