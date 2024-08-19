<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KotaLama extends Model
{
    use HasFactory;

    protected $table = 'kotalama';

    protected $fillable = [
        'total_passangers',
        'total_duration',
        'player_id'
    ];

    public function player() : BelongsTo {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
