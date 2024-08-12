<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
