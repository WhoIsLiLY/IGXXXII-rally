<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DebtOption extends Model
{
    use HasFactory;

    protected $table = 'debt_options';

    protected $fillable = [
        'poin',
        'interest'
    ];

    public function debts() : HasMany {
        return $this->hasMany(Debt::class, 'debt_option_id');
    }
}
