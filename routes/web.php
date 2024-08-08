<?php

use App\Http\Controllers\PesertaKotalamaController;
use App\Http\Controllers\PenposKotalamaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/peserta/kotalama/{id}', [PesertaKotalamaController::class,'kotalamaData']);
Route::get('/penpos/kotalama', [PenposKotalamaController::class,'penposData']);
?>