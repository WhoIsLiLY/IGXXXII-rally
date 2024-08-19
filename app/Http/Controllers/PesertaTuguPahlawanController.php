<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesertaTuguPahlawanController extends Controller
{
    /*
    protected $player;
    public function __construct(Player $player)
    {
        $this->player = $player;
    }*/
    public function showPage(){
        $userID = Auth::user()->id;
        $p = DB::table("players")->where("user_id", $userID)->first();
        $player = Player::getPlayerById($p->id);
        
        //$player = Player::with(['tupals', 'playersStandsAds', 'tupalLogs', 'lokets'])->findOrFail($id);
        return view('peserta.tugupahlawan', compact('player'));
    }
}
