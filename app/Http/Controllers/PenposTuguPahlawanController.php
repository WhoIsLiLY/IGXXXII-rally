<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PenposTuguPahlawanController extends Controller
{
    public function showPage()
    {
        $players = Player::all();
        return view('penpos.tugupahlawan.buyLoket', compact('players'));
    }
}
