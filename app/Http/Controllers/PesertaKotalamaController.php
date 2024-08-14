<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PesertaKotalamaController extends Controller
{
    public function kotalamaData(){
        $userID = Auth::user()->id;
        $player = DB::table("players")->where("user_id", $userID)->first();
        $kotalama = DB::table('kotalama')->select('total_passengers', 'total_duration', 'location_id')->where('player_id', $player->id)->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $maps = DB::table('maps')->select('city_id')->where('player_id', $player->id)->get();
    
        $destinationList = DB::table('roads as r')
            ->join('maps as m', 'm.city_id', '=', 'r.origin_id')
            ->join('players as p', 'p.id', '=', 'm.player_id')
            ->where('p.id', $player->id)
            ->where('r.origin_id', $kotalama->location_id)
            ->whereIn('r.destination_id', function ($query) use ($player) {
                $query->select('city_id')
                    ->from('maps')
                    ->where('player_id', $player->id);
            })->pluck('r.destination_id');
    
        return view('peserta.kotalama', compact('player', 'kotalama', 'bus', 'maps', 'destinationList'));
    }
    
}
?>
