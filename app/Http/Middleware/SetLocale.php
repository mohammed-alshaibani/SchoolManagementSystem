<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        $sessionLocale = session('locale');               // what user picked
        $defaultLocale = config('app.locale', 'en');      // fallback from config
        $locale = $sessionLocale ?: $defaultLocale;

        app()->setLocale($locale);

        // Optional logging while debugging
        Log::info('SetLocale middleware', compact('sessionLocale','defaultLocale','locale'));

        return $next($request);
    }
}
