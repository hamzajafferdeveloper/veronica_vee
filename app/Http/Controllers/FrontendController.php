<?php

namespace App\Http\Controllers;

use App\Models\FrontendPage;
use App\Models\ModelProfiles;
use Exception;

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

    public function page(string $slug){
        try {
            $page = FrontendPage::where('slug', operator: $slug)->first();

            if($page) {
                return view('frontend.page', compact('page'));
            }

            abort(404);


        } catch(Exception $e) {
            abort(404);
        }
    }
}
