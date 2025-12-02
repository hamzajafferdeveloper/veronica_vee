<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/model', function () {
    return view('frontend.model');
})->name('model');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/recruiter.php';
require __DIR__ . '/professional.php';
