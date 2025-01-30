<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route de bienvenue (accessible à tous)
Route::get('/', function () {
    return view('welcome');
});

// Groupe pour les invités (non authentifiés)
Route::middleware('guest')->group(function () {
    // Routes pour l'inscription
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Routes pour la connexion
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Groupe pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Route pour le tableau de bord
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/userslist', [UserController::class, 'userslists'])->name('userslist');
    Route::get('/profileuser', [UserController::class, 'index'])->name('/profileuser');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    // Route pour la déconnexion
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Routes pour le profil
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::get('/deletedusers', [UserController::class, 'deletedusers'])->name('deleteddusers');
    Route::get('profile/{user}', [UserController::class, 'restore'])->name('user.restore');
    Route::get('/usercreate', [UserController::class, 'adduser'])->name('user.create');
    Route::post('/usercreate', [UserController::class, 'create'])->name('user.create');

});