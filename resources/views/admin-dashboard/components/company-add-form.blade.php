<style>
    .cardclasse {
    position: relative; /* Assure-toi que le card ne force pas un positionnement absolu */
    padding-bottom: 30px !important;
}

    .rounded-8 {
      border-radius: 8px;
    }
    .rounded-12 {
      border-radius: 12px;
    }
    .padding-40 {
      padding: 40px;
    }
    .margin-bottom-20 {
      margin-bottom: 20px;
    }
    .font-weight-semibold {
      font-weight: 600;
    }
    .text-primary-muted {
      color: #6c757d;
    }
    .text-danger-600 {
      color: #dc3545;
    }
    .bg-hover-danger-200:hover {
      background-color: #f8d7da;
    }
</style>

<body>
    <div class="card cardclasse h-100 p-0 rounded-12 overflow-hidden">
        <div class="card-body padding-40">
            <h4>Company</h4>
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_name" class="form-label font-weight-semibold text-primary-muted">
                                Company Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('company_name') is-invalid @enderror"
                                   id="company_name" name="company_name" value="{{ old('company_name') }}"
                                   placeholder="Enter Company Name" required>
                            @error('company_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_category" class="form-label font-weight-semibold text-primary-muted">
                                Company Category <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('company_category') is-invalid @enderror"
                                   id="company_category" name="company_category" value="{{ old('company_category') }}"
                                   placeholder="Enter Company Category" required>
                            @error('company_category')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-12">
                        <div class="margin-bottom-20">
                            <label for="company_address" class="form-label font-weight-semibold text-primary-muted">
                                Company Address <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('company_address') is-invalid @enderror"
                                   id="company_address" name="company_address" value="{{ old('company_address') }}"
                                   placeholder="Enter Company Address" required>
                            @error('company_address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-12">
                        <div class="margin-bottom-20">
                            <label for="company_description" class="form-label font-weight-semibold text-primary-muted">
                                Company Description
                            </label>
                            <textarea class="form-control rounded-8 @error('company_description') is-invalid @enderror"
                                      id="company_description" name="company_description"
                                      placeholder="Enter Company Description">{{ old('company_description') }}</textarea>
                            @error('company_description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_phone" class="form-label font-weight-semibold text-primary-muted">
                                Company Phone <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('company_phone') is-invalid @enderror"
                                   id="company_phone" name="company_phone" value="{{ old('company_phone') }}"
                                   placeholder="Enter Phone Number" required>
                            @error('company_phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_email" class="form-label font-weight-semibold text-primary-muted">
                                Company Email <span class="text-danger-600">*</span>
                            </label>
                            <input type="email" class="form-control rounded-8 @error('company_email') is-invalid @enderror"
                                   id="company_email" name="company_email" value="{{ old('company_email') }}"
                                   placeholder="Enter Company Email" required>
                            @error('company_email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_rc" class="form-label font-weight-semibold text-primary-muted">
                                Company RC <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('company_rc') is-invalid @enderror"
                                   id="company_rc" name="company_rc" value="{{ old('company_rc') }}"
                                   placeholder="Enter Company RC" required>
                            @error('company_rc')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="company_website_domain" class="form-label font-weight-semibold text-primary-muted">
                                Company Website <span class="text-danger-600">*</span>
                            </label>
                            <input type="url" class="form-control rounded-8 @error('company_website_domain') is-invalid @enderror"
                                   id="company_website_domain" name="company_website_domain" value="{{ old('company_website_domain') }}"
                                   placeholder="Enter Company Website" required>
                            @error('company_website_domain')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="password" class="form-label font-weight-semibold text-primary-muted">
                                Password <span class="text-danger-600">*</span>
                            </label>
                            <input type="password" class="form-control rounded-8 @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Enter Password" required>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="password_confirmation" class="form-label font-weight-semibold text-primary-muted">
                                Confirm Password <span class="text-danger-600">*</span>
                            </label>
                            <input type="password" class="form-control rounded-8"
                                   id="password_confirmation" name="password_confirmation"
                                   placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="margin-bottom-20">
                        <label for="password" class="form-label font-weight-semibold text-primary-muted">
                            Image <span class="text-danger-600">*</span>
                        </label>
                        <input type="file" class="form-control rounded-8 @error('logo') is-invalid @enderror"
                               id="logo" name="company_logo" placeholder="Enter Logo" required>
                        @error('company_logo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="contact_person_name" class="form-label font-weight-semibold text-primary-muted">
                                Contact Person Name <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('contact_person_name') is-invalid @enderror"
                                   id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name') }}"
                                   placeholder="Enter Contact Person Name" required>
                            @error('contact_person_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="contact_person_role" class="form-label font-weight-semibold text-primary-muted">
                                Contact Person Role <span class="text-danger-600">*</span>
                            </label>
                            <input type="text" class="form-control rounded-8 @error('contact_person_role') is-invalid @enderror"
                                   id="contact_person_role" name="contact_person_role" value="{{ old('contact_person_role') }}"
                                   placeholder="Enter Contact Person Role" required>
                            @error('contact_person_role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="status" class="form-label font-weight-semibold text-primary-muted">
                                Subscription Status <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control rounded-8 @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-sm-6">
                        <div class="margin-bottom-20">
                            <label for="devis_status" class="form-label font-weight-semibold text-primary-muted">
                                Devis Status <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-control rounded-8 @error('devis_status') is-invalid @enderror" id="devis_status" name="devis_status" required>
                                <option value="">Select Devis Status</option>
                                <option value="pending" {{ old('devis_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('devis_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('devis_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('devis_status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="d-flex flex-column align-items-center justify-content-center mt-auto">
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
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
