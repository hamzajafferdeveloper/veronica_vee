<?php

use App\Models\ModelProfiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/model', function () {

    $models = ModelProfiles::with('user')->get();

    return view('frontend.model', compact('models'));
})->name('model');

Route::get('/model/{id}', function ($id) {

    $model = ModelProfiles::with('user')->findOrFail($id);

    return view('frontend.model-profile', compact('model'));
})->name('frontend.model.profile');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/recruiter.php';
require __DIR__ . '/professional.php';
