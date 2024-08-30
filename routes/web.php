<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaKotalamaController;
use App\Http\Controllers\PenposKotalamaController;
use App\Http\Controllers\PenposTuguPahlawanController;
use App\Http\Controllers\PesertaTuguPahlawanController;
use App\Http\Controllers\PenposUbayaController;
use App\Http\Controllers\PesertaUbayaController;
use App\Models\Player;
use Illuminate\Support\Facades\Route; 

Route::middleware('guest_')->group(function () {
    Route::get('/', function () {
        return view('login');
    });

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

// Route::get('/peserta/kotalama/{id}', [PesertaKotalamaController::class,'kotalamaData']);
// Route::get('/penpos/kotalama', [PenposKotalamaController::class,'penposData']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

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

        //kotalama
        Route::post('/insert-maps', [PenposKotaLamaController::class, 'insert'])->name('insert.maps');
        Route::get('/kotalama', [PenposKotalamaController::class, 'penposData'])->name('kotalama'); 

        //tugupahlawan
        Route::get('/list-player-tg/{action}/{id}', [PenposTuguPahlawanController::class, 'showListPlayer'])->name('listPlayer');
        Route::post('/buy-loket/{player:username}', [PenposTuguPahlawanController::class, 'buyLoketsById'])->name('buyLoketById'); // change
        Route::get('/buy-loket/{player:username}', [PenposTuguPahlawanController::class, 'buyLoketsByPlayer'])->name('buyLoket');
        Route::get('/upgrade-loket/{player:username}', [PenposTuguPahlawanController::class, 'upgradeLoketsByPlayer'])->name('upgradeLoket');
        Route::post('/upgrade-loket/{player:username}/{loket}/{price}', [PenposTuguPahlawanController::class, 'upgradeLoketById'])->name('upgradeLoketById');
        Route::get('/buy-stand/{player:username}', [PenposTuguPahlawanController::class, 'buyStandsByPlayer'])->name('buyStand');
        Route::post('/buy-stand/{player:username}/{stand}', [PenposTuguPahlawanController::class, 'buyStandAdById'])->name('buyStandById');
        Route::get('/buy-ad/{player:username}', [PenposTuguPahlawanController::class, 'buyAdsByPlayer'])->name('buyAd');
        Route::post('/buy-ad/{player:username}/{ad}', [PenposTuguPahlawanController::class, 'buyStandAdById'])->name('buyAdById');
        Route::get('/change-session-tg', [PenposTuguPahlawanController::class, 'changeSessionPage'])->name('changeSession');
        Route::post('/change-session-tg/{session}', [PenposTuguPahlawanController::class, 'changeSession'])->name('changeSessionHandle');
        Route::post('/validate-score', [PenposTuguPahlawanController::class, 'validatePlayersScore'])->name('validateScore');

        //ubaya
        Route::get('/bank/{player:username}', [PenposUbayaController::class, 'bank'])->name('bank');
        Route::get('/debt/{player:username}', [PenposUbayaController::class, 'debtOption'])->name('debtOption');
        Route::get('/debt/{player:username}/{id}', [PenposUbayaController::class, 'debtByID'])->name('debtByID');
        Route::get('/pay/{player:username}', [PenposUbayaController::class, 'payOption'])->name('payOption');
        Route::get('/pay/{player:username}/{id}', [PenposUbayaController::class, 'payByID'])->name('payByID');
        Route::get('/commodity/{player:username}', [PenposUbayaController::class, 'commodityOption'])->name('commodityOption');
        Route::get('/commodity/{player:username}/{id}/{amount}', [PenposUbayaController::class, 'commodityByID'])->name('commodityByID');
        Route::get('/product/{player:username}', [PenposUbayaController::class, 'productOption'])->name('productOption');
        Route::get('/product/{player:username}/{productID}/{qcID}/{amount}', [PenposUbayaController::class, 'production'])->name('production');
        Route::get('/heritage/{player:username}', [PenposUbayaController::class, 'heritageOption'])->name('heritageOption');
        Route::get('/heritage/{player:username}/{heritageID}', [PenposUbayaController::class, 'heritageCompletion'])->name('heritageCompletion');
        Route::get('/inventory/{player:username}', [PenposUbayaController::class, 'inventory'])->name('inventory');
        Route::get('/inventory/{player:username}/{upgrade}', [PenposUbayaController::class, 'inventoryUpgrade'])->name('inventoryUpgrade');
        Route::get('/changeSession', [PenposUbayaController::class, 'changeSessionUbayaPage'])->name('changeSessionUbaya');
        Route::get('/changeSession/{session}', [PenposUbayaController::class, 'changeSessionUbaya'])->name('changeSessionUbayaHandle');
        Route::get('/leaderboard', [PenposUbayaController::class, 'leaderboardUbaya'])->name('ubayaLeaderboard');
    }
);

// ===== Peserta Route =====
Route::group(
    ['middleware' => 'peserta', 'prefix' => 'peserta', 'as' => 'peserta.'],
    function () {
        Route::get('/');
        // KOTA LAMA
        Route::get('/kotalama', [PesertaKotalamaController::class, 'showpage'])->name('kotalama');
        Route::post('/kotalama/move-city', [PesertaKotalamaController::class, 'moveCity'])->name('move.city');

        // TUGU PAHLAWAN
        Route::get('/tugupahlawan', [PesertaTuguPahlawanController::class, 'showPage'])->name('tugupahlawan');
        Route::post('/tugupahlawan/question/check', [PesertaTuguPahlawanController::class, 'checkQuestion'])->name('question.check');
        Route::post('/tugupahlawan/answer/check', [PesertaTuguPahlawanController::class, 'checkAnswer'])->name('answer.check');

        // UBAYA
        Route::get('/ubaya', [PesertaUbayaController::class, 'showPage'])->name('ubaya');
    }
);
?>