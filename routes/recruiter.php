<?php

use Illuminate\Support\Facades\Route;

Route::prefix('recruiter')->name('recruiter.')->group(function () {
   Route::get('/dashboard', function () {
       return view('recruiter.dashboard');
   })->name('dashboard');
});
