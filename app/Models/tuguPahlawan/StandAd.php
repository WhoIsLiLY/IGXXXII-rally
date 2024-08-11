<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandAd extends Model
{
    protected $table = 'stands_ads';
    protected $fillable = [];
    protected $primaryKey = 'id';
    use HasFactory;

    public static function BuyStandFor($standAdId, $playerId){
        // update the existing stands_ads for type = Stand
    }
    public static function BuyAdFor($standAdId, $playerId){
        // update the existing stands_ads for type = Ad
    }
}
