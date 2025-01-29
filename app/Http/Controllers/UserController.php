<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
class UserController extends Controller
{
    public function userslists()
    {
        $users = User::all();
        // Passer les utilisateurs à la vue
        return view('admin-dashboard.users.userslist', compact('users'));
    }
    public function create()
    {
        return view('admin-dashboard.users.create');
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

    /**
     * Delete the user's account.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return Redirect::route('userslist');
    }
   

}