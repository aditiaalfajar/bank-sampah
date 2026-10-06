<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\TarikController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('nasabah', NasabahController::class);
    Route::resource('jenis', JenisSampahController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->parameters(['jenis' => 'jenis']);
    Route::resource('setor', SetoranController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::resource('tarik', TarikController::class)->only(['index', 'create', 'store', 'destroy']);
});
