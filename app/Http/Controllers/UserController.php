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
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
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
  
}

    
    
   

