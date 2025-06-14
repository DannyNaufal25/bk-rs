<?php

use Illuminate\Support\Facades\Route;

// Route khusus untuk role pasien
Route::middleware(['auth'])->group(function () {
    Route::get('/pasien/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
});
