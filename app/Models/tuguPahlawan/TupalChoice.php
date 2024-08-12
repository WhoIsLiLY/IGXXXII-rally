<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalChoice extends Model
{
    use HasFactory;
    protected $table = 'tupal_choices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'soal_tupal_id', 'name', 'answer',
    ];

    public function tupalQuestion()
    {
        return $this->belongsTo(TupalQuestion::class);
    }
}
