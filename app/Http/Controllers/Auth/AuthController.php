<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.',
                    'redirect' => route('dashboard')
                ], 200);
            }

            // Return 200 OK with success = false for login failure
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to log in user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            dd($request->all());
        } catch (\Exception $e) {
            Log::error('Failed to Register User ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            // Log out the user
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();

            // Regenerate CSRF token
            $request->session()->regenerateToken();

            // Optionally return JSON for AJAX requests
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Logged out successfully',
                    'redirect' => route('login')
                ]);
            }

            // Redirect to login page
            return redirect()->route('login')->with('success', 'Logged out successfully');

        } catch (\Exception $e) {
            Log::error('Failed to logout User: ' . $e->getMessage());

            // Handle error response
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Failed to logout user',
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to logout user');
        }
    }
}
