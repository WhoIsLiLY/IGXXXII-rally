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

        // Player Poin
        $ubaya = DB::table("ubaya")->where('player_id', $player->id)->first();

        // Debt List
        $debts = DB::table('debts')->where('player_id', $player->id)->get()->all();

        // Player Commodities and Completed Heritages
        $playerCommodities = DB::table('player_commodities')->where('player_id', $player->id)->get()->all();

        // Player Product
        $playerProducts = DB::table('player_products')->where('player_id', $player->id)->get()->all();

        return view("peserta.ubaya", compact("ubaya", 'debts', 'playerCommodities', 'playerProducts'));
    }
}
