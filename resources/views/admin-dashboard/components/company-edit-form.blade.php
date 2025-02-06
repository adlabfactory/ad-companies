<style>
    .company-grid-card {
        min-height: 350px;
    }

    .card {
        min-height: 350px;
        display: flex;
        flex-direction: column;
    }

    .card-body {
        flex-grow: 1;
    }
</style>
@if (session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000); // 5000ms = 5 seconds
    </script>
@endif
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">View Company Profile</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">View Company</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-4 py-4">
            <div class="company-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                <img src="{{ asset($company->logo) }}" alt="Company Logo" class="w-100 object-fit-cover" style="height: 20%;">
                <div class="pb-24 ms-16 mb-24 me-16 mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        <img src="{{ asset($company->logo) }}" alt="Company Logo" class="border border-white border-2 w-200px h-auto rounded-circle object-fit-cover" style="height: 150px; width: 150px;">
                        <h6 class="mb-0 mt-16">{{ $company->company_name}}</h6>
                        <span class="text-secondary-light mb-16"></span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16 text-center">Company Info</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Category:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->company_category}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Email:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->company_email}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Phone:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->company_phone}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">RC:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->company_rc}}</span>
                            </li>
    
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Name Contact: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->contact_person_name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Contact: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->contact_person_role }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Address:</span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->company_address }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">User: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->user->handle}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Statut Devis: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->devis_status}}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Subscription Start: </span>
                                <span class="w-70 text-secondary-light fw-medium">{{ $company->subscription_start_at}}</span>
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
                                Edit Company Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center px-24" 
                                id="pills-edit-subscription-tab" 
                                data-bs-toggle="pill" 
                                data-bs-target="#pills-edit-subscription" 
                                type="button" 
                                role="tab" 
                                aria-controls="pills-edit-subscription" 
                                aria-selected="false">
                                Edit Subscription Details
                            </button>
                        </li>
                    </ul>                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel">
                            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-24 mt-16">
                                    <div class="mb-3 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($company->logo) }}" alt="Company Logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 50%;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_name" class="form-label fw-semibold text-primary-light text-sm mb-8">Company Name<span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}" placeholder="Enter Company Name">
                                            @error('company_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="industry" class="form-label fw-semibold text-primary-light text-sm mb-8">Category</label>
                                            <input type="text" class="form-control radius-8" id="category" name="category" value="{{ old('category', $company->company_category) }}" placeholder="Enter Industry">
                                            @error('category')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_phone" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                            <input type="text" class="form-control radius-8" id="company_phone" name="company_phone" value="{{ old('company_phone', $company->company_phone) }}" placeholder="Enter Phone Number">
                                            @error('company_phone')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email</label>
                                            <input type="email" class="form-control radius-8" id="company_email" name="company_email" value="{{ old('company_email', $company->company_email) }}" placeholder="Enter Email Address">
                                            @error('company_email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_address" class="form-label fw-semibold text-primary-light text-sm mb-8">Address</label>
                                            <input type="text" class="form-control radius-8" id="address" name="company_adress" value="{{ old('company_address', $company->company_address) }}" placeholder="Enter Address">
                                            @error('company_adress')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="contact" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact Name</label>
                                            <input type="text" class="form-control radius-8" id="contact" name="contact_person_name" value="{{ old('contact_person_name', $company->contact_person_name) }}" placeholder="Enter Contact Name">
                                            @error('contact_person_name')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_adress" class="form-label fw-semibold text-primary-light text-sm mb-8">Contact Role</label>
                                            <input type="text" class="form-control radius-8" id="adress" name="contact_person_role" value="{{ old('contact_person_role', $company->contact_person_role) }}" placeholder="Enter Contact Role">
                                            @error('contact_person_role')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="mb-20">
                                            <label for="company_logo" class="form-label fw-semibold text-primary-light text-sm mb-8">Company Logo</label>
                                            <input type="file" class="form-control radius-8" id="company_logo" name="company_logo">
                                            @error('company_logo')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                                    <button type="submit" class="btn" style="background-color: #E8BC05; border-color: #E8BC05; color:black; font-family: 'Arial', sans-serif; padding: 10px 90px; border-radius: 20px; font-size: 20px; font-weight: bold;">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-edit-subscription" role="tabpanel">
                            <form action="{{ route('companies.updatecompanydetails', $company->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-24 mt-16">
                                    <div class="mb-3 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($company->logo) }}" alt="Company Logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 50%;">
                                    </div>
                                </div>
                            
                                <div class="mb-20">
                                    <label for="subscription_start" class="form-label fw-semibold text-primary-light text-sm mb-8">Subscription Start</label>
                                    <input type="date" class="form-control radius-8 @error('subscription_start') is-invalid @enderror" id="subscription_start" name="subscription_start" value="{{ old('subscription_start', substr($company->subscription_start_at, 0, 10)) }}">
                                    @error('subscription_start')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="subscription_end" class="form-label fw-semibold text-primary-light text-sm mb-8">Subscription End</label>
                                    <input type="date" class="form-control radius-8 @error('subscription_end') is-invalid @enderror" id="subscription_end" name="subscription_end" value="{{ old('subscription_end', substr($company->subscription_end_at, 0, 10)) }}">
                                    @error('subscription_end')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Status</label>
                                    <select class="form-control radius-8 @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="active" {{ old('status', $company->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $company->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="devis_status" class="form-label fw-semibold text-primary-light text-sm mb-8">Devis Status</label>
                                    <select class="form-control radius-8 @error('devis_status') is-invalid @enderror" id="devis_status" name="devis_status">
                                        <option value="approved" {{ old('devis_status', $company->devis_status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="pending" {{ old('devis_status', $company->devis_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="rejected" {{ old('devis_status', $company->devis_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('devis_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-20">
                                    <label for="company_website_domaine" class="form-label fw-semibold text-primary-light text-sm mb-8">Company Website Domain</label>
                                    <input type="url" class="form-control radius-8 @error('company_website_domaine') is-invalid @enderror" id="company_website_domaine" name="company_website_domaine" value="{{ old('company_website_domaine', $company->company_website_domain) }}" placeholder="Enter Company Website Domain">
                                    @error('company_website_domaine')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                                    <button type="submit" class="btn" style="background-color: #E8BC05; border-color: #E8BC05; color:black; font-family: 'Arial', sans-serif; padding: 10px 90px; border-radius: 20px; font-size: 20px; font-weight: bold;">
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
