<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

