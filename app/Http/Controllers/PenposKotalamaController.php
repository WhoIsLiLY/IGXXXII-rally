<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PenposKotalamaController extends Controller
{
    public function penposData() {
        // $daftarPeserta = DB::table('players')->get();
        // $daftarKota = DB::table('cities')->get();
        $cities = DB::table('cities')->select('id', 'name')->get();
        $players = DB::table('players')->select('id', 'username')->get();
        return view('penpos/kotalama', compact('cities', 'players'));
    }

    public function insert(Request $request) {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'city_id' => 'required|integer',
        ]);

        // Ambil data dari combo box
        $userId = $request->input('user_id');
        $cityId = $request->input('city_id');

        // Masukkan data ke dalam tabel maps
        DB::table('maps')->insert([
            'player_id' => $userId,
            'city_id' => $cityId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect atau kembalikan respon sesuai kebutuhan
        return redirect()->back()->with('success', 'Data berhasil dimasukkan!');
    }
}
