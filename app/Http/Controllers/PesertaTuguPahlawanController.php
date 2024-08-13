<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PesertaTuguPahlawanController extends Controller
{
    /*
    protected $player;
    public function __construct(Player $player)
    {
        $this->player = $player;
    }*/
    public function showPage($id){
        $player = Player::with([
            'tupals',
            'lokets',
            'playersStandsAds' => function ($query) {
                $query->join('stands_ads', 'stands_ads.id', '=', 'players_stands_ads.stand_ad_id');
            }
        ])->findOrFail($id);
        
        //$player = Player::with(['tupals', 'playersStandsAds', 'tupalLogs', 'lokets'])->findOrFail($id);
        return view('peserta.tugupahlawan', compact('player'));
    }
}
