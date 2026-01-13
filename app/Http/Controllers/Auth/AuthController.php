<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
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

                $user = Auth::user();

                // Suspended user check
                if ($user->suspend) {
                    Auth::logout();

                    return response()->json([
                        'success' => false,
                        'message' => __('Your account has been suspended. Reason: :reason', ['reason' => $user->suspend_reason]),
                        'redirect' => false,
                    ], 200);
                }

                // Regenerate session
                $request->session()->regenerate();

                // Get role
                $role = optional($user->roles->first())->name;

                // Get redirect from request (if any)
                $redirect = $request->input('redirect');

                // Security: allow only internal redirects
                if ($redirect && ! str_starts_with($redirect, url('/'))) {
                    $redirect = null;
                }

                // Fallback redirect if none provided
                if (! $redirect) {
                    $redirect = match ($role) {
                        'admin' => route('admin.dashboard'),
                        'professional' => route('professional.dashboard'),
                        default => route('recruiter.dashboard'),
                    };
                }

                return response()->json([
                    'success' => true,
                    'message' => __('Login successful.'),
                    'redirect' => $redirect,
                ]);
            }

            // return message only, no redirect for failed login
            return response()->json([
                'success' => false,
                'message' => __('Invalid credentials.'),
                'redirect' => false,
            ], 200);

        } catch (Exception $e) {
            Log::error('Failed to log in user: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again.'),
                'redirect' => false,
            ], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {

            // Create User
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]);

            // Assign Role
            if ($request->type === 'professional') {
                $user->assignRole('professional');
                $redirect = route('professional.dashboard');
            } elseif ($request->type === 'recruiter') {
                $user->assignRole('recruiter');
                $redirect = route('recruiter.dashboard');
            } else {
                $redirect = false; // fallback
            }

            // Login user
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => __('Register successful.'),
                'redirect' => $redirect,
            ], 200);

        } catch (\Exception $e) {

            Log::error('Failed to register user: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again.'),
                'redirect' => false,
            ], 500);
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
                    'message' => __('Logged out successfully'),
                    'redirect' => route('login'),
                ]);
            }

            // Redirect to login page
            return redirect()->route('login')->with('success', __('Logged out successfully'));

        } catch (Exception $e) {
            Log::error('Failed to logout User: '.$e->getMessage());

            // Handle error response
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => __('Failed to logout user'),
                ], 500);
            }

            return redirect()->back()->with('error', __('Failed to logout user'));
        }
    }
}
