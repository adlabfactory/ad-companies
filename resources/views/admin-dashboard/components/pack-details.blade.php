<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container">
    <h2>Détails du Pack : {{ $pack->name }}</h2>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom de la Feature</th>
                <th>Description</th>
                <th>Activé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pack->features as $feature)
                @if(Auth::guard('web')->check() || (Auth::guard('company')->check() && $feature->pivot->is_enabled == 1))
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $feature->feature_name }}</td>
                        <td>{{ $feature->description }}</td>
                        <td>
                            @if(Auth::guard('web')->check())
                                <form action="{{ route('toggle.feature', ['pack' => $pack->id, 'feature' => $feature->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-switch switch-success d-flex align-items-center gap-3">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switch{{ $feature->id }}"
                                            {{ $feature->pivot->is_enabled ? 'checked' : '' }} 
                                            onchange="this.form.submit()">
                                        <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch{{ $feature->id }}"></label>
                                    </div>
                                </form>
                            @else
                                {{ $feature->pivot->is_enabled ? 'Activé' : 'Désactivé' }}
                            @endif
                        </td>
                        <td>
                            @if ($feature->pivot->is_enabled == 1 && Auth::guard('web')->check())
                                <a href="{{ route('features.edit', ['pack' => $pack->id, 'feature' => $feature->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> 
                                </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('packs.list') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
