<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyWizard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // Allow access to wizard routes
        if ($request->routeIs('filament.admin.pages.company-wizard*')) {
            return $next($request);
        }

        // Allow access to auth routes (login, register, logout)
        if ($request->routeIs('filament.admin.auth.*') || $request->routeIs('logout')) {
            return $next($request);
        }

        // Check if user needs to complete wizard
        if (!$user->company_id || !$user->company || !$user->company->wizard_completed) {
            return redirect()->route('filament.admin.pages.company-wizard');
        }

        return $next($request);
    }
}
