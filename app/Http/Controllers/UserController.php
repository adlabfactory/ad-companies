<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;  
use Illuminate\Support\Facades\DB;
class UserController extends Controller


{
    public function userslists()
    {
          $users = User::paginate(4); 
        // Passer les utilisateurs à la vue
        return view('admin-dashboard.users.userslist', compact('users'));
    }
    public function deletedusers()
    {
        $users = User::onlyTrashed()->paginate(2);
        return view('admin-dashboard.users.deletedusers', compact('users'));
    }

    public function index()
    {
        return view('admin-dashboard.users.profile');
    }
      /**
     * Display the user's profile form.
     */
 

    /**
     * Update the user's profile information.
     */
  
    public function restore($id)
{
    $user = User::onlyTrashed()->findOrFail($id);
    $user->restore();

    return redirect()->route('userslist')->with('success', 'Utilisateur restauré avec succès.');
}


    /**
     * Delete the user's account.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return Redirect::route('userslist');
    }
    public function adduser()
    {

        return view('admin-dashboard.users.create');
    }




  // La creation d'un utilisateure
  public function create(Request $request)
  {
      $validated = $request->validate([
          'email'    => 'required|email|unique:users,email',
          'password' => 'required|min:6|confirmed',  // Laravel attend 'password_confirmation'
          'fname'    => 'required|string',
          'lname'    => 'required|string',
          'phone'    => 'required|string',
          'image'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
      ]);
  
      // Utilisation de QueryBuilder pour insérer l'utilisateur
      $userId = DB::table('users')->insertGetId([
          'handle'   => strtolower(substr($validated['fname'], 0, 1) . '.' . $validated['lname'] . '.' . substr(Str::uuid(), 0, 4)),
          'email'    => $validated['email'],
          'password' => Hash::make($validated['password']),
      ]);
  
      // Traitement de l'image (conversion en base64 si présente)
      $profilePicture = null;
      if ($request->hasFile('image') && $request->file('image')->isValid()) {
          // Définir le chemin de destination pour l'image
          $destinationPath = public_path('profiles/admin');
          
          // Obtenir le nom du fichier
          $fileName = $request->file('image')->getClientOriginalName();
          
          // Déplacer l'image vers le dossier spécifié
          $request->file('image')->move($destinationPath, $fileName);
      
          // Stocker le chemin du fichier dans la variable
          $profilePicture = 'profiles/admin/' . $fileName;
      }
  
      // Utilisation de QueryBuilder pour insérer le profil
      DB::table('profiles')->insert([
          'user_id'         => $userId,
          'first_name'      => $validated['fname'],
          'last_name'       => $validated['lname'],
          'phone'           => $validated['phone'],
          'profile_picture' => $profilePicture,
          'created_at'      => now(),
          'updated_at'      => now(),
      ]);
  
      return back()->with('success', 'Utilisateur créé avec succès.');
  }

// Affichage du formulaire d'edition du profile authentifie
  public function edit(Request $request): View
  {
      $user = Auth::user();  // Récupère l'utilisateur authentifié
      $userId = $user->id;   // Obtient l'ID de l'utilisateur
  
      // Récupérer les informations de l'utilisateur et de son profil
      $userWithProfile = DB::table('users')
          ->join('profiles', 'users.id', '=', 'profiles.user_id')  // Jointure entre 'users' et 'profiles'
          ->where('users.id', $userId)  // Filtrer par l'ID de l'utilisateur authentifié
          ->select('users.*', 'profiles.*')  // Sélectionner toutes les colonnes des deux tables
          ->first();
          $data = [
            'user' => $user,
            'userWithProfile' => $userWithProfile
        ];
      return view('admin-dashboard.users.profile', $data);
  }




  // Le controleure qui va faire l update 
  public function update(Request $request)
  {
   
      $user = Auth::user(); 
  
      // Validation des champs du formulaire
      $validated = $request->validate([
          'first_name' => 'nullable|string|max:255',
          'last_name' => 'nullable|string|max:255',
          'phone' => 'nullable|string|max:15',
          'email' => 'nullable|email|max:255', // Validation de l'email pour la table 'users'
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Si l'image est envoyée
      ]);
    
      // Mise à jour des champs dans la table 'profiles' via le Query Builder
      if ($request->has('first_name')) {
          DB::table('profiles')
              ->where('user_id', $user->id) // Supposons que 'user_id' est la clé étrangère dans la table 'profiles'
              ->update(['first_name' => $request->input('first_name')]);
      }
  
      if ($request->has('last_name')) {
          DB::table('profiles')
              ->where('user_id', $user->id)
              ->update(['last_name' => $request->input('last_name')]);
      }
  
      if ($request->has('phone')) {
          DB::table('profiles')
              ->where('user_id', $user->id)
              ->update(['phone' => $request->input('phone')]);
      }
  
      // Mise à jour de l'email dans la table 'users' via le Query Builder
      if ($request->has('email')) {
          DB::table('users')
              ->where('id', $user->id)
              ->update(['email' => $request->input('email')]);
      }
       // Traitement de l'image (si une nouvelle image est envoyée)
       if ($request->hasFile('image') && $request->file('image')->isValid()) {
        // Définir le chemin de destination pour l'image
        $destinationPath = 'profiles/admin';
    
        // Obtenir le nom du fichier
        $fileName = $request->file('image')->getClientOriginalName();
    
        // Déplacer l'image vers le dossier spécifié
        $request->file('image')->move(public_path($destinationPath), $fileName);
    
        // Stocker le chemin du fichier dans la variable
        $profilePicture = $destinationPath . '/' . $fileName;
    
        // Mise à jour de l'utilisateur dans la base de données
        DB::table('profiles')
             ->where('user_id', $user->id)
            ->update(['profile_picture' => $profilePicture]);
    }
    
    return redirect()->back()->with('success', 'Profile updated successfully!');  

    } 

    public function showOtherProfiles($id)
    {
        $user = User::with('profile')->findOrFail($id);
        $userId = $user->id;   
        
        $userWithProfile = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')  // Jointure entre 'users' et 'profiles'
            ->where('users.id', $userId)  // Filtrer par l'ID de l'utilisateur authentifié
            ->select('users.*', 'profiles.*')  // Sélectionner toutes les colonnes des deux tables
            ->first();
            $data = [
              'user' => $user,
              'userWithProfile' => $userWithProfile
          ];
          return view('admin-dashboard.users.other-profiles', $data);
     

    
    }


  // update other profiles
    public function updateOtherProfiles(Request $request, $id)
{
    // Vérifier si l'utilisateur est un admin
    //if (!Auth::user() || !Auth::user()->is_admin) {
       // return redirect()->back()->with('error', 'Accès refusé');
    //}

    // Récupérer l'utilisateur par son ID
    $user = User::findOrFail($id);
    
    // Validation des champs du formulaire
    $validated = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:15',
        'email' => 'nullable|email|max:255', // Validation de l'email pour la table 'users'
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Si l'image est envoyée
    ]);

    // Mise à jour des champs dans la table 'profiles' via le Query Builder
    if ($request->has('first_name')) {
        DB::table('profiles')
            ->where('user_id', $user->id)
            ->update(['first_name' => $request->input('first_name')]);
    }

    if ($request->has('last_name')) {
        DB::table('profiles')
            ->where('user_id', $user->id)
            ->update(['last_name' => $request->input('last_name')]);
    }

    if ($request->has('phone')) {
        DB::table('profiles')
            ->where('user_id', $user->id)
            ->update(['phone' => $request->input('phone')]);
    }

    // Mise à jour de l'email dans la table 'users' via le Query Builder
    if ($request->has('email')) {
        DB::table('users')
            ->where('id', $user->id)
            ->update(['email' => $request->input('email')]);
    }

    // Traitement de l'image (si une nouvelle image est envoyée)
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $destinationPath = 'profiles/admin';  // Répertoire où les images seront stockées
        $fileName = time() . '_' . $request->file('image')->getClientOriginalName(); // Crée un nom unique pour l'image
        $request->file('image')->move(public_path($destinationPath), $fileName);
        
        $profilePicture = $destinationPath . '/' . $fileName;

        // Mise à jour de l'image de profil dans la table 'profiles'
        DB::table('profiles')
            ->where('user_id', $user->id)
            ->update(['profile_picture' => $profilePicture]);
    }

    return redirect()->route('user.showOtherProfiles', ['user' => $user]);
    }
    
    
  
}
      
  
  
  


    
    
   

