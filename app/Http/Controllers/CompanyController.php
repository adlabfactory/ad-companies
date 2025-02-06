<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
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
            'company_phone' => 'nullable|digits:10',
             'company_rc' => 'required|string|max:1001',
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
    public function edit($id)
{
    $company = Company::findOrFail($id);
    return view('admin-dashboard.companies.edit', compact('company'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $companyId)
    {
        // Récupérer l'entreprise
        $company = Company::findOrFail($companyId);
        $request->validate([
            'company_name'         => 'required|string|max:255',
            'category'             => 'nullable|string|max:255',
            'company_phone'        => 'nullable|digits:10',
            'company_email'        => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('companies', 'company_email')->ignore($company->id),
            ],
            'company_address'      => 'nullable|string|max:255',
            'contact_person_name'  => 'nullable|string|max:255',
            'contact_person_role'  => 'nullable|string|max:255',
            'company_logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);        

        if ($request->has('company_name')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['company_name' => $request->input('company_name')]);
        }
    
        if ($request->has('category')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['company_category' => $request->input('category')]);
        }
    
        if ($request->has('company_phone')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['company_phone' => $request->input('company_phone')]);
        }
    
        if ($request->has('company_email')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['company_email' => $request->input('company_email')]);
        }
    
        if ($request->has('company_address')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['company_address' => $request->input('company_address')]);
        }
    
        if ($request->has('contact_person_name')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['contact_person_name' => $request->input('contact_person_name')]);
        }
    
        if ($request->has('contact_person_role')) {
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['contact_person_role' => $request->input('contact_person_role')]);
        }
    
        // Traitement de l'image (logo de l'entreprise)
        if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
            $destinationPath = 'companies/logos';  // Répertoire où les images seront stockées
          $fileName = time() . '_' . $request->file('company_logo')->getClientOriginalName(); // Crée un nom unique pour l'image
          $request->file('company_logo')->move(public_path($destinationPath), $fileName);
          $companyPicture = $destinationPath . '/' . $fileName;

            
            // Mise à jour du logo dans la base de données
            DB::table('companies')
                ->where('id', $company->id)
                ->update(['logo' => $companyPicture ]);
        }
        
    
        // Retourner avec un message de succès
       // Retourner avec un message de succès
        return redirect()->route('companies.edit', ['id' => $company->id])->with('success', 'Company details updated successfully!');

    }

    
    public function updateCompanyDetails(Request $request, $companyId)
{
    // Récupérer l'entreprise à partir de l'ID
    $company = Company::findOrFail($companyId);

    // Validation des données envoyées
    $request->validate([
        'subscription_start' => 'required|date',
        'subscription_end' => 'required|date|after_or_equal:subscription_start', // Assure que la date de fin est après ou égale à la date de début
        'status' => 'required|in:active,inactive',
        'devis_status' => 'required|in:approved,pending,rejected',
        'company_website_domaine' => 'nullable|url',
    ]);

    // Mise à jour des données de l'entreprise
    if ($request->has('subscription_start')) {
        $company->subscription_start_at = $request->input('subscription_start');
    }

    if ($request->has('subscription_end')) {
        $company->subscription_end_at = $request->input('subscription_end');
    }

    if ($request->has('status')) {
        $company->status = $request->input('status');
    }

    if ($request->has('devis_status')) {
        $company->devis_status = $request->input('devis_status');
    }

    if ($request->has('company_website_domaine')) {
        $company->company_website_domain = $request->input('company_website_domaine');
    }

    // Sauvegarder les modifications
    $company->save();

    // Redirection avec message de succès
    return redirect()->route('companies.edit', $company->id)->with('success', 'Company details updated successfully!');
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
