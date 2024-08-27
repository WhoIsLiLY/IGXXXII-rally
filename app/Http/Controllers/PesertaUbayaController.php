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
        $playerId = $p->id;
        $player = Player::getPlayerById($p->id);

        // Player Poin
        $ubaya = DB::table("ubaya")->where('player_id', $player->id)->first();

        // Debt List
        $debts = DB::table('debts as d')->join('debt_options as do','d.debt_option_id','=','do.id')->where('player_id', $player->id)->where('interest','!=',0)->get();

        // Player Commodities
        $playerCommodities = 
            DB::table('commodities as comm')
            ->leftJoin('player_commodities as pc', function ($join) use ($playerId) {
                $join->on('pc.commodity_id', '=', 'comm.id')
                    ->where('pc.player_id', $playerId);
            })->get();

        // Player Product
        $playerProducts = 
            DB::table('products as p')
            ->leftJoin('player_products as pp', function ($join) use ($playerId) {
                $join->on('pp.product_id', '=', 'p.id')
                    ->where('pp.player_id', $playerId);
            })->get();

        //Inventory
        $inventoryComm = 
            DB::table('player_commodities as pc')
            ->join('commodities as c', 'pc.commodity_id', '=', 'c.id')
            ->where('pc.player_id',$player->id)
            ->select(DB::raw('SUM(pc.amount * c.capacity) as total_space_taken'))
            ->first();
        $inventoryProd = 
            DB::table('player_products as pp')
            ->join('products as p', 'pp.product_id', '=', 'p.id')
            ->where('pp.player_id',$player->id)
            ->select(DB::raw('SUM(pp.amount * p.capacity) as total_space_taken'))
            ->first();
        $totalInventory = $inventoryComm->total_space_taken +  $inventoryProd->total_space_taken;

        return view("peserta.ubaya", compact("player","ubaya", 'debts', 'playerCommodities', 'playerProducts','totalInventory'));
    }
}
