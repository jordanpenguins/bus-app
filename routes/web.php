<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/schedule', function () {
    return view('schedule');
})->name('schedule');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/purchase', [PurchaseController::class, 'index'])->middleware(['auth', 'verified'])->name('purchase');

Route::get('/depart-schedule', [PurchaseController::class, 'schedule'])->middleware(['auth', 'verified'])->name('search');

Route::get('/return-shedule', [PurchaseController::class, 'schedule']) -> middleware(['auth', 'verified'])->name('return-search');

Route::get('/checkout-page', [PurchaseController::class, 'checkout']) ->middleware(['auth', 'verified'])->name('checkout-page');

Route::post('/checkout', [StripeController::class, 'checkout']) ->middleware(['auth', 'verified'])->name('checkout');

// checkout success 
Route::get('/checkout-success', [StripeController::class, 'success']) ->middleware(['auth', 'verified'])->name('checkout-success');

// checkout cancel
Route::get('/checkout-cancel', [StripeController::class, 'cancel']) ->middleware(['auth', 'verified'])->name('checkout-cancel');











Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
