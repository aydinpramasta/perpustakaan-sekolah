<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'register')->name('register');
    Route::view('/login', 'login')->name('login');
});
