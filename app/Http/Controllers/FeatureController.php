<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pack;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-dashboard.features.create');
    
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feature_name' => 'required|string|max:100|unique:features,feature_name',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // Ajouter la fonctionnalité
            $feature = Feature::create([
                'feature_name' => $request->feature_name,
                'description' => $request->description,
            ]);

            // Associer la fonctionnalité à tous les packs existants
            $packs = Pack::all();
            foreach ($packs as $pack) {
                $pack->features()->attach($feature->id, ['is_enabled' => true]);
            }
        });

        return redirect()->route('features.create')->with('success', 'Feature added successfully and assigned to all packs.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pack $pack, Feature $feature)
    {
        return view('admin-dashboard.features.edit', compact('pack', 'feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pack $pack, Feature $feature)
    {
        $request->validate([
            'feature_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $feature->update([
            'feature_name' => $request->feature_name,
            'description' => $request->description,
        ]);

        return redirect()->route('features.edit', ['pack' => $pack->id, 'feature' => $feature->id])
        ->with('success', 'Feature updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
