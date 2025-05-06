<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page
Route::get('/', [PageController::class, 'landing'])->name('landing');

// Login
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', function(\Illuminate\Http\Request $request) {
    $username = $request->input('username');
    return redirect()->route('dashboard', ['username' => $username]);
})->name('login.submit');

// Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Profile
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Pengelolaan
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');
