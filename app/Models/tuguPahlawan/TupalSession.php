<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TupalSession extends Model
{
    use HasFactory;
    protected $table = 'tupal_sessions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'open', 'close', 'boost',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
