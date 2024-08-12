<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PesertaKotalamaController extends Controller
{
    public function kotalamaData(){
        $userID=Auth::user()->id;
        $player = DB::table("players")->where("user_id",$userID)->first();
        $kotalama=DB::table('kotalama')->select('total_passengers','total_duration')->where('player_id',$player->id)->first();
        $bus=DB::table('buses')->where('player_id', $player->id)->first();
        $maps=DB::table('maps')->select('city_id')->where('player_id', $player->id)->get();

        return view('peserta.kotalama',compact('player','kotalama','bus','maps'));
    }
}
?>
