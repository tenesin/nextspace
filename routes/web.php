<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NextspaceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\NextspaceController as AdminNextspaceController;
use Illuminate\Support\Facades\Auth; // Import Auth facade

Route::get('/', function () {
    // Check if user is authenticated
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.nextspaces.index');
        }
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home'); // Give the root route a name for easier reference

Route::get('/dashboard', [NextspaceController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/nextspaces/{id}', [NextspaceController::class, 'show'])->name('nextspaces.show');

Route::get('/payment/{nextspace_id}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/history', [HistoryController::class, 'index'])->middleware('auth')->name('history.index');
Route::get('/history/{booking_id}', [HistoryController::class, 'showBookingDetails'])->name('history.show');

Route::get('/qr-code/{data}', [QrCodeController::class, 'generate'])->name('qr.generate');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('nextspaces', AdminNextspaceController::class);
});

require __DIR__.'/auth.php';
