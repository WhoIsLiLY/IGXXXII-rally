<?php

use App\Http\Controllers\kotalama;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kotalama', [kotalama::class,'userData']);
?>