<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\tuguPahlawan\Loket;
use App\Models\tuguPahlawan\StandAd;

class PenposTuguPahlawanController extends Controller
{
    public function showListPlayer($action, $id)
    {
        $players = Player::all();
        // if($action == "buyloket"){
        //     return view('penpos.tugupahlawan.buyLoket', compact('players'));
        // }else if($action == "upgradeloket"){
        //     return view('penpos.tugupahlawan.upgradeLoket', compact('players'));
        // }else if($action == "buystand"){
        //     return view('penpos.tugupahlawan.buyStand', compact('players'));
        // }else if($action == "buyad"){
        //     return view('penpos.tugupahlawan.buyLoket', compact('players'));
        // }else{
        //     // return 404
        //     abort(404);
        // }
        return view('penpos.tugupahlawan.listPlayer', compact('players', 'action', 'id'));
    }
    public function buyLoketsByPlayer(Player $player){
        return view('penpos.tugupahlawan.buyLoket');
    }
    public function buyLoketsById(Loket $loket){
        // update table loket - player id
    }
    public function upgradeLoketsByPlayer(Player $player){
        // update table loket - service time (<==10 min max. per lvl -5 min. initial == 30)
    }
    public function upgradeLoketsById(Loket $loket){

    }
    public function buyStandByPlayer(Player $player){

    }
    public function buyAdByPlayer(Player $player){

    }
    public function buyStandAdById(StandAd $standAd){

    }
}
