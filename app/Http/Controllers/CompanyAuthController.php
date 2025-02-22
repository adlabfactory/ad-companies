<?php

// app/Http/Controllers/CompanyAuthController.php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.company-login');
    }

    public function store(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Tentative de connexion avec les informations de l'entreprise
        if (Auth::guard('company')->attempt(['company_email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Régénérer l'ID de session pour sécuriser la session de l'utilisateur
            $request->session()->regenerate();
          
        
            return redirect()->intended(route('company.dashboard'));
      
        }
    
        // Si l'authentification échoue
        return back()->withErrors(['email' => 'Les identifiants fournis sont incorrects.']);
    }
    
    

    public function destroy(Request $request)
    {
        // Déconnexion de l'entreprise via le guard 'company'
        Auth::guard('company')->logout();

        // Si l'entreprise a une session active, on la supprime
        $request->session()->invalidate();

        // Regénérer le token CSRF pour prévenir les attaques CSRF après la déconnexion
        $request->session()->regenerateToken();

        // Rediriger vers la page de connexion des entreprises
        return redirect()->route('company.login');
    }
}