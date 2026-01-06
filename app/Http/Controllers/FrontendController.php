<?php

namespace App\Http\Controllers;

use App\Models\ModelProfiles;

class FrontendController extends Controller
{
    public function welcome()
    {
        $models = ModelProfiles::with('user')->latest()->get();

        return view('frontend.welcome', compact('models'));
    }

    public function models()
    {
        $models = ModelProfiles::with('user')->latest()->paginate(12);

        return view('frontend.model', compact('models'));
    }

    public function modelProfile(string $id)
    {
        $model = ModelProfiles::with('user')->findOrFail($id);

        return view('frontend.model-profile', compact('model'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function testimonials()
    {
        return view('frontend.testimonials');
    }
}
