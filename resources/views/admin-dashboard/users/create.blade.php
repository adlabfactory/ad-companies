<x-layout>
   <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <style>
         .inputform input, .inputform textarea, .inputform select {
             border-radius: 50px !important;
         }
     
       
     </style>
     
     <div class="card h-100 p-0 radius-12">        
         <div class="card-body p-24">
             <div class="row justify-content-center">
                 <div class="col-xxl-6 col-xl-8 col-lg-10">
                     <div class="card border">
                         <div class="card-body">
                             <h1 class="text-md text-primary-light mb-16">Add User</h1>
                             <form action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf  <!-- Protection contre les attaques CSRF -->
                                
                                <div class="mb-20">
                                    <label for="fname">First Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter First Name" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="lname">Last Name <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="lname" name="lname" placeholder="Enter Last Name" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="phone">Phone <span class="text-danger-600">*</span></label>
                                    <input type="text" class="form-control radius-8" id="phone" name="phone" placeholder="Enter Phone Number" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="email">Email <span class="text-danger-600">*</span></label>
                                    <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Enter email address" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="password">Password <span class="text-danger-600">*</span></label>
                                    <input type="password" class="form-control radius-8" id="password" name="password" placeholder="Enter Password" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger-600">*</span></label>
                                    <input type="password" class="form-control radius-8" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="image">Image <span class="text-danger-600">*</span></label>
                                    <input type="file" class="form-control radius-8" id="image" name="image" accept="image/*">
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <button type="submit" class="btn btn-warning border border-warning-600 text-md px-56 py-12 radius-8"> 
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