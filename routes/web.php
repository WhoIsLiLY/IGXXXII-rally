<?php

use App\Http\Controllers\kotalama;
use App\Models\buses;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kotalama/index/{id}', [kotalama::class,'kotalamaData']);
?>