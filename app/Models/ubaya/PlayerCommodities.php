<?php

namespace App\Models\ubaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class PlayerCommodities extends Model
{
    use HasFactory;
    protected $table="player_comodities";
    protected $primarykey = ['player_id','commodity_id'];
    protected $fillable = 'ammount';
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function commodity()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id');
    }
}
