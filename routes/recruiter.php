<?php

use App\Http\Controllers\Recruiter\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\ProjectController;

Route::prefix('recruiter')->middleware('role:recruiter')->name('recruiter.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('recruiter.dashboard');
    })->name('dashboard');

    // Chat Routes
    Route::prefix('/chat')->name('chat.')->group(function () {
        Route::get('/conversation/{userId}', [ChatController::class, 'getOrCreateConversation']);
        Route::get('/messages/{conversationId}', [ChatController::class, 'messages'])->name('messages');
        Route::get('/index', [ChatController::class, 'index'])->name('index');
        Route::get('/get-professional', [ChatController::class, 'getProfessional'])->name('get-professional');
        Route::post('/send', [ChatController::class, 'send'])->name('send');
    });

    // Project Routes
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
