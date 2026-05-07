<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DistribusiController;



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

Auth::routes(['register' => false]);

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
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{id_produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/admin/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('/admin/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('/admin/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/admin/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/admin/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/admin/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::put('/admin/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/admin/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    Route::get('/admin/barang-masuk', [BarangMasukController::class, 'barangmasuk'])->name('barang_masuk.index');
    Route::post('/admin/barang-masuk', [BarangMasukController::class, 'storeBarangMasuk'])->name('barang_masuk.store');
    Route::delete(
    '/admin/barang-masuk/{id}',
    [BarangMasukController::class, 'destroy']
)->name('barang_masuk.destroy');
    
    Route::get('/admin/distribusi', [DistribusiController::class, 'distribusi'])->name('distribusi.index');
    Route::get(
    '/admin/distribusi',
    [DistribusiController::class, 'index']
)->name('distribusi.index');

Route::post(
    '/admin/distribusi',
    [DistribusiController::class, 'store']
)->name('distribusi.store');

Route::delete(
    '/admin/distribusi/{id}',
    [DistribusiController::class, 'destroy']
)->name('distribusi.destroy');

Route::put(
    '/admin/distribusi/status/{id}',
    [DistribusiController::class, 'updateStatus']
)->name('distribusi.updateStatus');

    Route::get('/admin/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');

Route::get('/admin/laporan/cetak', [LaporanController::class, 'cetak'])
    ->name('laporan.cetak');
});
