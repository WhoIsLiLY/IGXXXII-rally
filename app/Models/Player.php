<?php

namespace App\Models;

use App\Models\tuguPahlawan\Loket;
use App\Models\tuguPahlawan\Tupal;
use App\Models\tuguPahlawan\StandAd;
use App\Models\tuguPahlawan\TupalLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

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
        return self::find($id);
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
    }
}
