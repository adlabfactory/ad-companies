<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::middleware('guest')->group(function () {
    // Route pour l'inscription
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route pour la connexion
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
}); // <-- Fermeture du groupe 'guest'

Route::middleware('auth')->group(function () {
    // Route pour le tableau de bord après connexion
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route pour la déconnexion
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

// Si tu utilises la vérification d'email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ce fichier est inclus à la fin pour les routes liées à l'authentification (par défaut)
require __DIR__.'/auth.php';
