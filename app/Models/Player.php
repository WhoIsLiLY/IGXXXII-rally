<?php

namespace App\Models;

<<<<<<< Updated upstream
use App\Models\tuguPahlawan\Loket;
use App\Models\tuguPahlawan\Tupal;
use App\Models\tuguPahlawan\StandAd;
use App\Models\tuguPahlawan\TupalLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
>>>>>>> Stashed changes

class Player extends Model
{
    use HasFactory;

<<<<<<< Updated upstream
    // Nama tabel yang berhubungan
    protected $table = 'players';
    protected $primaryKey = 'id';
    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kolom1',
        'nama_kolom2',
        // Tambahkan semua kolom yang diizinkan untuk diisi
    ];

    // Function untuk mengambil data player berdasarkan ID
    public static function getPlayerById($id)
    {
        return self::with(['tupals', 'standsAds', 'tupalLogs', 'lokets'])->findOrFail($id);
    }

    // Function untuk mengambil semua players
    public static function getAllPlayers()
    {
        return self::all();
    }

    // Function untuk mencari player berdasarkan nama
    public static function searchPlayerByName($name)
    {
        return self::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    // Relationship dengan tabel `tupals`
    public function tupals()
    {
        return $this->hasMany(Tupal::class, 'player_id');
    }

    // Relationship dengan tabel `stands_ads`
    public function standsAds()
    {
        return $this->hasMany(StandAd::class, 'player_id');
    }

    // Relationship dengan tabel `tupal_logs`
    public function tupalLogs()
    {
        return $this->hasMany(TupalLog::class, 'player_id');
    }

    // Relationship dengan tabel `lokets`
    public function lokets()
    {
        return $this->hasMany(Loket::class, 'player_id');
=======
    protected $table = 'players';

    protected $fillable = [
        'skor',
        'user_id'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
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
        return $this->hasOne(Ubaya::class, 'player_id');
    }

    public function ubayaLogs() : HasMany {
        return $this->hasMany(UbayaLog::class, 'player_id');
    }

    public function debts() : HasMany {
        return $this->hasMany(Debt::class, 'player_id');
    }

    public function commodities() : BelongsToMany {
        return $this->belongsToMany(
            Commodity::class, 
            'inventory',
            'player_id',
            'commodity_id'
        )
        ->withPivot(['ammount'])
        ->withTimestamps();
    }

    public function ubayaSessions() : BelongsToMany {
        return $this->belongsToMany(
            UbayaSession::class,
            'ubaya_trends',
            'player_id',
            'ubaya_session_id'
        )
        ->withTimestamps();
>>>>>>> Stashed changes
    }
}
