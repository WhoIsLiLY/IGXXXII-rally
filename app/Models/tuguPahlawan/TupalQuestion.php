<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Model;
use App\Models\tuguPahlawan\TupalAnswer;
use App\Models\tuguPahlawan\TupalChoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TupalQuestion extends Model
{
    use HasFactory;
    protected $table = 'tupal_questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'question', 'answer', 'point'
    ];

    public function tupalChoices()
    {
        return $this->hasMany(TupalChoice::class);
    }

    public function tupalAnswers()
    {
        return $this->hasMany(TupalAnswer::class);
    }
}
