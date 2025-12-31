<?php

use App\Http\Controllers\Admin\ProfessionalController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RecruiterController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('projects')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('projects.index');
    });

    Route::prefix('professionals')->group(function () {
        Route::get('/all', [ProfessionalController::class, 'index'])->name('professionals.index');
    });

    Route::prefix('recruiters')->group(function () {
        Route::get('/all', [RecruiterController::class, 'index'])->name('recruiters.index');
    });

});
