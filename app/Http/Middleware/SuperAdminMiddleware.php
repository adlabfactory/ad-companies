<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */public function handle(Request $request, Closure $next)
{
    // Vérifier si l'utilisateur est authentifié et si son rôle est "super-admin"
    if (Auth::check() && Auth::user()->role === 'super-admin') {
        return $next($request);
    }

    // Si l'utilisateur n'a pas le rôle "super-admin", envoyer une notification et rediriger
    session()->flash('error', 'You do not have the required access');  // Notification avec un message d'erreur

    // Rediriger vers la page d'accueil
    return redirect()->route('dashboard');  
}

}

