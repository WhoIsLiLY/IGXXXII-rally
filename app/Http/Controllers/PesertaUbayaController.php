<?php

namespace App\Http\Controllers;


use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesertaUbayaController extends Controller
{
    public function showPage(){
        $userID = Auth::user()->id;
        $p = DB::table("players")->where("user_id", $userID)->first();
        $player = Player::getPlayerById($p->id);
        return view("peserta.ubaya");
    }
}
