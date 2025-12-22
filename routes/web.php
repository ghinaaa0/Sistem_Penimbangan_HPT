<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HptController;

Route::get('/', function () {
    return view('index');
});

Route::get('/forgot-password', function () {
    return 'Halaman lupa password nanti di sini.';
})->name('password.request');

Route::resource('hpt', HptController::class);
