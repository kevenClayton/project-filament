<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Verificar se o usuário está autenticado
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return $next($request);
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        // Se já está na rota do wizard, permitir acesso
        if ($request->routeIs('filament.admin.pages.company-wizard*')) {
            return $next($request);
        }

        // Se é rota de logout ou auth, permitir
        if ($request->routeIs('filament.admin.auth.*') || $request->routeIs('logout')) {
            return $next($request);
        }

        // Se não tem empresa ou não completou wizard, redireciona para wizard
        if (!$user->company_id || !$user->company || !$user->company->wizard_completed) {
            return redirect()->route('filament.admin.pages.company-wizard');
        }

        return $next($request);
    }
}
