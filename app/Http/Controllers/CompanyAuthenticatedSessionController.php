<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CompanyAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view for companies.
     */
    public function create(): View
    {
        return view('auth.company-login'); // Créez une vue spécifique pour les entreprises
    }

    /**
     * Handle an incoming authentication request for companies.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Utiliser le guard 'company'
        $request->authenticateUsingGuard('company');

        $request->session()->regenerate();

        return redirect()->intended(route('company.dashboard'));
    }

    /**
     * Destroy an authenticated session for companies.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('company')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/company/login'); // Redirection vers la page de connexion des entreprises
    }
}
