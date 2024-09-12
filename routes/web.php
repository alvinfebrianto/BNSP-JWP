<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculationController;

// Route untuk menampilkan halaman utama perhitungan
Route::get('/', [CalculationController::class, 'index'])->name('calculate.index');
// Route untuk menyimpan hasil perhitungan
Route::post('/store', [CalculationController::class, 'store'])->name('calculate.store');
// Route untuk menampilkan data perhitungan
Route::get('/data', [CalculationController::class, 'show'])->name('data.index');
Route::get('/data/sort', [CalculationController::class, 'sort'])->name('data.sort');
// Route untuk menampilkan statistik perhitungan
Route::get('/stats', [CalculationController::class, 'stats'])->name('stats.index');
route::get('/data/sort', [CalculationController::class, 'sort'])->name('data.sort');
route::get('/stats', [CalculationController::class, 'stats'])->name('stats');