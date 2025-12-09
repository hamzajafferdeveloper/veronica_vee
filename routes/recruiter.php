<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\ProjectController;

Route::prefix('recruiter')->middleware('role:recruiter')->name('recruiter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('recruiter.dashboard');
    })->name('dashboard');

    Route::prefix('/chat')->name('chat.')->group(function () {
        Route::get('/index', function () {
            return view('recruiter.chat.index');
        })->name('index');
    });

    Route::prefix('/project')->name('project.')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('index');
        Route::get('/show/{slug}', [ProjectController::class, 'show'])->name('show');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
        Route::get('/edit/{slug}', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/update/{slug}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/destroy/{slug}', [ProjectController::class, 'destroy'])->name('destroy');
    });
});
