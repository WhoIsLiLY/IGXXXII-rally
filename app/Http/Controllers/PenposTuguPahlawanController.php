<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\tuguPahlawan\Loket;
use App\Models\tuguPahlawan\Tupal;
use Illuminate\Support\Facades\DB;
use App\Models\tuguPahlawan\StandAd;
use App\Models\tuguPahlawan\PlayerStandAd;

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
        // $lokets = Loket::whereNull('player_id')->get(); // menunjukkan loket yang foreign key-nya belum terisi
        $price = (Loket::where('player_id', $player->id)->count()+1) * 1000;
        $budget = $player->tupals->point;
        // $player->load('tupals', 'lokets', 'playersStandsAds'); //LAZY LOAD
        
        return view('penpos.tugupahlawan.buyLoket', compact('player', 'price', 'budget'));
    }
    public function buyLoketsById(Player $player){
        //dd($player);
        // update table lokets - player id
        $status = false;
        $price = Loket::where('player_id', $player->id)->count()+1 * 1000;
        if($player->tupals->point >= $price){
            Loket::create([
                'player_id' => $player->id ?? null, // Berikan null jika tidak ada player
                'service_time' => 30, // Atau biarkan default
            ]);
            
            // Update table tupals - current_loket_price += 1000
            // Find the Tupal related to the player using players_id
            $tupal = Tupal::where('player_id', $player->id)->first();
    
            if ($tupal) {
                $tupal->point -= $price;
                $tupal->save();
            }
            $status = true;
        }
        //dd($status, $price);
        return redirect()->back()->with([
            'status' => $status
        ]);
    }

    public function upgradeLoketsByPlayer(Player $player){
        $player->load('tupals');
        $budget = $player->tupals->point;
        // Retrieve lokets associated with the player
        $lokets = Loket::where('player_id', $player->id)->get();

        // Iterate over each loket and calculate the upgrade price
        foreach ($lokets as $loket) {
            $serviceTime = $loket->service_time;

            if ($serviceTime > 10) {
                // Calculate the price based on the service time
                $levels = (30 - $serviceTime) / 5;
                $loket->upgrade_price = 500 * ($levels + 1);
            } else {
                // If service time is equal to 10, set upgrade price to null (sold out)
                $loket->upgrade_price = null;
            }
        }
        return view('penpos.tugupahlawan.upgradeLoket', compact('lokets', 'player', 'budget'));
    }
    public function upgradeLoketById(Player $player, Loket $loket, $price){
        $status = false;
        // update table loket - service time (<==10 min max. per lvl -5 min. initial == 30)
        $player->load('tupals');
        //dd($player, $loket, $price);
        if($player->tupals->point >= $price && $price < 3500){
            $tupal = $player->tupals;
            $tupal->point -= $price;
            $tupal->save();

            $loket->service_time -= 5;
            $loket->save();
            $status = true;
        }
        return redirect()->back()->with([
            'status' => $status
        ]);
    }
    
    public function buyStandsByPlayer(Player $player){
        $stands = StandAd::where('type', 'Stand')->get();
        $standAmounts = DB::table('players_stands_ads')
            ->where('player_id', $player->id)
            ->pluck('amount', 'stand_ad_id');

        $stands->each(function ($stand) use ($standAmounts) {
            $amount = $standAmounts->get($stand->id, 0);
            $stand->amount = $amount;
            $stand->adjusted_base_price = $stand->base_price * pow(1.2, $amount);
        });
        $budget = $player->tupals->point;
            
        // $stands = StandAd::where('type', 'Stand')
        //     ->leftJoin('players_stands_ads', function ($join) use ($player) {
        //         $join->on('stands_ads.id', '=', 'players_stands_ads.stand_ad_id')
        //             ->where('players_stands_ads.player_id', '=', $player->id);
        //     })
        //     ->select('stands_ads.*', DB::raw('IFNULL(players_stands_ads.amount, 0) as amount'))
        //     ->get();

        // // Calculate the adjusted base price
        // $stands->each(function ($stand) {
        //     $stand->adjusted_base_price = $stand->base_price * pow(1.2, $stand->amount);
        // });
        return view('penpos.tugupahlawan.stand', compact('player', 'stands', 'budget'));
    }
    public function buyAdsByPlayer(Player $player){
        $ads = StandAd::where('type', 'Ad')
            ->leftJoin('players_stands_ads', function ($join) use ($player) {
                $join->on('stands_ads.id', '=', 'players_stands_ads.stand_ad_id')
                    ->where('players_stands_ads.player_id', '=', $player->id);
            })
            ->select('stands_ads.*', DB::raw('IFNULL(players_stands_ads.amount, 0) as amount'))
            ->get();

        // Calculate the adjusted base price
        $ads->each(function ($ad) {
            $ad->adjusted_base_price = $ad->base_price * pow(1.2, $ad->amount);
        });
        $budget = $player->tupals->point;
        return view('penpos.tugupahlawan.ad', compact('player', 'ads', 'budget'));
    }
    public function buyStandAdById(Player $player, $standAdId){
        // every buy will increase 1.2 the base price
        // Update the amount or create a new record
        $status = false;
        $player->load('tupals');
        $standAd = StandAd::findOrFail($standAdId);
        $playerStandAd = PlayerStandAd::where('player_id', $player->id)
            ->where('stand_ad_id', $standAd->id)
            ->first();

        //dd($player->tupals->point, $standAd->base_price, $playerStandAd->amount ?? 0 );
        if($player->tupals->point >= $standAd->base_price * pow(1.2, $playerStandAd->amount ?? 0 )){
            if ($playerStandAd) {
                //dd($standAd->basePrice * pow(1.2, $playerStandAd->amount));
                $tupal = $player->tupals;
                $tupal->point -= $standAd->base_price * pow(1.2, $playerStandAd->amount);
                $tupal->save();
                //dd('filled', $playerStandAd);
                // If the record exists, increment the amount by 1
                $updated = DB::table('players_stands_ads')
                    ->where('player_id', $player->id)
                    ->where('stand_ad_id', $standAd->id)
                    ->increment('amount', 1);
            } else {
                $tupal = $player->tupals;
                $tupal->point -= $standAd->base_price * pow(1.2, 0);
                $tupal->save();
                // If the record does not exist, create a new one with amount = 1
                PlayerStandAd::create([
                    'player_id' => $player->id,
                    'stand_ad_id' => $standAd->id,
                    'amount' => 1,
                ]);
            }
            $status = true;
        }
        return redirect()->back()->with([
            'status' => $status,
        ]);
    }
}