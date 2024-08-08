<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kotalama extends Controller
{
    public function kotalamaData($id){
        $player = DB::table("players")->where("id",$id)->first();
        $kotalama=DB::table('kotalama')->select('total_passengers','total_duration')->where('player_id',$id)->first();
        $bus=DB::table('buses')->where('player_id', $id)->first();
        $maps=DB::table('maps')->select('city_id')->where('player_id', $id)->get();
        return view('kotalama.index',compact('player','kotalama','bus','maps'));
    }
}
?>
