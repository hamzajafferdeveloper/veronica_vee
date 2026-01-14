<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            $locale = $request->getPreferredLanguage(['en', 'es']);
        }

        if (in_array($locale, ['en', 'es'])) {
            App::setLocale($locale);
        }

        // Handle missing translation keys in local environment
        if (App::environment('local')) {
            \Illuminate\Support\Facades\Lang::handleMissingKeysUsing(function ($key, $replacements, $locale) {
                \Illuminate\Support\Facades\Log::warning("Missing translation key: {$key} in locale: {$locale}");
            });
        }

        return $next($request);
    }
}
