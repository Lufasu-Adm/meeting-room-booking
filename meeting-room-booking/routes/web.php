<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminDashboardController; // tambahkan jika belum

// Halaman awal (landing)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard umum (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute untuk user yang sudah login
Route::middleware(['auth'])->group(function () {

    // ------------------ PROFIL ------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------ BOOKING (USER) ------------------
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');

    // ------------------ DASHBOARD & VALIDASI (ADMIN) ------------------
    Route::middleware(['can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::prefix('bookings')->group(function () {
            Route::get('/requests', [BookingController::class, 'requests'])->name('bookings.requests');
            Route::post('/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
            Route::post('/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
        });
    });
});

// Rute auth bawaan Breeze
require __DIR__.'/auth.php';