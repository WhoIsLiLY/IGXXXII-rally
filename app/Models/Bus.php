<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'buses';

    protected $fillable = [
        'fuel',
        'passanger',
        'player_id'
    ];

    public function player() : BelongsTo {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
