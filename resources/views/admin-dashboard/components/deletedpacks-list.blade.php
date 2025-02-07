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
    <!-- Bouton pour afficher les packs supprimés -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-dark">List of Packs</h3>
        <a href="{{route('packs.list')}}" class="btn btn-dark shadow-sm">
            <i class="fas fa-trash-restore"></i> View Packs List
        </a>
    </div>

    <div class="row">
        @foreach($packs as $index => $pack)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset($pack->pack_image) }}" class="card-img-top" alt="{{ $pack->pack_name }}" 
                         style="width: 100%; height: 220px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    
                    <div class="card-body text-center">
                        <h6 class="card-title font-weight-bold text-dark" style="font-size: 1.2rem;">{{ $pack->pack_name }}</h6>
                        <p class="card-text text-dark" style="font-size: 1rem;">{{ $pack->price }} DH</p>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-center gap-2">
                            <form action="{{ route('packs.restore', $pack->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Restore
                                </button>
                            </form>
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
