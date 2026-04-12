<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;


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


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::get('/superadmin/data-admin', [DataAdminController::class, 'index'])->name('DataAdmin.index');
    Route::post('/superadmin/data-admin/store', [DataAdminController::class, 'store'])->name('DataAdmin.store');
    Route::put('/superadmin/data-admin/{id}', [DataAdminController::class, 'update'])->name('DataAdmin.update');
    Route::delete('/admin/data-admin/{id}', [DataAdminController::class, 'destroy'])->name('DataAdmin.destroy');

    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');

    Route::get('/admin/supplier', [SupplierController::class, 'index'])->name('supplier.index');

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');

    Route::get('/admin/barang-masuk', [TransaksiController::class, 'masuk'])->name('barang_masuk.index');

    Route::get('/admin/distribusi', [TransaksiController::class, 'distribusi'])->name('distribusi.index');

    Route::get('/admin/info-stok', [StokController::class, 'info'])->name('info_stok.index');

    Route::get('/admin/riwayat-stok', [StokController::class, 'riwayat'])->name('riwayat_stok.index');

    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});