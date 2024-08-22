<?php

namespace App\Models\ubaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class Ubayas extends Model
{
    use HasFactory;

    protected $table = 'ubaya';
    protected $fillable = ['inventory', 'point'];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
