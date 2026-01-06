<?php

use App\Http\Controllers\FrontendController;
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

Route::get('/', [FrontendController::class, 'welcome'])->name('home');

Route::get('/about', [FrontendController::class, 'about'])->name('about');

Route::get('/model', [FrontendController::class, 'models'])->name('model');

Route::get('/model/{id}', [FrontendController::class, 'modelProfile'])->name('frontend.model.profile');

Route::get('/testimonial', [FrontendController::class, 'testimonials'])->name('testimonial');

Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/recruiter.php';
require __DIR__.'/professional.php';
