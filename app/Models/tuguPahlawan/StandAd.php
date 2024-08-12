<?php

namespace App\Models\tuguPahlawan;

use App\Models\tuguPahlawan\PlayerStandAd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StandAd extends Model
{
    use HasFactory;
    protected $table = 'stands_ads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'type',
    ];

    public function playersStandsAds()
    {
        return $this->hasMany(PlayerStandAd::class);
    }

    public static function BuyStandFor($standAdId, $playerId){
        // update the existing stands_ads for type = Stand
    }
    public static function BuyAdFor($standAdId, $playerId){
        // update the existing stands_ads for type = Ad
    }
}
