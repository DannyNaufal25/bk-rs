<?php

use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

    // Jadwal Periksa Routes
    Route::prefix('jadwal')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwalperiksa.index');
        Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwalperiksa.create');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwalperiksa.store');
        Route::get('/{id}/edit', [JadwalPeriksaController::class, 'edit'])->name('dokter.jadwalperiksa.edit');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwalperiksa.update');
        Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('dokter.jadwalperiksa.destroy');
    });

    // Memeriksa Pasien Routes
    Route::get('/memeriksa', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
    Route::get('/memeriksa/{janji}/create', [MemeriksaController::class, 'create'])->name('dokter.memeriksa.create');
    Route::post('/memeriksa', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');

    Route::patch('/jadwal/{jadwal}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal.toggle-status');
});
