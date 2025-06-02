<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NextspaceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\QrCodeController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/nextspaces/{id}', [NextspaceController::class, 'show'])->name('nextspaces.show');

Route::get('/payment/{nextspace_id}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

Route::get('/history', [HistoryController::class, 'index'])->middleware('auth')->name('history.index');

// --- NEW QR CODE GENERATION ROUTE ---
Route::get('/qr-code/{data}', [QrCodeController::class, 'generate'])->name('qr.generate');

require __DIR__.'/auth.php';