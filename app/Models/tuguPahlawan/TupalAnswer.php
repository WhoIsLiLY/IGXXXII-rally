<?php

namespace App\Models\tuguPahlawan;

use App\Models\Player;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TupalAnswer extends Model
{
    use HasFactory;
    protected $table = 'tupal_answers';
    protected $fillable = [
        'player_id', 'tupal_question_id', 'answer', 'status',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tupalQuestion()
    {
        return $this->belongsTo(TupalQuestion::class);
    }
}
