<!-- Ajouter Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="dashboard-main-body">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card h-100 p-0 radius-12">
        <!-- En-tête de la carte -->
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <!-- Barre de recherche -->
                <form class="navbar-search">
                    <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Rechercher un projet...">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
            <div class="d-flex gap-2">
                @if(Auth::guard('company')->check())
                <a href={{route('projects.create')}} class="btn btn-outline-warning-600 radius-8 px-20 py-11">Ajouter Projet</a>
                <a href="{{route('projects.listdeleted')}}" class="btn btn-outline-dark radius-8 px-20 py-11">
                    <i class="fas fa-trash-alt"></i> 
                </a>
                @endif
            </div>                       
        </div>

        <!-- Corps de la carte -->
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Nom du Projet</th>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Budget Estimé</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Date de Début</th>
                            <th scope="col">Date de Fin</th>
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->slug }}</td>
                                <td>{{ $project->company->company_name ?? 'Non spécifiée' }}</td>
                                <td>{{ number_format($project->estimated_budget, 2, ',', ' ') }} €</td>
                                <td>
                                    <span class="px-2 py-1 rounded-md">
                                        {{ $project->project_status }}
                                    </span>
                                </td>
                                <td>{{ $project->start_date->format('d/m/Y') }}</td>
                                <td>{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</td>
                         
                                <td>
                                    <!-- Vérifier si l'utilisateur est une entreprise -->
                                        <!-- Bouton Modifier -->
                                        <a href="{{ route('projects.show', ['slug' => $project->slug]) }}" class="btn btn-sm" 
                                            style="background-color: #E8BC05; border-color: #E8BC05; color: white;">
                                             <i class="fas fa-eye"></i> <!-- Icône d'œil -->
                                         </a>
                                         
                                        
                                         
                                        @if(Auth::guard('company')->check())
                                        <!-- Formulaire pour supprimer -->
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="background-color: #D9534F; border-color: #D9534F; color: white;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('projects.edit', ['slug' => $project->slug]) }}" class="btn btn-sm" 
                                            style="background-color: #E8BC05; border-color: #E8BC05; color: white;">
                                             <i class="fas fa-edit"></i> <!-- Icône d'édition -->
                                         </a>  
                                        @endif
                                </td>
                  
                                
                            </tr>
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
    </div>
</div>
