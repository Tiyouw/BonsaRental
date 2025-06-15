<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\admin\PengelolaanController;
use App\Http\Controllers\admin\ProdukController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [PageController::class, 'landing'])->name('landing');

// REGISTER
Route::get('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/register', [AuthController::class, 'submitRegister'])->name('register.submit');

// LOGIN
Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'submitLogin'])->name('login.submit');

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('auth');

// Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
// Route::get('dashboardPelanggan', [PageController::class, 'dashboardPelanggan'])->name('dashboardPelanggan');

Route::get('/admin/dashboard', [PageController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/pelanggan/dashboardPelanggan', [PageController::class, 'dashboardPelanggan'])->name('pelanggan.dashboardPelanggan');

// PRODUK
Route::get('/detailProduk/{id}', [PageController::class, 'detailProduk'])->name('detailProduk');
Route::post('/detailProduk/{id}/upload-bukti', [PageController::class, 'uploadBukti'])->name('uploadBukti');

// TAMBAH PRODUK
// Route::get('/tambahProduk', [PageController::class, 'create'])->name('produk.create');
// Route::post('/tambahProduk', [PageController::class, 'store'])->name('produk.store');

// PROFILE
Route::get('/profile', [ProfilController::class, 'profile'])->name('profile');
Route::get('/profilePelanggan', [ProfilController::class, 'profilePelanggan'])->name('profilePelanggan');
Route::get('/EditProfil', [ProfilController::class, 'edit'])->name('EditProfil');
Route::put('/EditProfil', [ProfilController::class, 'update'])->name('profile.update');
Route::get('/admin/profile', [ProfilController::class, 'profile'])->name('admin.profile');
Route::get('/admin/profile/edit', [ProfilController::class, 'editAdmin'])->name('admin.profile.edit');
Route::put('/admin/profile/update', [ProfilController::class, 'updateAdmin'])->name('admin.profile.update');

// RIWAYAT
Route::get('/riwayat', [PageController::class, 'riwayatBooking'])->name('riwayatBooking');
Route::get('admin/riwayatAdmin', [PageController::class, 'riwayatAdmin'])->name('admin.riwayatAdmin');


// // PENGELOLAAN
// Route::get('admin/pengelolaan', [ProdukController::class, 'index'])->name('admin.pengelolaan');

// LOGOUT
Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

// routes/web.php
Route::prefix('admin')->group(function() {
    Route::get('/pengelolaan', [PengelolaanController::class, 'index'])->name('pengelolaan.index');
    Route::get('/pengelolaan/tambah', [PengelolaanController::class, 'create'])->name('pengelolaan.create');
    Route::post('/pengelolaan', [PengelolaanController::class, 'store'])->name('pengelolaan.store');
    Route::get('/pengelolaan/{id}/edit', [PengelolaanController::class, 'edit'])->name('pengelolaan.edit');
    Route::put('/pengelolaan/{id}', [PengelolaanController::class, 'update'])->name('pengelolaan.update');
    Route::delete('/pengelolaan/{id}', [PengelolaanController::class, 'destroy'])->name('pengelolaan.destroy');
});
