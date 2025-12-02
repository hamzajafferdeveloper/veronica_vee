<?php

use Illuminate\Support\Facades\Route;

Route::prefix('professional')->name('professional.')->group(function () {
    Route::get('/dashboard', function () {
        return view('professional.dashboard');
    })->name('dashboard');
});
