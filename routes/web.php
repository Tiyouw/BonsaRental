<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('landing');

// REGISTER
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'submitRegister'])->name('register.submit');

// LOGIN
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login/submit', [PageController::class, 'submitLogin'])->name('login.submit');

// DASHBOARD
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboardPelanggan', [PageController::class, 'dashboardPelanggan'])->name('dashboardPelanggan');

// PRODUK
Route::get('/detailProduk/{id}', [PageController::class, 'detailProduk'])->name('detailProduk');
Route::post('/detailProduk/{id}/upload-bukti', [PageController::class, 'uploadBukti'])->name('uploadBukti');

// PROFILE
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/profilePelanggan', [PageController::class, 'profilePelanggan'])->name('profilePelanggan');

// RIWAYAT
Route::get('/riwayat', [PageController::class, 'riwayatBooking'])->name('riwayatBooking');
Route::get('/riwayatAdmin', [PageController::class, 'riwayatAdmin'])->name('riwayatAdmin');
Route::post('/sewa', [App\Http\Controllers\PageController::class, 'processSewa'])->name('processSewa');

// PENGELOLAAN
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');

// LOGOUT
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboardPelanggan', [PageController::class, 'dashboardPelanggan'])->name('dashboardPelanggan');
//     Route::get('/detailProduk/{id}', [PageController::class, 'detailProduk'])->name('detailProduk');
//     Route::post('/detailProduk/{id}/upload-bukti', [PageController::class, 'uploadBukti'])->name('uploadBukti');
//     Route::get('/profilePelanggan', [PageController::class, 'profilePelanggan'])->name('profilePelanggan');
//     Route::get('/riwayat', [PageController::class, 'riwayatBooking'])->name('riwayatBooking');
//     Route::get('/logout', function () {
//         Session::flush();
//         Auth::logout(); // Gunakan Auth::logout()
//         return redirect()->route('login')->with('success', 'Berhasil logout.');
//     })->name('logout');
// });

// Route::middleware(['auth', 'can:admin-access'])->group(function () { // 'can:admin-access' butuh Gate/Policy
//     Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
//     Route::get('/profile', [PageController::class, 'profile'])->name('profile');
//     Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
//     Route::get('/riwayatAdmin', [PageController::class, 'riwayatAdmin'])->name('riwayatAdmin');
//     // Tambahkan route untuk edit/hapus produk dll.
// });
