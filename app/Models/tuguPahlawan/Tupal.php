<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use App\Models\tuguPahlawan\TupalBoost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tupal extends Model
{
    use HasFactory;
    protected $table = 'tupals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'player_id', 'serve', 'reject',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tupalBoosts()
    {
        return $this->hasMany(TupalBoost::class);
    }
}
