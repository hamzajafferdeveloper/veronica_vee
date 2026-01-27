<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfessionalController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RecruiterController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('/chat')->name('chat.')->group(function () {
        Route::get('/get-or-create/{userId}', [ChatController::class, 'getOrCreateConversation']);
        Route::get('/messages/{receiver_id}', [ChatController::class, 'messages'])->name('messages');
        Route::get('/index', [ChatController::class, 'index'])->name('index');
        Route::get('/get-users', [ChatController::class, 'getUsers'])->name('get-users');
        Route::post('/send', [ChatController::class, 'send'])->name('send');
        Route::post('/offer/store', [App\Http\Controllers\Admin\OfferController::class, 'store'])->name('offer.store');
    });

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
        Route::get('/offers', [App\Http\Controllers\Admin\OfferController::class, 'index'])->name('recruiters.offers');
    });

    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/all', [ApplicationController::class, 'index'])->name('index');
        Route::get('/{id}', [ApplicationController::class, 'show'])->name('show');
        Route::delete('/{id}', [ApplicationController::class, 'destroy'])->name('destroy');
    });

});
