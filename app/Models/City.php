<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'passenger'
    ];

    public function player() : BelongsToMany {
        return $this->belongsToMany(
            Player::class,
            'maps',
            'city_id',
            'player_id'
        )
        ->withTimestamps();
    }
}
