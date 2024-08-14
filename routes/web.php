<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaKotalamaController;
use App\Http\Controllers\PenposKotalamaController;
use App\Http\Controllers\PenposTuguPahlawanController;
use App\Http\Controllers\PesertaTuguPahlawanController;
use App\Models\Player;
use Illuminate\Support\Facades\Route; 

Route::get('/', function () {
    return view('login');
})->middleware('guest_');

// Route::get('/peserta/kotalama/{id}', [PesertaKotalamaController::class,'kotalamaData']);
// Route::get('/penpos/kotalama', [PenposKotalamaController::class,'penposData']);


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest_');
Route::post('login', [LoginController::class, 'login'])->name('login')->middleware('guest_');

//Route::view('/dashboard', "penpos.dashboard")->name('penpos_dashboard');
//Route::view('/kotalama', "penpos.kotalama")->name('kotalama'); //bikin error soalnya cuma view jadi gaada variabel yang disiapin controller
//Route::view('/tupal', "penpos.kotalama")->name('tupal');
//Route::view('/ubaya', "penpos.kotalama")->name('ubaya');

// ===== Penpos Route =====
Route::group(
    ['middleware' => 'penpos', 'prefix' => 'penpos', 'as' => 'penpos.'],
    function () {
        Route::view('/dashboard', "penpos.dashboard")->name('dashboard');
        //Route::get('/', [PenposKotalamaController::class, 'penposData'])->name('penpos.data');
        Route::post('/insert-maps', [PenposKotaLamaController::class, 'insert'])->name('insert.maps');
        Route::get('/kotalama', [PenposKotalamaController::class, 'penposData'])->name('kotalama'); 
        Route::get('/list-player-tg/{action}/{id}', [PenposTuguPahlawanController::class, 'showListPlayer'])->name('listPlayer');
        Route::get('/buy-loket/buy/{player:username}', [PenposTuguPahlawanController::class, 'buyLoketsById'])->name('buyLoketById');
        Route::get('/buy-loket/{player:username}', [PenposTuguPahlawanController::class, 'buyLoketsByPlayer'])->name('buyLoket');
        Route::get('/upgrade-loket/{player:username}', [PenposTuguPahlawanController::class, 'upgradeLoketsByPlayer'])->name('upgradeLoket');
        Route::get('/upgrade-loket/upgrade/{player:username}/{loket}/{price}', [PenposTuguPahlawanController::class, 'upgradeLoketById'])->name('upgradeLoketById');
        Route::get('/buy-stand/{player:username}', [PenposTuguPahlawanController::class, 'buyStandsByPlayer'])->name('buyStand');
        Route::get('/buy-stand/buy/{player:username}/{stand}', [PenposTuguPahlawanController::class, 'buyStandAdById'])->name('buyStandById');
        Route::get('/buy-ad/{player:username}', [PenposTuguPahlawanController::class, 'buyAdsByPlayer'])->name('buyAd');
        Route::get('/buy-ad/buy/{player:username}/{ad}', [PenposTuguPahlawanController::class, 'buyStandAdById'])->name('buyAdById');
    }
);

// ===== Peserta Route =====
Route::group(
    ['middleware' => 'peserta', 'prefix' => 'peserta', 'as' => 'peserta.'],
    function () {
        Route::get('/dashboard', [PesertaKotalamaController::class, 'kotalamaData'])->name('dashboard');
        Route::get('/view-tg/{id}', [PesertaTuguPahlawanController::class, 'showPage'])->name('view.tg');
    }
);
?>