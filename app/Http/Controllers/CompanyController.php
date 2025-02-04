<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use App\Models\User; 

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
       /**
     * Compagnies List.
     */
    public function List()
    {
        $user = Auth::user();

        if ($user->role === 'super-admin') {
            // Si l'utilisateur est super-admin, récupérer toutes les compagnies
            $companies = Company::paginate(10);
        } else {
            // Sinon, récupérer uniquement les compagnies créées par cet utilisateur
            $companies = Company::where('user_id', $user->id)->paginate(10);
        }
        return view('admin-dashboard.companies.companieslist', compact('companies'));
    }

    /**
     * Deleted Companies 
     */

public function listDeleted()
{
    $user = Auth::user();

    if ($user->role === 'super-admin') {
        // Si l'utilisateur est super-admin, récupérer toutes les compagnies supprimées
        $companies = Company::onlyTrashed()->paginate(10);
    } else {
        // Sinon, récupérer uniquement les compagnies supprimées créées par cet utilisateur
        $companies = Company::onlyTrashed()->where('user_id', $user->id)->paginate(10);
    }

    return view('admin-dashboard.companies.deleted-companies', compact('companies'));
}
 /**
     * Form for compan 
     */


    public function create(){
        return view('admin-dashboard.companies.create');
    }
    /**
     * Store the company
     */

     public function store(Request $request)
     {
         $validated = $request->validate([
             'company_name' => 'required|string|max:255',
             'company_category' => 'required|string|max:255',
             'company_address' => 'required|string|max:500',
             'company_phone' => 'required|string|max:20',
             'company_rc' => 'required|string|max:1001|unique:companies,company_rc',
             'company_website_domain' => 'required|url|max:255',
             'company_description' => 'nullable|string',
             'company_email' => 'required|email|unique:companies,company_email',
             'password' => 'required|min:6|confirmed|unique:companies,password',
             'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'contact_person_name' => 'required|string|max:255',
             'contact_person_role' => 'required|string|max:255',
             'status' => 'required|string|in:active,inactive',
             'devis_status' => 'required|string|in:pending,approved,rejected',
         ]);
     
         // Variable pour stocker l'image du logo
         $profilePicture = null;
         if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
             // Définir le chemin de destination pour l'image
             $destinationPath = public_path('companies/logos');
             
             // Obtenir le nom du fichier
             $fileName = $request->file('company_logo')->getClientOriginalName();
             
             // Déplacer l'image vers le dossier spécifié
             $request->file('company_logo')->move($destinationPath, $fileName);
         
             // Stocker le chemin du fichier dans la variable
             $profilePicture = 'companies/logos/' . $fileName;
         }
     
         $uuid = Str::uuid(); // Génère l'UUID avant de l'utiliser
     
         // Création de l'entreprise
         DB::table('companies')->insert([
             'user_id' => Auth::user()->id,
             'username' => strtolower($validated['company_name'] . '.' . substr($uuid->toString(), 0, 4)),
             'company_name' => $validated['company_name'],
             'company_category' => $validated['company_category'],
             'company_address' => $validated['company_address'],
             'company_phone' => $validated['company_phone'],
             'company_rc' => $validated['company_rc'],
             'company_website_domain' => $validated['company_website_domain'],
             'company_description' => $validated['company_description'] ?? null,
             'company_email' => $validated['company_email'],
             'password' => Hash::make($validated['password']),
             'contact_person_name' => $validated['contact_person_name'],
             'contact_person_role' => $validated['contact_person_role'],
             'status' => $validated['status'],
             'devis_status' => $validated['devis_status'],
             'logo' => $profilePicture,
             'subscription_start_at' => now(),
             'created_at' => now(),
             'updated_at' => now(),
         ]);
     
         return redirect()->route('companies.create')->with('success', 'Entreprise enregistrée avec succès !');
     }
     
    
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete(); 
        return redirect()->back()->with('success', 'Company successfully deleted.');
    }

    //Restore a company from storage
    public function restore($id)
{
   
    $company = Company::onlyTrashed()->findOrFail($id);
    $company->restore();

    return redirect()->back()->with('success', 'Company successfully restored.');
}

}
