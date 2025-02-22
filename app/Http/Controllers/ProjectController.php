<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index() 
     {
         if (Auth::guard('web')->check()) {
             $projects = Project::with('company')->withoutTrashed()->get();
         } elseif (Auth::guard('company')->check()) {
             $companyId = Auth::guard('company')->user()->id;
             $projects = Project::with('company')
                 ->where('company_id', $companyId)
                 ->withoutTrashed()
                 ->get();
         } else {
             return redirect()->route('login')->with('error', 'Accès non autorisé');
         }
     
         return view('admin-dashboard.projects.projectslist', compact('projects'));
     }
     /**
      * Displays Deleted Lists of Projects
      */
      public function listdeleted()
     {
        if (Auth::guard('web')->check()) {
            // Projets supprimés
            $projects = Project::with('company')->onlyTrashed()->get();
        } elseif (Auth::guard('company')->check()) {
            $companyId = Auth::guard('company')->user()->id;
    
            // Projets supprimés de l'entreprise
            $projects = Project::with('company')
                ->where('company_id', $companyId)
                ->onlyTrashed()
                ->get();
        } else {
            return redirect()->route('login')->with('error', 'Accès non autorisé');
        }
    
        return view('admin-dashboard.projects.projectsdeletedlist', compact('projects'));
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validation des données du formulaire
        $request->validate([
            'slug' => 'required|unique:projects,slug',
            'logo' => 'required|image:jpeg,png,jpg,gif|max:2048',
           'colors' => 'required|array|max:6',
            'project_description' => 'required|string',
            'estimated_budget' => 'nullable|numeric',
            'uploaded_files.*' => 'nullable|file:pdf,docx,xlsx,jpg,png|max:10240',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
     
        // Stocker le logo dans le dossier 'public/projects/logos'
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $destinationPath = public_path('projects/logos');
            $fileName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($destinationPath, $fileName);
            $profilePicture = 'projects/logos/' . $fileName;
        }
    
        // Gérer les fichiers téléchargés dans le dossier 'public/projects/uploads'
        $uploadedFiles = [];
        if ($request->hasFile('uploaded_files')) {
            foreach ($request->file('uploaded_files') as $file) {
                if ($file->isValid()) {
                    $destinationPath = public_path('projects/uploads');
                    $fileName = $file->getClientOriginalName();
                    $file->move($destinationPath, $fileName);
                    $uploadedFiles[] = 'projects/uploads/' . $fileName;
                }
            }
        }
       
   
        // Créer un nouveau projet
        $project = new Project();
        $project->slug = $request->slug;
        $project->logo = $profilePicture;
        $project->colors = json_encode($request->colors);
        $project->project_description = $request->project_description;
        $project->estimated_budget = $request->estimated_budget;
        $project->uploaded_files = json_encode($uploadedFiles);
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;

        
    
        // Associer le company_id à l'entreprise authentifiée via le guard 'company'
        $project->company_id = Auth::guard('company')->user()->id;
    
        // Sauvegarder le projet
        $project->save();
    
        // Rediriger avec un message de succès
        return redirect()->route('projects.create')->with('success', 'Le projet a été ajouté avec succès.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
    
        // Vérifier et convertir colors en tableau si nécessaire
        $project->colors = is_string($project->colors) ? json_decode($project->colors, true) : $project->colors;
        $project->uploaded_files = is_string($project->uploaded_files) ? json_decode($project->uploaded_files, true) : $project->uploaded_files;
    
        return view('admin-dashboard.projects.show', compact('project'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $uploadedFiles = json_decode($project->uploaded_files, true) ?? [];
        return view('admin-dashboard.projects.edit', compact('project', 'uploadedFiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouver le projet par son ID
        $project = Project::findOrFail($id);
    
        // Supprimer le projet
        $project->delete();
    
        // Rediriger avec un message de succès
        return redirect()->route('projects.index')->with('success', 'Le projet a été supprimé avec succès.');
    }
    /**
     * Restore a Delet Projects
     */
    public function restore($id)  
   {
    // Trouver le projet supprimé par son ID
    $project = Project::onlyTrashed()->findOrFail($id);

    // Restaurer le projet
    $project->restore();

    // Rediriger avec un message de succès
    return redirect()->route('projects.index')->with('success', 'Le projet a été restauré avec succès.');
   }

    
}
