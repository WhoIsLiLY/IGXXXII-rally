<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    protected $table = 'lokets';
    protected $fillable = [];
    protected $primaryKey = 'id';
    use HasFactory;

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