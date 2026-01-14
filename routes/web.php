<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\KlaimController;

Route::get('/', function () {
    return view('main');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/histori-klaim', [KlaimController::class, 'histori'])
        ->name('histori.klaim');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/discount-claim/{id}', [KlaimController::class, 'claim'])->name('discount.claim');
    Route::get('/histori-klaim', [KlaimController::class, 'histori'])->name('histori.klaim');
});
// Route::post('/discount/{id}/claim', [DiscountController::class, 'claim'])
//     ->middleware('auth')
//     ->name('discount.claim');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});
