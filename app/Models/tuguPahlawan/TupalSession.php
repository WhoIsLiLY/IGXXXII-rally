<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalSession extends Model
{
    protected $table = 'tupal_sessions';
    protected $fillable = [];
    protected $primaryKey = 'id';
    use HasFactory;
}
