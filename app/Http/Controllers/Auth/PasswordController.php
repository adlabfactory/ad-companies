<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Ajout de l'importation de Auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{


    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // Validation des champs
        $request->validate([
            'password' => 'required|string|min:8|confirmed', // Validation du mot de passe
        ]);

        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Mise à jour du mot de passe en utilisant Hash::make
        $user->password = Hash::make($request->password);
        
        // Sauvegarde des modifications
        $user->save();
    
        // Retour avec message de succès
        return redirect()->back()->with('status', 'Password updated successfully!');
    }
}
