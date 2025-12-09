<?php

use App\Http\Controllers\Professional\ChatController;
use App\Http\Controllers\Professional\ProfessionalProfileController;
use App\Http\Controllers\Professional\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('professional')->middleware('role:professional')->name('professional.')->group(function () {
    Route::get('/dashboard', function () {
        return view('professional.dashboard');
    })->name('dashboard');

    Route::prefix('/chat')->name('chat.')->group(function () {
        Route::get('/get-or-create/{userId}', [ChatController::class, 'getOrCreateConversation']);
        Route::get('/messages/{receiver_id}', [ChatController::class, 'messages'])->name('messages');
        Route::get('/index', [ChatController::class, 'index'])->name('index');
        Route::get('/get-recuiter', [ChatController::class, 'getRecruiters'])->name('get-recuiters');
        Route::post('/send', [ChatController::class, 'send'])->name('send');
    });

    Route::prefix('/projects')->name('project.')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('index');
        Route::get('/show/{slug}', [ProjectController::class, 'show'])->name('show');
    });

    Route::get('/profile', [ProfessionalProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfessionalProfileController::class, 'update'])->name('profile.update');
});
