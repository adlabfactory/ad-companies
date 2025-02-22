<!-- Ajouter Font Awesome dans le head -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>


</style>
<div class="dashboard-main-body">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 ">
    </div>
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <form class="navbar-search">
                    <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
            </div>
            <div class="d-flex gap-2"> <!-- Utilisation de Flexbox avec un espace entre les éléments -->
                <a href="{{ route('companies.create') }}" class="btn btn-outline-warning-600 radius-8 px-20 py-11">Add Company</a>
                <a href="{{ route('companies.list') }}" class="btn btn-outline-dark radius-8 px-20 py-11">
                    <i class="fas fa-building"></i>
                </a>
            </div>                       
        </div>
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Category</th>
                            <th scope="col">Company Rc</th>
                            <th scope="col">User</th>
                            <th scope="col">Subscription Start</th>
                            <th scope="col">Devis Status</th>
                            <th scope="col">Website Domain</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->company_category }}</td>
                                <td>{{ $company->company_rc}}</td>
                                <td>{{ $company->user->handle }}</td>
                                <td>{{ $company->subscription_start_at}}</td>
                                <td>{{ $company->devis_status }}</td>
                                <td>{{ $company->company_website_domain }}</td>
                                <td>
                                    <form action="{{ route('companies.restore', $company->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background-color: #E8BC05; border-color: #E8BC05; color: white;">
                                            <i class="fas fa-undo"></i> Restore
                                        </button>                                        
                                    </form>                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                   
                </table>
                
            </div>
        </div>
    </div>
</div>
<div class="card-body p-24">
       
</div>




