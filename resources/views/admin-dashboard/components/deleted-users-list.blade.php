<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="dashboard-main-body">
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
                <a href="{{route('user.add') }}" class="btn btn-outline-warning-600 radius-8 px-20 py-11">Add User</a>
                <a href="{{ route('userslist') }}" class="btn btn-outline-dark radius-8 px-20 py-11">
                    <i class="fas fa-users"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Join Date</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <!-- Affichage du nom -->
                            <td>{{ $user->handle }}</td>
                
                            <!-- Affichage de l'email -->
                            <td>{{ $user->email }}</td>
                
                            <!-- Affichage de la date d'inscription -->
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}
                            </td>
                            <!-- Affichage des actions -->
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <!-- Vue -->
                                    <form action="{{ route('user.restore', $user->id) }}" method="get" class="d-inline">
                                        @method('GET')
                                        @csrf
                                        <button type="submit" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </button>
                                    </form>
                                    
                                    
                    
     
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<div class="pagination-custom">
    {{$users->links()}}
</div>
