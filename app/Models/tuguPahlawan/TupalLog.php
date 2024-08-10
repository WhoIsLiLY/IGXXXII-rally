<?php

namespace App\Models\tuguPahlawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TupalLog extends Model
{
    protected $table = 'tupal_logs';
    protected $fillable = [];
    protected $primaryKey = 'id';
    use HasFactory;
}
