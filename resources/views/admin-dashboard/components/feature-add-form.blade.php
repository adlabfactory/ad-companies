@if(session('success'))
<div id="success-alert" class="alert alert-success">
    {{ session('success') }}
</div>

<script>
    setTimeout(function() {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);
</script>
@endif

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <style>
        .form-control {
            border: 1px solid #000000;
            border-radius: 20px;
            padding: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        label {
            font-size: 16px;
            font-weight: 600;
            color: #000000;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }
        .form-control:hover {
            border-color: #ffda40;
        }
        .form-control:focus {
            border-color: #ffda40;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 218, 64, 0.5);
        }
    </style>

    <div class="card h-100 p-0 radius-12">        
        <div class="card-body p-24">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8 col-lg-10">
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-16">
                                <img src="https://adlabfactory.com/wp-content/uploads/2024/12/Adlab-dark-Logo-siteweb.png" width="200" height="250" />
                            </div>    
                            <form action="{{ route('features.store') }}" method="POST">
                                @csrf

                                <div class="mb-20">
                                    <label for="feature_name">Feature Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="rounded-pill form-control radius-8 @error('feature_name') is-invalid @enderror" id="feature_name" name="feature_name" placeholder="Nom de la fonctionnalité" value="{{ old('feature_name') }}" required>
                                    @error('feature_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-20">
                                    <label for="description">Description (opptionel)</label>
                                    <textarea class="form-control radius-8 @error('description') is-invalid @enderror" id="description" name="description" placeholder="Ajoutez une description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <button type="submit" class="btn" style="background-color: #ffda40; 
                                    border-color: #ffda40; 
                                    color: #000; 
                                    font-family: 'Arial', sans-serif;
                                    padding: 10px 90px;
                                    border-radius: 20px;
                                    font-size: 20px;
                                    font-weight: bold;">
                                        Ajouter
                                    </button>
                                </div>                                                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
