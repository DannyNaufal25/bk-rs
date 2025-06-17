<?php

use App\Http\Controllers\Pasien\JanjiPeriksa;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pasien\RiwayatPeriksaController;
use Illuminate\Support\Facades\Route;


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
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
});




Route::patch('/dokter/memeriksa/{janji}/toggle-status', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'toggleStatus'])->name('dokter.memeriksa.toggle-status');



require __DIR__.'/auth.php';
require __DIR__.'/pasien.php';
require __DIR__.'/dokter.php';
