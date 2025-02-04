<x-layout>
    <style>
        .user-grid-card {
    min-height: 350px; /* Ajustez selon la hauteur que vous souhaitez */
}

.card {
    min-height: 350px; /* Ajustez selon la hauteur de la carte */
    display: flex;
    flex-direction: column;
}

.card-body {
    flex-grow: 1; /* Permet à l'élément de prendre toute la hauteur restante */
}

    </style>
 <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
<h6 class="fw-semibold mb-0">View Profile</h6>
<ul class="d-flex align-items-center gap-2">
<li class="fw-medium">
  <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
    Dashboard
  </a>
</li>
<li>-</li>
<li class="fw-medium">View Profile</li>
</ul>
</div>

    <div class="row gy-4 ">
        <div class="col-lg-4  py-4">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100 ">
                <img src="{{ asset($userWithProfile->profile_picture) }}" alt="Profile Picture" class="w-100 object-fit-cover" style="height: 20%;">
                <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset($userWithProfile->profile_picture) }}" alt="" class="border border-white border-2 w-200px h-auto rounded-circle object-fit-cover" style="height: 150px; width: 150px;">

                        <h6 class="mb-0 mt-16">{{ $userWithProfile->first_name . ' ' . $userWithProfile->last_name }}</h6>
                        <span class="text-secondary-light mb-16">{{ $user->email }}</span>
                    </div>
                    <div class="mt-24 ">
                        <div class="mt-24 ">
                         <h6 class="text-xl mb-16 texte-center">Personal Info</h6>
                        </div>
                      
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">First Name:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $userWithProfile->first_name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Last Name:</span>
                                <span class="w-70 text-secondary-light fw-medium"> {{ $userWithProfile->last_name}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">User Name:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $user->handle }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Email:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $user->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Phone: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $userWithProfile->phone}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> City:</span>
                                <span class="w-70 text-secondary-light fw-medium"> Casablanca</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Contry:</span>
                                <span class="w-70 text-secondary-light fw-medium"> Morrroco</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Adress:</span>
                                <span class="w-70 text-secondary-light fw-medium">Bureau 60, blvd la résistance, imm la résistance, Casablanca 20230 , Casablanca 20000</span>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-flex justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center px-24 active" 
                                id="pills-edit-profile-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#pills-edit-profile" 
                                type="button" 
                                role="tab" 
                                aria-controls="pills-edit-profile" 
                                aria-selected="true">
                                Edit Profile
                            </button>
                        </li>
                                     
                    </ul>
                    

                    <div class="tab-content" id="pills-tabContent">   
                        <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                            <div class="d-flex justify-content-center">
                                <h2 class="text-md text-primary-light mb-16">Profile User</h2>
                            </div>
                            
                            <!-- Upload Image Start -->
                           
                            <!-- Upload Image End -->
                            <form action="{{ route('user.updateOtherProfiles', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf <!-- Protection CSRF -->
                                @method('POST')
                                <div class="mb-24 mt-16">
                                    <div class="mb-3 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($userWithProfile->profile_picture) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 50%;">
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name<span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="name" name="first_name" value="{{ $userWithProfile->first_name }}" placeholder="Enter Full Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="last_name" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="last_name" name="last_name" value="{{ $userWithProfile->last_name }}" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                            <input type="text" class="form-control radius-8" id="number" name="phone" value="{{ $userWithProfile->phone }}" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email</label>
                                            <input type="email" class="form-control radius-8" id="email" name="email" value="{{ $user->email }}" placeholder="Enter email address">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="role" class="form-label fw-semibold text-primary-light text-sm mb-8">Role</label>
                                            <select class="form-control radius-8" id="role" name="role">
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="super-admin" {{ $user->role == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="image" class="form-label fw-semibold text-primary-light text-sm mb-8">Image</label>
                            
                                            <div class="mb-20">
                                                <label for="image">Image <span class="text-danger-600">*</span></label>
                                                <input type="file" class=" form-control radius-8" id="image" name="image" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                                    <button type="submit" class="btn" style="background-color: #ffda40; border-color: #ffda40; color:black; font-family: 'Arial', sans-serif; padding: 10px 90px; border-radius: 20px; font-size: 20px; font-weight: bold;">
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