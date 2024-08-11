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
        $player = Player::getPlayerById($id);
        return view('peserta.tugupahlawan', compact('player'));
    }
}   
