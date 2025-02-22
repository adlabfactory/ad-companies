<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EitherAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié en tant qu'utilisateur classique (auth)
        // OU si l'utilisateur est authentifié en tant qu'entreprise (auth:company)
        if (Auth::check() || Auth::guard('company')->check()) {
            return $next($request);
        }

        // Si aucun des deux, redirige vers la page de connexion
        return redirect()->route('login');
    }
}
