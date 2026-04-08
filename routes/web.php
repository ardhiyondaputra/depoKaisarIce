<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Redirect root ke login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Aktifkan route login, register, logout Laravel UI
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/recovery-password', function () {
    return view('auth.recovery-password');
})->name('password.recovery.form');


Route::post('/recovery-password',
    [App\Http\Controllers\Auth\RecoveryPasswordController::class, 'check']
)->name('password.recovery.check');


Route::post('/recovery-password/reset',
    [App\Http\Controllers\Auth\RecoveryPasswordController::class, 'reset']
)->name('password.recovery.reset');

Route::get('/recovery-password/reset', function () {
    return view('auth.recovery-reset-password');
})->name('password.recovery.reset.form');
/*
|--------------------------------------------------------------------------
| Dashboard setelah login
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/change-password', function () {
    return view('auth.change-password');
})->middleware('auth')->name('password.change.form');


Route::post('/change-password', 
    [App\Http\Controllers\Auth\ChangePasswordController::class, 'update']
)->middleware('auth')->name('password.change.update');