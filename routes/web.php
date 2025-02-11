<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\CompanyAuthController;
use App\Http\Middleware\EitherAuthenticationMiddleware;

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
   // Routes pour la connexion de la compagnie
   Route::get('company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
   Route::post('company/login', [CompanyAuthController::class, 'store'])->name('company.store');
 
});

Route::middleware('auth')->group(function () {
    // Route pour le tableau de bord
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    // Route pour la déconnexion
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Routes pour le profil
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::post('user/password/update', [PasswordController::class, 'update'])->name('password.update');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/companies/list', [CompanyController::class, 'List'])->name('companies.list');
    Route::get('/companies/deletedlist', [CompanyController::class, 'listDeleted'])->name('companies.listDeleted');
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
    Route::post('/companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
    Route::post('/companies/{id}/details/update', [CompanyController::class, 'updateCompanyDetails'])->name('companies.updatecompanydetails');
    Route::get('/packs/create', [PackController::class, 'create'])->name('packs.create');
    Route::post('/packs/store', [PackController::class, 'store'])->name('packs.store');
    Route::get('/packs/list', [PackController::class, 'list'])->name('packs.list');
    Route::delete('/packs/{id}', [PackController::class, 'destroy'])->name('packs.destroy');
    Route::get('/packs/deletedlist', [PackController::class, 'listdeleted'])->name('packs.listdeleted');
    Route::post('/packs/{id}/restore', [PackController::class, 'restore'])->name('packs.restore');
    Route::get('/packs/edit/{id}', [PackController::class, 'edit'])->name('packs.edit');
    Route::post('/packs/update/{id}', [PackController::class, 'update'])->name('packs.update');
    Route::get('/packs/search', [PackController::class, 'search'])->name('packs.search');
    Route::get('/features/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('/features', [FeatureController::class, 'store'])->name('features.store');
    //Route::get('/packs/{id}', [PackController::class, 'show'])->name('packs.show');
    Route::patch('/toggle-feature/{pack}/{feature}', [PackController::class, 'toggleFeature'])->name('toggle.feature');
    Route::get('/pack/{pack}/feature/{feature}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::patch('/pack/{pack}/feature/{feature}', [FeatureController::class, 'update'])->name('features.');
    // Routes pour la gestion des utilisateurs (accessibles uniquement pour le rôle super-admin)
    Route::middleware([SuperAdminMiddleware::class])->group(function () {
        Route::get('/userslist', [UserController::class, 'userslists'])->name('userslist');
        Route::get('/deletedusers', [UserController::class, 'deletedusers'])->name('deleteddusers');
        Route::get('users/create', [UserController::class, 'adduser'])->name('user.add');
        Route::post('/usercreate', [UserController::class, 'create'])->name('user.create');
        Route::get('/user/updateOtherProfiles/{user}', [UserController::class, 'showOtherProfiles'])->name('user.showOtherProfiles');
        Route::post('/user/{id}/update-profile', [UserController::class, 'updateOtherProfiles'])->name('user.updateOtherProfiles');
        Route::get('profile/{user}', [UserController::class, 'restore'])->name('user.restore');
    });
    

});
Route::middleware([EitherAuthenticationMiddleware::class])->get('/packs/{id}', [PackController::class, 'show'])->name('packs.show');
Route::middleware('auth:company')->group(function () {
    Route::post('/company/logout', [CompanyAuthController::class, 'destroy'])
        ->name('company.logout');

    Route::get('/company/dashboard', function () {
        return view('admin-dashboard.companies.home'); 
    })->name('company.dashboard');
    Route::get('/company/packs/list', [PackController::class, 'packslist'])->name('packs.packslist');
});




