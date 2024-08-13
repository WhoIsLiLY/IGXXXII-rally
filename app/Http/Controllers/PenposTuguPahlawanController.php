<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\tuguPahlawan\Loket;
use App\Models\tuguPahlawan\Tupal;
use App\Models\tuguPahlawan\StandAd;

class PenposTuguPahlawanController extends Controller
{
    public function showListPlayer($action, $id)
    {
        $players = Player::with([
            'tupals',
            'lokets',
            'playersStandsAds' => function ($query) {
                $query->join('stands_ads', 'stands_ads.id', '=', 'players_stands_ads.stand_ad_id');
            }
        ])->get();
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
        $price = $player->tupals->current_loket_price;
        return view('penpos.tugupahlawan.buyLoket', compact('player', 'lokets', 'price'));
    }
    public function buyLoketsById(Player $player, Loket $loket){
        //dd($player);
        // update table lokets - player id
        $loket->player_id = $player->id;
        $loket->save();
        // Update table tupals - current_loket_price += 1000
        // Find the Tupal related to the player using players_id
        $tupal = Tupal::where('player_id', $player->id)->first();

        if ($tupal) {
            $tupal->current_loket_price += 1000; // Add 1000 to current_loket_price
            $tupal->save();
        }

        $player = Player::getPlayerById($player->id);
        $lokets = Loket::whereNull('player_id')->get(); // menunjukkan loket yang foreign key-nya belum terisi
        $price = $player->tupals->current_loket_price;
        return redirect()->route('penpos.buyLoket', compact('player', 'lokets', 'price'));
    }

    public function upgradeLoketsByPlayer(Player $player){

    }
    public function upgradeLoketsById(Loket $loket){
        // update table loket - service time (<==10 min max. per lvl -5 min. initial == 30)
    }
    public function buyStandsByPlayer(Player $player){
        $stands = StandAd::where('type', 'Stand')->get();
        return view('penpos.tugupahlawan.stand', compact('player', 'stands'));
    }
    public function buyAdsByPlayer(Player $player){
        $ads = StandAd::where('type', 'Ad')->get();
        return view('penpos.tugupahlawan.ad', compact('player', 'ads'));
    }
    public function buyStandAdById(StandAd $standAd){
        // every buy will increase 1.2 the base price
    }
}
