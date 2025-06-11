<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriController as Kategori;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('landing');

Route::prefix('admin')->group(function() {
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori', Kategori::class);
});


// REGISTER
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::post('/register', [PageController::class, 'submitRegister'])->name('register.submit');

// LOGIN
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'submitLogin'])->name('login.submit');

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


// PENGELOLAAN
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');

// LOGOUT
Route::get('/logout', function () {
    // Session::flush();
    return redirect()->route('login')->with('success', 'Berhasil logout.');
})->name('logout');
