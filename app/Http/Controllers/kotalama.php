<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kotalama extends Controller
{
    public function userData(){
        $data=DB::table('kotalama')->select('total_passengers','total_duration')->where('player_id',1)->first();
        return view('kotalama',compact('data'));
    }
}
?>
