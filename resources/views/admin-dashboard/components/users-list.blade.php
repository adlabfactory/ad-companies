
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 ">
    </div>


    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
                <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
                <form class="navbar-search">
                    <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form>
                <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                    <option>Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
            <button type="button" class="btn btn-outline-warning-600 radius-8 px-20 py-11">Add User</button>
        </div>
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Join Date</th>
                            <th scope="col" class="text-center">Status</th>
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
                
                            <!-- Affichage du statut de l'utilisateur avec un switch -->
                            <td class="text-center">
                                <div class="form-switch switch-warning d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch{{ $user->id }}"
                                        {{ $user->is_active ? 'checked' : '' }}>
                                </div>
                            </td>
                
                            <!-- Affichage des actions -->
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <!-- Vue -->
                                    <button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                    </button>
                                    
                                    <!-- Édition -->
                                    <button type="button" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </button>
                                    
                                    <!-- Suppression -->
                                    <form action="{{ route('profile.destroy', $user->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
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
