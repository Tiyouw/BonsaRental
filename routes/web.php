<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\Admin\PengelolaanController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    // Login
    Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('auth/login', [AuthController::class, 'login'])->name('login.submit');

    // Register
    Route::get('auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('auth/register', [AuthController::class, 'register'])->name('register.submit');

    // Redirect root to login for guests
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile for all users
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Customer routes
    Route::middleware('customer')->group(function () {
        // Katalog & Booking
        Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
        Route::get('/detailProduk/{id}', [KatalogController::class, 'detailProduk'])->name('detailProduk');
        
        // Booking routes
        Route::get('/booking/{id}', [BookingController::class, 'form'])->name('booking.form');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/booking/riwayat', [BookingController::class, 'riwayatBooking'])->name('riwayatBooking');
        Route::get('/booking/detail/{id}', [BookingController::class, 'show'])->name('booking.show');
        Route::post('/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
        Route::post('/booking/{id}/upload-bukti', [BookingController::class, 'uploadBukti'])->name('uploadBukti');

        // Set katalog as home for customers
        Route::get('/', function () {
            return redirect()->route('katalog');
        });
    });

    // Admin routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Set dashboard as home for admin
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

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
