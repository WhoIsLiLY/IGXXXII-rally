<?php

namespace App\Models\tugupahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerSession extends Model
{
    use HasFactory;

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tupalSession()
    {
        return $this->belongsTo(TupalSession::class);
    }
}
