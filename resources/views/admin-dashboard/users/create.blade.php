<x-layout>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès!',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'custom-confirm-button'
            }
        });
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
            font-size: 16px; /* Augmenté de 14px à 16px */
            font-weight: 600;
            color: #000000;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s ease;
}
    .form-control {
        transition: border-color 0.3s ease; /* Transition fluide */
    }

    .form-control:hover {
        border-color: #ffda40; /* Bordure jaune au survol */
    }
    .form-control:focus {
        border-color: #ffda40; /* Bordure jaune pendant le focus */
        outline: none; /* Retirer l'outline bleu par défaut */
        box-shadow: 0 0 0 2px rgba(255, 218, 64, 0.5); /* Ombre jaune au focus */
    }
    .custom-confirm-button {
        background-color: #ffda40 !important; /* Couleur de fond */
        color: black !important; /* Couleur du texte */
        border: 2px solid #ff8c00 !important; /* Couleur de la bordure */
        border-radius: 5px; /* Coins arrondis */
        padding: 10px 20px;
        font-weight: bold;
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
                            <form action="{{ route('user.create') }}" method="post" enctype="multipart/form-data">
                                @csrf  <!-- Protection contre les attaques CSRF -->
                            
                                <div class="mb-20">
                                    <label for="fname">First Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="rounded-pill form-control radius-8 @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="Enter First Name" value="{{ old('fname') }}" required>
                                    @error('fname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="lname">Last Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8 @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Enter Last Name" value="{{ old('lname') }}" required>
                                    @error('lname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="phone">Phone <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8 @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="email">Email <span class="text-danger-600">*</span></label>
                                    <input type="email" class="form-control radius-8 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="password">Password <span class="text-danger-600">*</span></label>
                                    <input type="password" class="form-control radius-8 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger-600">*</span></label>
                                    <input type="password" class="form-control radius-8" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                            
                                <div class="mb-20">
                                    <label for="image">Image <span class="text-danger-600">*</span></label>
                                    <input type="file" class="form-control radius-8 @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
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
</x-layout>