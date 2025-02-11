<?php

namespace App\Http\Controllers;
use App\Models\Pack;
use App\Models\PackFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PackController extends Controller
{
    public function packslist()
    {
        // Récupérer les packs avec pagination (10 packs par page)
        $packs = Pack::paginate(10);

        // Retourner la vue avec les packs paginés
        return view('admin-dashboard.packs.packslist-company', compact('packs'));
    }
    public function list()
    {
        // Récupérer les packs avec pagination (10 packs par page)
        $packs = Pack::paginate(10);

        // Retourner la vue avec les packs paginés
        return view('admin-dashboard.packs.packslist', compact('packs'));
    }
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        // Récupérer le terme de recherche
        $search = $request->input('search');

        // Effectuer la recherche dans la table packs
        $packs = Pack::where('pack_name', 'like', '%' . $search . '%')->get();

        // Retourner une vue avec les résultats
        return view('admin-dashboard.packs.packslist', compact('packs'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-dashboard.packs.create'); // Ici, packs.create est le nom de ta vue
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pack_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'pack_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Taille maximale 2MB
        ]);
    
        $pack = new Pack();
        $pack->pack_name = $request->input('pack_name');
        $pack->price = $request->input('price');
        $pack->duration = $request->input('duration');
       
        if ($request->hasFile('pack_image')) {
            $destinationPath = 'packs';  // Répertoire où les images seront stockées
            $fileName = time() . '_' . $request->file('pack_image')->getClientOriginalName(); // Crée un nom unique pour l'image
            $request->file('pack_image')->move(public_path($destinationPath), $fileName);
            $companyPicture = $destinationPath . '/' . $fileName;
            
            // Enregistrement du chemin de l'image dans la base de données
            $pack->pack_image = $companyPicture;
        }
    
        $pack->save();
    
        return redirect()->route('packs.create')->with('success', 'Pack created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $pack = Pack::with('features')->findOrFail($id);
        return view('admin-dashboard.packs.show', compact('pack'));
    }
   

    /**
     * 
     * Edit Toggle 
     */
    public function toggleFeature(Request $request, $packId, $featureId)
    {
        $pack = Pack::findOrFail($packId);

        // Vérifier si la relation existe dans la table pivot
        if ($pack->features()->where('features.id', $featureId)->exists()) {
            // Récupérer l'état actuel de `is_enabled`
            $currentState = $pack->features()->where('features.id', $featureId)->first()->pivot->is_enabled;

            // Inverser l'état (1 → 0 ou 0 → 1)
            $newState = !$currentState;

            // Mettre à jour la valeur dans la table pivot
            $pack->features()->updateExistingPivot($featureId, [
                'is_enabled' => $newState,
            ]);
        }

        // Recharger la même page
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pack = Pack::findOrFail($id); // Trouver le pack par son ID
        return view('admin-dashboard.packs.edit', compact('pack')); // Passer le pack à la vue
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Récupérer le pack par son ID
    $pack = Pack::findOrFail($id);

    // Validation des données envoyées par le formulaire
    $validatedData = $request->validate([
        'pack_name' => 'nullable|string|max:255',
        'price' => 'nullable|numeric',
        'pack_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Mettre à jour uniquement les champs envoyés par l'utilisateur
    if ($request->has('pack_name')) {
        $pack->pack_name = $request->input('pack_name');
    }

    if ($request->has('price')) {
        $pack->price = $request->input('price');
    }

    if ($request->hasFile('pack_image')) {
        $destinationPath = 'packs';  // Répertoire où les images seront stockées
        $fileName = time() . '_' . $request->file('pack_image')->getClientOriginalName(); // Crée un nom unique pour l'image
        $request->file('pack_image')->move(public_path($destinationPath), $fileName);
        $companyPicture = $destinationPath . '/' . $fileName;
        $pack->pack_image = $companyPicture ;
    }

    // Sauvegarder les modifications
    $pack->save();

    // Retourner avec un message de succès
    return redirect()->route('packs.list')->with('success', 'Pack updated successfully');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $pack = Pack::findOrFail($id); // Trouver le pack ou renvoyer une erreur 404
    $pack->delete(); // Supprimer le pack

    return redirect()->route('packs.list')->with('success', 'Pack deleted successfully.');

}

/**
 * Deleted Packs List.
 */
public function listdeleted()
{
    $packs = Pack::onlyTrashed()->get(); // Récupérer les packs supprimés
    return view('admin-dashboard.packs.deletedpackslist', compact('packs'));
}

 /**
 * Restaured Packs .
 */
    public function restore($id)
    {
       
        $pack= Pack::onlyTrashed()->findOrFail($id);
        $pack->restore();
    
        return redirect()->back()->with('success', 'Company successfully restored.');
    }


}
