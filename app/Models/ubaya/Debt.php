<?php

namespace App\Models\ubaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;
use App\Models\ubaya\DebtOption;

class Debt extends Model
{
    use HasFactory;
    protected $table = 'debts';
    protected $primaryKey = 'id';
    protected $fillable = ['player_id', 'debt_option_id', 'interest', 'status'];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function debtOption()
    {
        return $this->belongsTo(DebtOption::class, 'debt_option_id');
    }
}
