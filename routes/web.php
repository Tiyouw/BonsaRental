<?php

use App\Http\Controllers\PageController;
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
Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('dashboardPelanggan', [PageController::class, 'dashboardPelanggan'])->name('dashboardPelanggan');

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
Route::get('/riwayatAdmin', [PageController::class, 'riwayatAdmin'])->name('riwayatAdmin');


// PENGELOLAAN
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');

// LOGOUT
Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');
