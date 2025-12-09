<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessionalProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        $profile = $user->load('model');


        return view('professional.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Get existing profile or create a new one if it doesn't exist
        $profile = $user->model ?? new \App\Models\ModelProfiles();
        $profile->user_id = $user->id;

        $data = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'experience' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'portfolio_url' => 'nullable|url|max:255',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if (isset($profile->avatar) && Storage::exists($profile->avatar)) {
                Storage::delete($profile->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        // Update user first and last name
        $user->update([
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
        ]);

        // Save profile data
        $profile->fill($data);
        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
