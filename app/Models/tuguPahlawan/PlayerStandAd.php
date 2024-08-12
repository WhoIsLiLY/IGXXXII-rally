<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerStandAd extends Model
{
    use HasFactory;
    protected $table = 'players_stands_ads';
    protected $primaryKey = 'id';
    protected $fillable = [
        'player_id', 'stand_ads_id',
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
