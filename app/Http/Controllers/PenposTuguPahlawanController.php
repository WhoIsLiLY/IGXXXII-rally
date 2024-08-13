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
        $lokets = Loket::whereNull('player_id')->get(); // menunjukkan loket yang foreign key-nya belum terisi
        return view('penpos.tugupahlawan.buyLoket', compact('player', 'lokets'));
    }
    public function buyLoketsById(Loket $loket){
        // update table lokets - player id
        // update table tupals - current_loket_price += 1000
    }
    public function upgradeLoketsByPlayer(Player $player){

    }
    public function upgradeLoketsById(Loket $loket){
        // update table loket - service time (<==10 min max. per lvl -5 min. initial == 30)
    }
    public function buyStandByPlayer(Player $player){

    }
    public function buyAdByPlayer(Player $player){

    }
    public function buyStandAdById(StandAd $standAd){
        // every buy will increase 1.2 the base price
    }
}
