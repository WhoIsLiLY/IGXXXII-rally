<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UbayaSession extends Model
{
    use HasFactory;

    protected $table = 'ubaya_sessions';

    protected $fillable = [
        'open',
        'close',
        'boost'
    ];

    public function player() : BelongsToMany {
        return $this->belongsToMany(
            Player::class,
            'ubaya_trends',
            'ubaya_session_id',
            'player_id'
        )
        ->withTimestamps();
    }
}
