<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KatalogController;
// use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PengelolaanController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Guest routes (including landing)
Route::middleware('guest')->group(function () {
    // Landing page
    Route::get('/', function () {
        return view('landing');
    })->name('landing');

    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');

    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Customer routes
    Route::middleware('customer')->group(function () {
        // Katalog
        Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');

        // Profile
        Route::get('/profile/pelanggan', [ProfilController::class, 'show'])->name('profilePelanggan');
        Route::get('/detailProduk/{id}', [KatalogController::class, 'detailProduk'])->name('detailProduk');
        Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('profilePelanggan.edit');
        Route::put('/profile/update', [ProfilController::class, 'update'])->name('profilePelanggan.update');
        // Booking routes
        Route::get('/booking/{id}', [BookingController::class, 'form'])->name('booking.form');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/riwayat', [BookingController::class, 'riwayatBooking'])->name('riwayatBooking');
        Route::get('/booking/detail/{id}', [BookingController::class, 'show'])->name('booking.show');
        Route::post('/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
        Route::post('/booking/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('uploadBukti');
    });

    // Admin routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

        // Set dashboard as home for admin
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        // Admin Profile
        Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('admin.profile');
        Route::get('/profile/edit', [App\Http\Controllers\Admin\UserController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('/profile/update', [App\Http\Controllers\Admin\UserController::class, 'updateProfile'])->name('admin.profile.update');

        // Riwayat Admin
        Route::get('/riwayat', function () {
            return view('admin.riwayat
            Admin');
        })->name('admin.riwayatAdmin');

        // Pengelolaan routes
        Route::get('/pengelolaan', [PengelolaanController::class, 'index'])->name('pengelolaan.index');
        Route::get('/pengelolaan/tambah', [PengelolaanController::class, 'create'])->name('pengelolaan.create');
        Route::post('/pengelolaan', [PengelolaanController::class, 'store'])->name('pengelolaan.store');
        Route::get('/pengelolaan/{id}/edit', [PengelolaanController::class, 'edit'])->name('pengelolaan.edit');
        Route::put('/pengelolaan/{id}', [PengelolaanController::class, 'update'])->name('pengelolaan.update');
        Route::delete('/pengelolaan/{id}', [PengelolaanController::class, 'destroy'])->name('pengelolaan.destroy');

        // Admin booking management
        Route::prefix('bookings')->name('admin.bookings.')->group(function () {
            Route::get('/', [AdminBookingController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminBookingController::class, 'show'])->name('show');
            Route::put('/{id}/status-booking', [AdminBookingController::class, 'updateStatusBooking'])->name('update-status-booking');
            Route::put('/{id}/status-sewa', [AdminBookingController::class, 'updateStatusSewa'])->name('update-status-sewa');
            Route::delete('/{id}', [AdminBookingController::class, 'destroy'])->name('destroy');
        });
    });
});
