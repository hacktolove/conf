<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Default to Arabic if no locale is set
        $defaultLocale = 'ar';
        
        // Check if locale is passed in request (for language switcher)
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            session(['locale' => $locale]);
        } else {
            // Check if locale is set in session, otherwise use Arabic as default
            $locale = session('locale', $defaultLocale);
        }
        
        // Validate locale
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = $defaultLocale;
        }
        
        // Ensure locale is set in session for consistency
        if (!session()->has('locale')) {
            session(['locale' => $locale]);
        }
        
        app()->setLocale($locale);
        
        return $next($request);
    }
}

