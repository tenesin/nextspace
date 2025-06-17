<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NextspaceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\NextspaceController as AdminNextspaceController;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    // Check if user is authenticated
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.nextspaces.index');
        }
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');


Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');



Route::get('/dashboard', [NextspaceController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/booking/{booking}/checkin', [HistoryController::class, 'checkIn'])->name('booking.checkin');
Route::delete('/booking/{booking}/cancel', [HistoryController::class, 'cancel'])->name('booking.cancel');

Route::get('/nextspaces/{id}', [NextspaceController::class, 'show'])->name('nextspaces.show');

Route::get('/payment/{nextspace_id}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/payment/penalty/{booking}', [PaymentController::class, 'penalty'])->name('payment.penalty');

Route::get('/history', [HistoryController::class, 'index'])->middleware('auth')->name('history.index');
Route::get('/history/{booking_id}', [HistoryController::class, 'showBookingDetails'])->name('history.show');
Route::delete('/history/remove/{booking}', [HistoryController::class, 'remove'])->name('history.remove');

Route::get('/qr-code/{data}', [QrCodeController::class, 'generate'])->name('qr.generate');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // IMPORTANT: Place specific routes like 'export-report' BEFORE resource routes.
    Route::get('nextspaces/export-report', [AdminNextspaceController::class, 'exportReport'])->name('nextspaces.export-report');
    Route::resource('nextspaces', AdminNextspaceController::class);
});

// Reviews
Route::post('/reviews/{booking}', [ReviewController::class, 'store'])->name('reviews.store');

// Penalty Payment
// Note: You have this route defined twice. Keep only one.
Route::get('/payment/penalty/{booking}', [PaymentController::class, 'penalty'])->name('payment.penalty');
Route::post('/payment/penalty/{booking}', [PaymentController::class, 'payPenalty'])->name('payment.penalty.pay');

// Favorites
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle/{nextspace}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

Route::get('/history/{booking_id}/invoice', [HistoryController::class, 'invoice'])->name('history.invoice');

require __DIR__.'/auth.php';