<?php

use App\Http\Controllers\Professional\ProfessionalProfileController;
use App\Http\Controllers\Professional\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('professional')->middleware('role:professional')->name('professional.')->group(function () {
    Route::get('/dashboard', function () {
        return view('professional.dashboard');
    })->name('dashboard');

    Route::prefix('/chat')->name('chat.')->group(function () {
        Route::get('/index', function () {
            return view('professional.chat.index');
        })->name('index');
    });

    Route::prefix('/projects')->name('project.')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('index');
        Route::get('/show/{slug}', [ProjectController::class, 'show'])->name('show');
    });

    Route::get('/profile', [ProfessionalProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfessionalProfileController::class, 'update'])->name('profile.update');
});
