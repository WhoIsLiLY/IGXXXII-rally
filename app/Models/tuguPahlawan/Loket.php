<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loket extends Model
{
    use HasFactory;
    protected $table = 'lokets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'player_id', 'service_time',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    public static function BuyLoketFor($loketId, $playerId){
        // update the existing loket
    }
    public static function ShowAvailableLoket(){
        // menampilkan loket (3-5) ke UI user, pertimbangannya random atau sesuai urutan
    }
    public static function UpgradeLoketById($loketId){
        // upgrade loket service_time player by loket id
    }
}