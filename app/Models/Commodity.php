<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Commodity extends Model
{
    use HasFactory;

    protected $table = 'commodities';

    protected $fillable = [
        'name'
    ];

    public function players() : BelongsToMany {
        return $this->belongsToMany(
            Player::class,
            'inventory',
            'commodity_id',
            'player_id'
        )
        ->withPivot(['ammount'])
        ->withTimestamps();
    }
}
