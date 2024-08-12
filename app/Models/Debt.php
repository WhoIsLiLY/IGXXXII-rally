<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debt';

    protected $fillable = [
        'debt',
        'player_id',
        'debt_option_id'
    ];

    public function player() : BelongsTo {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function debt_option() : BelongsTo {
        return $this->belongsTo(DebtOption::class, 'debt_option_id');
    }
}
