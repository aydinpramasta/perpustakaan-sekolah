<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::view('/register', 'register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);

    Route::view('/login', 'login')->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
