<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PenposKotalamaController extends Controller
{
    public function penposData() {
        $cities = DB::table('cities')->select('id', 'name')->get();
        $players = DB::table('players')->select('id', 'username')->get();
        return view('penpos/kotalama', compact('cities', 'players')); 
    }

    public function insert(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'city_id' => 'required|integer',
        ]);

        $userId = $request->input('user_id');
        $cityId = $request->input('city_id');

        $exists = DB::table('maps')
                    ->where('player_id', $userId)
                    ->where('city_id', $cityId)
                    ->exists();

        if ($exists) {
            return response()->json(['status' => 'exists', 'message' => 'sudah membuka kota ini sebelumnya.']);
        }

        DB::table('maps')->insert([
            'player_id' => $userId,
            'city_id' => $cityId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan!']);
    }
}
