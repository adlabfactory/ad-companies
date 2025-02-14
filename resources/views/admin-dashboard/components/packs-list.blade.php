@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="success-message">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
@endif

<div class="container mt-4">
    <!-- Formulaire de recherche -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-dark">List of Packs</h3>

        <!-- Formulaire de recherche -->
        <form action="{{ route('packs.search') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="search" class="form-control" id="searchInput" placeholder="Search Packs..." value="{{ request()->get('search') }}" style="margin-right: 10px;">
            <button type="submit" class="btn btn-outline-primary ml-2">
            <i class="fas fa-search"></i> Search
            </button>

        </form>
        @if (Auth::guard('web')->check())
        <!-- Bouton pour afficher les packs supprimés -->
        <a href="{{route('packs.listdeleted')}}" class="btn btn-dark shadow-sm">
            <i class="fas fa-trash-restore"></i> View Deleted Packs
        </a>
        @endif
    </div>

    <div class="row">
        @foreach($packs as $index => $pack)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset($pack->pack_image) }}" class="card-img-top" alt="{{ $pack->pack_name }}" 
                         style="width: 100%; height: 220px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    
                    <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold text-dark" style="font-size: 1.2rem;">{{ $pack->pack_name }}</h6>
                        <p class="card-text text-dark" style="font-size: 1rem;">{{ $pack->price }} $</p>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('packs.show', $pack->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            @if (Auth::guard('web')->check())
                            <a href="{{ route('packs.edit', $pack->id) }}" class="btn btn-sm btn-outline-warning">
                                Edit
                            </a>
                        
                            <form action="{{ route('packs.destroy', $pack->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        @endif
                        
                        </div>
                    </div>
                </div>
            </div>
            @if (($index + 1) % 3 == 0)
                </div><div class="row mt-4">
            @endif
        @endforeach
    </div>
</div>
<script>
    // Récupérer l'élément du champ de recherche
    const searchInput = document.getElementById('searchInput');
    
    // Écouter les changements dans le champ de recherche
    searchInput.addEventListener('input', function() {
        // Soumettre automatiquement le formulaire
        document.getElementById('searchForm').submit();
    });
</script>
