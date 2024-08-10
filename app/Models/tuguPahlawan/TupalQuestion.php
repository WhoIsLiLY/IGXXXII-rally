<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalQuestion extends Model
{
    protected $table = 'tupal_questions';
    protected $fillable = [];
    protected $primaryKey = 'id';
    use HasFactory;
}
