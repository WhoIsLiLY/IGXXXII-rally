<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerStandAd extends Model
{
    use HasFactory;
    protected $table = 'players_stands_ads';
    public $incrementing = false;
    protected $primaryKey = ['player_id', 'stand_ad_id'];
    protected $fillable = [
        'player_id', 'stand_ad_id', 'amount'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function standAd()
    {
        return $this->belongsTo(StandAd::class);
    }
}
