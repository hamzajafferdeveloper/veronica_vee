<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        $data = $request->only(['full_name', 'email', 'phone', 'dob', 'gender', 'cover_letter']);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'user_id' => $user->id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'resume' => $data['resume'],
            'cover_letter' => $data['cover_letter'],
        ]);

        return back()->with('success', 'Your application has been submitted successfully.');
    }
}
