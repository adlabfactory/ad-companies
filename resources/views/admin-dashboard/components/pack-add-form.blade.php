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
            setTimeout(() => alert.remove(), 500); // Supprime complètement l'élément après l'animation
        }
    }, 5000);
</script>
@endif

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
<style>
    .form-control {
        border: 1px solid #000000; /* Bordure initiale */
        border-radius: 20px;
        padding: 10px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Transition fluide */
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
        border-color: #ffda40; /* Bordure jaune au survol */
    }
    .form-control:focus {
        border-color: #ffda40; /* Bordure jaune pendant le focus */
        outline: none;
        box-shadow: 0 0 0 2px rgba(255, 218, 64, 0.5); /* Ombre jaune au focus */
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
                        <form action="{{ route('packs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf  <!-- Protection contre les attaques CSRF -->

                            <div class="mb-20">
                                <label for="pack_name">Pack Name <span class="text-danger-600">*</span></label>
                                <input type="text" class="rounded-pill form-control radius-8 @error('pack_name') is-invalid @enderror" id="pack_name" name="pack_name" placeholder="Enter Pack Name" value="{{ old('pack_name') }}" required>
                                @error('pack_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="price">Price <span class="text-danger-600">*</span></label>
                                <input type="number" step="0.01" class="form-control radius-8 @error('price') is-invalid @enderror" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="duration">Duration (days) <span class="text-danger-600">*</span></label>
                                <input type="number" class="form-control radius-8 @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Enter Duration" value="{{ old('duration') }}" required>
                                @error('duration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-20">
                                <label for="pack_image">Pack Image <span class="text-danger-600">*</span></label>
                                <input type="file" class="form-control radius-8 @error('pack_image') is-invalid @enderror" id="pack_image" name="pack_image" required>
                                @error('pack_image')
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
                                    Save
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