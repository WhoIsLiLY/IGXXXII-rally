<?php

namespace App\Models\ubaya;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtOption extends Model
{
    use HasFactory;
    protected $table="debt_options";
    protected $primaryKey="id";

    public function debts(){
        return $this->hasMany(Debt::class,"debt_option_id");
    }
}
