<?php

namespace App\Models;

use App\Models\ubaya\Debt;
use App\Models\ubaya\Ubaya;
use App\Models\ubaya\Ubayas;
use App\Models\ubaya\UbayaLog;
use App\Models\tuguPahlawan\Loket;

use App\Models\tuguPahlawan\Tupal;
use App\Models\tuguPahlawan\TupalLog;
use Illuminate\Database\Eloquent\Model;

use App\Models\tuguPahlawan\TupalAnswer;
use App\Models\tugupahlawan\PlayerSession;
use App\Models\tuguPahlawan\PlayerStandAd;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = [
        'skor',
        'user_id'
    ];

    // RELATIONSHIP

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ===== Tugu Pahlawan =====

    public function tupals() : HasOne {
        return $this->hasOne(Tupal::class,'player_id');
    }

    public function tupalAnswers() : HasMany {
        return $this->hasMany(TupalAnswer::class,'player_id');
    }

    public function lokets() : HasMany {
        return $this->hasMany(Loket::class,'player_id');
    }

    public function tupalLogs() : HasMany {
        return $this->hasMany(TupalLog::class,'player_id');
    }

    public function playersStandsAds() : HasMany {
        return $this->hasMany(PlayerStandAd::class,'player_id');
    }

    public function playerSession() : HasMany {
        return $this->hasMany(PlayerSession::class);
    }

    public function tupalSessions() : BelongsToMany {
        return $this->belongsToMany(
            City::class, 
            'tupal_boost', //tabel hasil many to many
            'player_id', //pk di maps
            'tupal_session_id' //pk dari many to many yg lain
        )
        ->withTimestamps();
    }

    // ===== Kota Lama =====

    public function kotaLama() : HasOne {
        return $this->hasOne(KotaLama::class, 'player_id');
    }

    public function bus() : HasOne {
        return $this->hasOne(Bus::class, 'player_id');
    }

    public function klLog() : HasMany{
        return $this->hasMany(KlLog::class, 'player_id');
    }

    public function cities() : BelongsToMany {
        return $this->belongsToMany(
            City::class, 
            'maps', //tabel hasil many to many
            'player_id', //pk di maps
            'city_id' //pk dari many to many yg lain
        )
        ->withTimestamps();
    }

    // ===== Ubaya =====

    public function ubaya() : HasOne {
        return $this->hasOne(Ubayas::class, 'player_id');
    }

    public function ubayaLogs() : HasMany {
        return $this->hasMany(UbayaLog::class, 'player_id');
    }

    public function debts() : HasMany {
        return $this->hasMany(Debt::class, 'player_id');
    }
}
