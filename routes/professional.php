<?php

use Illuminate\Support\Facades\Route;

Route::prefix('professional')->middleware('role:professional')->name('professional.')->group(function () {
    Route::get('/dashboard', function () {
        return view('professional.dashboard');
    })->name('dashboard');
});
