<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/checkout', [PurchaseController::class, 'checkout']) ->middleware(['auth', 'verified'])->name('checkout');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
