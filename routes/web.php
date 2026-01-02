<?php

use App\Models\ModelProfiles;
use Illuminate\Support\Facades\Route;

Route::get('/clear-all-caches', function () {
    try {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return 'All caches have been cleared.';
    } catch (Exception $e) {
        return 'Error clearing caches: '.$e->getMessage();
    }
});

Route::get('/create-storage-link', function () {
    try {
        // Define the path to the storage link
        $linkPath = public_path('storage');

        // Check if the link exists and remove it if it does
        if (File::exists($linkPath)) {
            File::delete($linkPath);
        }

        // Create a new storage link
        Artisan::call('storage:link');

        return 'The storage link has been recreated.';
    } catch (Exception $e) {
        return 'Error creating storage link: '.$e->getMessage();
    }
});

Route::get('/', function () {

    $models = ModelProfiles::with('user')->take(20)->latest()->get();

    return view('frontend.welcome', compact('models') );
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

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/recruiter.php';
require __DIR__.'/professional.php';
