<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationAsset;
use App\Models\FrontendPage;
use App\Models\ModelProfiles;
use Exception;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome()
    {
        $models = ModelProfiles::with('user')->orderBy('ordering', 'asc')->get();

        return view('frontend.welcome', compact('models'));
    }

    public function models()
    {
        $models = ModelProfiles::with('user')->orderBy('ordering', 'asc')->paginate(12);

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

    public function page(string $slug)
    {
        try {
            $page = FrontendPage::where('slug', operator: $slug)->first();

            if ($page) {
                return view('frontend.page', compact('page'));
            }

            abort(404);

        } catch (Exception $e) {
            abort(404);
        }
    }

    public function application()
    {
        return view('frontend.application-form');
    }

    public function submitApplication(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        // Step 1: Create the main application record
        $application = Application::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'cover_letter' => $request->cover_letter,
        ]);

        // Step 3: Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('applications/images', 'public');

                $applicationAsset = new ApplicationAsset;
                $applicationAsset->application_id = $application->id;
                $applicationAsset->url = $path;
                $applicationAsset->asset_type = 'image';
                $applicationAsset->asset_extension = $image->getClientOriginalExtension();
                $applicationAsset->save();

            }
        }

        return back()->with('success', 'Your application has been submitted successfully.');
    }
}
