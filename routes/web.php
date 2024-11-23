<?php

use App\Http\Controllers\DashboardListrikController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataListrikController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Home Route
    Route::get('/', [DashboardListrikController::class, 'indexhome'])->name('home');

    // Data Listrik Routes
    Route::get('/data-listrik', [DataListrikController::class, 'index'])->name('data-listrik.index');
    Route::post('/data-listrik', [DataListrikController::class, 'store'])->name('data-listrik.store');

    // Datalistrik Routes
    Route::get('/datalistrik', [DashboardListrikController::class, 'index'])->name('datalistrik.index');
    Route::get('/ubah-listrik', [DashboardListrikController::class, 'indexubah'])->name('ubah-listrik.indexubah');
    Route::post('/ubah-listrik', [DashboardListrikController::class, 'store'])->name('ubah-listrik.store');

    // Gallery Routes
    Route::get('/gallery', [GalleryController::class, 'indexhome'])->name('gallery.indexhome');
    Route::get('/gallery-delete', [GalleryController::class, 'indexdelete'])->name('gallery.indexdelete');
    Route::get('/gallery-ubah', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery-ubah', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');

    // Admin Dashboard Route
    Route::get('/dashboard', function () {
        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            return view('admin.dashboard');
        }
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    })->name('admin.dashboard');
});

// Guest Routes (for login and registration)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('signup', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('signup', [RegisterController::class, 'register'])->name('signup');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Email Check Route (for registration)
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');


