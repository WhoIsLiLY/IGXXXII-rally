<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalLog extends Model
{
    use HasFactory;
    protected $table = 'tupal_logs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'player_id', 'desc',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    public static function AddLog($id){
        // add new log with player_id
    }
    public static function ShowAllLog($id){
        // show all player logs
    }
}
