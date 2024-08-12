<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalBoost extends Model
{
    use HasFactory;
    protected $table = 'tupal_boost';
    protected $fillable = [
        'player_id', 'tupal_session_id',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tupalSession()
    {
        return $this->belongsTo(TupalSession::class);
    }
}
