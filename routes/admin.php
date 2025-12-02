<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
