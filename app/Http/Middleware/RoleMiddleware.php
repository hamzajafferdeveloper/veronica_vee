<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            // Not logged in
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        // Check if user has at least one of the allowed roles
        if (!$user->hasAnyRole($roles)) {
            // Unauthorized
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
