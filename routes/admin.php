<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfessionalController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RecruiterController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/terms-of-use', [PageController::class, 'getTermOfUse'])->name('term-of-use');
        Route::get('/privacy-policy', [PageController::class, 'getPrivacyPolicy'])->name('privacy-policy');

        Route::post('/store/privacy-policy', [PageController::class, 'storePrivacyPolicyPage'])->name('store.privacy-policy');
        Route::post('/store/term-of-use', [PageController::class, 'storeTermOfUsePage'])->name('store.term-of-use');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('projects.index');
    });

    Route::prefix('professionals')->name("professionals.")->group(function () {
        Route::get('/all', [ProfessionalController::class, 'index'])->name('index');
        Route::post('/update-order', [ProfessionalController::class, 'updateOrder'])->name('update-order');
    });

    Route::prefix('recruiters')->group(function () {
        Route::get('/all', [RecruiterController::class, 'index'])->name('recruiters.index');
    });

});
