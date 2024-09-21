<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\ubaya\Commodity;
use App\Models\ubaya\PlayerCommodities;
use App\Models\ubaya\Ubayas;


use App\Models\ubaya\Debt;
use App\Models\ubaya\DebtOption;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenposUbayaController extends Controller
{
    //bank
    public function bank(Player $player){
        return view("penpos.ubaya.bank",compact("player"));
    }
    public function debtOption(Player $player){
        $debtOption=DB::table("debt_options")->get();
        return view("penpos.ubaya.debt",compact("debtOption","player"));
    }
    public function payOption(Player $player){
        $payOption=DB::table("debts")->where("player_id",$player->id)->where('interest','!=',0)->get();
        $ubaya = Ubayas::where('player_id', $player->id)->first();
        return view("penpos.ubaya.pay",compact("payOption","player","ubaya"));
    }
    public function debtByID($player, $id) {
        // Retrieve the Ubaya record for the player
        $player = player::where('username', $player)->firstOrFail();
        $ubaya = Ubayas::where('player_id', $player->id)->first();
    
        // Retrieve the DebtOption
        $debtOption = DebtOption::findOrFail($id);
    
        // Update the points
        $ubaya->point += $debtOption->point;
        $ubaya->save();
    
        // Create a new Debt record
        Debt::create([
            'player_id' => $player->id,
            'debt_option_id' => $id,
            // 'interest' => $debtOption->point + ceil($debtOption->point * ($debtOption->interest_rate / 100))
            'interest' => ceil($debtOption->point * ($debtOption->interest_rate / 100))
        ]);
    
        // Return or redirect after the operation
        return redirect()->back()->with('success', 'Debt processed successfully');
    }
    public function payByID($player, $id) {
        // Retrieve the Ubaya record for the player
        $player = player::where('username', $player)->firstOrFail();
        $ubaya = Ubayas::where('player_id', $player->id)->first();
    
        // Retrieve the payOption
        $payOption = Debt::findOrFail($id);
    
        if($payOption->interest > $ubaya->point){
            return redirect()->back()->withErrors('Insufficient points');
        }
        else{
            // Update the points
            $ubaya->point -= $payOption->interest;
            $ubaya->save();
    
            // Delete the Debt record
            $payOption->interest = 0;
            $payOption->save();
        
            // Return or redirect after the operation
            return redirect()->back()->with('success', 'Payment processed successfully');
        }
    }
    
    

    //commodity
    public function commodityOption(Player $player){
        $commodityOption=DB::table("commodities")->get();
        $ubaya = Ubayas::where('player_id', $player->id)->first();
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

        return view("penpos.ubaya.commodity",compact("commodityOption","player","ubaya","totalInventory"));
    }
    public function commodityByID($playerUsername, $id, $amount) {
        $player = Player::where('username', $playerUsername)->firstOrFail();
        $ubaya = Ubayas::where('player_id', $player->id)->firstOrFail();
        $comm = Commodity::findOrFail($id);
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
    
        if ($amount < $comm->min_buy) {
            return redirect()->back()->withErrors('Amount must be greater than minimum buy.');
        }
        if ($ubaya->point < $comm->price * $amount) {
            return redirect()->back()->withErrors('Insufficient points.');
        }
        if (($comm->capacity*$amount) > ($ubaya->inventory - $totalInventory)) {
            return redirect()->back()->withErrors('Inventory overload');
        }
        $ubaya->point -= $comm->price * $amount;
        $ubaya->save();
    
        $PlayerCommodity = DB::table('player_commodities')
            ->where('player_id', $player->id)
            ->where('commodity_id', $id)
            ->first();

        if ($PlayerCommodity) {
            // Update the amount in the table
            DB::table('player_commodities')
                ->where('player_id', $player->id)
                ->where('commodity_id', $id)
                ->update(['amount' => $PlayerCommodity->amount + $amount]);
        } else {
            // Create a new entry in the table
            DB::table('player_commodities')->insert([
                'player_id' => $player->id,
                'commodity_id' => $id,
                'amount' => $amount
            ]);
        }

        return redirect()->back()->with('success', 'Transaction processed successfully.');
    }
    

    //factory
    public function productOption(Player $player){
        $playerId = $player->id;

        $productOption = DB::table('products as p')
            ->join('components as c', 'p.id', '=', 'c.product_id')
            ->join('commodities as comm', 'c.commodity_id', '=', 'comm.id')
            ->leftJoin('player_commodities as pc', function ($join) use ($playerId) {
                $join->on('pc.commodity_id', '=', 'comm.id')
                    ->where('pc.player_id', $playerId);
            })
            ->select(
                'p.name as productName', 
                DB::raw('GROUP_CONCAT(comm.name) as commodityNames'),
                DB::raw('GROUP_CONCAT(IFNULL(pc.amount, 0)) as commodityAmounts'),
                'p.capacity as capacity', 
                'p.id as id'
            )
            ->groupBy('p.id', 'p.name', 'p.capacity')
            ->get();


        $ubaya = Ubayas::where('player_id', $player->id)->first();

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

        return view("penpos.ubaya.factory",compact("productOption","player","ubaya","totalInventory"));
    }
    public function production(Player $player,$productID,$qcID,$amount){
        $minValue = DB::table('components as c')
            ->join('player_commodities as pc','c.commodity_id','=','pc.commodity_id')
            ->where('pc.player_id',$player->id)
            ->where('c.product_id',$productID)
            ->min('pc.amount');
        if(!$minValue){$minValue=0;}

        $commCount = DB::table('components as c')
            ->join('player_commodities as pc','c.commodity_id','=','pc.commodity_id')
            ->where('pc.player_id',$player->id)
            ->where('c.product_id',$productID)
            ->count('pc.amount');

        //penegecekan kelengkapan komponen
        if($minValue<$amount){
            return redirect()->back()->withErrors('incomplete component');
        }
        else if($commCount<6 && $productID==1){
            return redirect()->back()->withErrors('incomplete component');
        }
        else if($commCount<8 && $productID==2){
            return redirect()->back()->withErrors('incomplete component');
        }
        else if($commCount<5 && $productID==3){
            return redirect()->back()->withErrors('incomplete component');
        }
        else{
            $ubaya = Ubayas::where('player_id', $player->id)->first();
            $randomNumber = 100;
            switch ($qcID) {
                case 1:
                    $ubaya->point -= 800;
                    $randomNumber = rand(70, 100);
                    break;
            
                case 2:
                    $ubaya->point -= 1000;
                    $randomNumber = rand(80, 100);
                    break;
            
                case 3:
                    $ubaya->point -= 1500;
                    $randomNumber = rand(90, 100);
                    break;
            }

            //update
            DB::table('components as c')
            ->join('player_commodities as pc', 'c.commodity_id', '=', 'pc.commodity_id')
            ->where('pc.player_id', $player->id)
            ->where('c.product_id', $productID)
            ->update(['pc.amount' => DB::raw('pc.amount - ' . $amount)]);

            $playerProdCheck=DB::table('player_products')->where('player_id',$player->id)->where('product_id',$productID)->first();
            if(!$playerProdCheck){
                //create
                DB::table('player_products')->insert([
                    'player_id' => $player->id,
                    'product_id' => $productID,
                    'amount' => floor($amount * ($randomNumber/100))
                ]);
            }
            else{
                //update
                $newProd=floor($amount * ($randomNumber/100));

                DB::table('player_products as pp')
                ->where('player_id', $player->id)
                ->where('product_id',$productID)
                ->update(['pp.amount'=>DB::raw('pp.amount + ' . $newProd)]);
            }
            return redirect()->back()->with('success', 'Product processed successfully.');
        }
    }

    //heritage
    public function heritageOption(Player $player){
        $session=DB::table('ubaya_sessions')->where('id',1)->first();
        $ubaya = Ubayas::where('player_id', $player->id)->first();
        $playerID=$player->id;
        $heritageOption = DB::table('heritages as h')
            ->join('products as p', 'h.product_id', '=', 'p.id')
            ->leftJoin('player_products as pp', function($join) use($playerID) 
            {$join->on('h.product_id', '=', 'pp.product_id')->where('pp.player_id', $playerID);})
            ->where('h.session', $session->current)
            ->select('h.id','h.profit','p.name','h.amount as heritage_amount',DB::raw('IFNULL(pp.amount, 0) as player_amount')) ->get();
        return view("penpos.ubaya.heritage",compact("heritageOption","player","ubaya"));
    }
    public function heritageCompletion(Player $player,$heritageID){
        $data=
            DB::table('heritages as h')
            ->join('products as p', 'h.product_id', '=', 'p.id')
            ->Join('player_products as pp', function($join) {$join->on('h.product_id', '=', 'pp.product_id');})
            ->where('h.id', $heritageID)
            ->where('pp.player_id', $player->id)
            ->select('h.profit','h.amount as heritage_amount','pp.amount as player_amount','p.id as pid')->first();
        $ubaya = Ubayas::where('player_id', $player->id)->first();

        if(!$data){return redirect()->back()->withErrors('You have 0 product');}

        if($data->player_amount < $data->heritage_amount){
            return redirect()->back()->withErrors('Insufficient product');
        }
        $heritageCheck = DB::table('completed_heritages')->where('heritage_id',$heritageID)->where('player_id',$player->id)->first();
        if($heritageCheck){
            return redirect()->back()->withErrors('Heritages already completed');
        }
        else{
            //buat ngurangin produk
            DB::table('player_products')
            ->where('product_id',$data->pid)
            ->where('player_id',$player->id)
            ->update(['amount'=> ($data->player_amount - $data->heritage_amount)]);
            
            //buat nambah poin
            DB::table('ubaya')->where('player_id',$player->id)->update(['point'=> $ubaya->point + $data->profit]);
            
            //buat nyatet penyelsaian
            DB::table('completed_heritages')->insert([
                'player_id' => $player->id,
                'heritage_id' => $heritageID
            ]);

            return redirect()->back()->with('success', 'Heritage Transaction processed successfully.');
        }
    }

    //inventory
    public function inventory(Player $player){
        $ubaya = Ubayas::where('player_id', $player->id)->first();
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

        return view("penpos.ubaya.inventory",compact("player","ubaya","totalInventory"));
    }
    public function inventoryUpgrade($playerUsername,$upgrade) {
        $player = Player::where('username', $playerUsername)->firstOrFail();
        $ubaya = Ubayas::where('player_id', $player->id)->firstOrFail();
        
        if($upgrade==1){
            if($ubaya->point<500){
                return redirect()->back()->withErrors('Insufficient points.');
            }
            else{
                DB::table('ubaya')
                ->where('player_id', $player->id)
                ->update(['inventory' => $ubaya->inventory + 20,'point' => $ubaya->point - 500]);

                return redirect()->back()->with('success', 'Transaction processed successfully.');
            }
        }
        else if($upgrade==2){
            if($ubaya->point<800){
                return redirect()->back()->withErrors('Insufficient points.');
            }
            else{
                DB::table('ubaya')
                ->where('player_id', $player->id)
                ->update(['inventory' => $ubaya->inventory + 50,'point' => $ubaya->point - 800]);

                return redirect()->back()->with('success', 'Transaction processed successfully.');
            }
        }
        else if($upgrade==3){
            if($ubaya->point<1000){
                return redirect()->back()->withErrors('Insufficient points.');
            }
            else{
                DB::table('ubaya')
                ->where('player_id', $player->id)
                ->update(['inventory' => $ubaya->inventory + 70,'point' => $ubaya->point - 1000]);

                return redirect()->back()->with('success', 'Transaction processed successfully.');
            }
        }
        else if($upgrade==4){
            if($ubaya->point<1300){
                return redirect()->back()->withErrors('Insufficient points.');
            }
            else{
                DB::table('ubaya')
                ->where('player_id', $player->id)
                ->update(['inventory' => $ubaya->inventory + 100,'point' => $ubaya->point - 1300]);

                return redirect()->back()->with('success', 'Transaction processed successfully.');
            }
        }
    }

    //session
    public function changeSessionUbayaPage(){
        $session=DB::table("ubaya_sessions")->where("id",1)->first();
        return view("penpos.ubaya.changeSession",compact("session"));
    }
    public function changeSessionUbaya($session){
        DB::table('ubaya_sessions')->where('id', 1)->update(['current' => $session + 1]);
        DB::table('debts as d')
        ->join('debt_options as do', 'd.debt_option_id', '=', 'do.id')
        ->update(['d.interest' => DB::raw('d.interest + ceil(d.interest * (do.interest_rate/100))')]);

        return redirect()->back()->with('success', 'changed session successfully.');
    }

    //leaderboard
    public function leaderboardUbaya(){
        $scores = DB::table('players as p')
            ->join('ubaya as u', 'p.id', '=', 'u.player_id')
            ->leftJoin(DB::raw('(
                SELECT pc.player_id, 
                    SUM(pc.amount * c.capacity) AS total_commodities_capacity
                FROM player_commodities AS pc
                JOIN commodities AS c ON pc.commodity_id = c.id
                GROUP BY pc.player_id
            ) AS aggregated_commodities'), 'p.id', '=', 'aggregated_commodities.player_id')
            ->leftJoin(DB::raw('(
                SELECT pp.player_id, 
                    SUM(pp.amount * prod.capacity) AS total_products_capacity
                FROM player_products AS pp
                JOIN products AS prod ON pp.product_id = prod.id
                GROUP BY pp.player_id
            ) AS aggregated_products'), 'p.id', '=', 'aggregated_products.player_id')
            ->leftJoin(DB::raw('(
                SELECT d.player_id, 
                    COALESCE(SUM(d.interest) + SUM(do.point), 0) AS total_liability
                FROM debts AS d
                LEFT JOIN debt_options AS do ON do.id = d.debt_option_id
                GROUP BY d.player_id
            ) AS aggregated_liabilities'), 'p.id', '=', 'aggregated_liabilities.player_id')
            ->leftJoin(DB::raw('(
                SELECT ch.player_id, 
                    COUNT(*) AS total_heritages
                FROM completed_heritages AS ch
                GROUP BY ch.player_id
            ) AS aggregated_heritages'), 'p.id', '=', 'aggregated_heritages.player_id')
            ->select(
                'p.id',
                'p.username',
                DB::raw('COALESCE(u.point, 0) AS point'),
                DB::raw('COALESCE(aggregated_commodities.total_commodities_capacity, 0) + COALESCE(aggregated_products.total_products_capacity, 0) AS total_space_taken'),
                DB::raw('COALESCE(aggregated_liabilities.total_liability, 0) AS liability'),
                DB::raw('ROUND(COALESCE(u.point, 0) / COALESCE(NULLIF(aggregated_liabilities.total_liability, 0), 1), 2) AS cr'),
                DB::raw('ROUND((COALESCE(u.point, 0) - COALESCE(aggregated_commodities.total_commodities_capacity, 0) - COALESCE(aggregated_products.total_products_capacity, 0)) / COALESCE(NULLIF(aggregated_liabilities.total_liability, 0), 1), 2) AS qr'),
                DB::raw('COALESCE(aggregated_heritages.total_heritages, 0) AS heritage'),
                DB::raw('COALESCE(((COALESCE(u.point, 0) * 2 - COALESCE(aggregated_commodities.total_commodities_capacity, 0) - COALESCE(aggregated_products.total_products_capacity, 0)) / COALESCE(NULLIF(aggregated_liabilities.total_liability, 0), 1)) * (250 * COALESCE(aggregated_heritages.total_heritages, 0)), 0) AS score')
            )
            ->orderBy('score', 'DESC')
            ->get();

        return view("penpos.ubaya.leaderboard",compact("scores"));
    }
}
