<x-layout>
    @if(session('error'))
    <div class="alert alert-custom alert-dismissible fade show" role="alert">
        <div class="alert-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="alert-content">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<style>
    .alert-custom {
    background-color: #ffebee; /* Fond légèrement rouge */
    border-color: #ffcdd2; /* Bordure rouge clair */
    color: #c62828; /* Texte rouge foncé */
    padding: 1rem 1.5rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.alert-icon {
    margin-right: 1rem;
    font-size: 1.5rem;
    color: #c62828; /* Icône rouge foncé */
}

.alert-content {
    flex-grow: 1;
}

.btn-close {
    margin-left: auto;
    color: #c62828; /* Couleur de l'icône de fermeture */
}
</style>
 
        @include('admin-dashboard.components.dashboard-cards')
</x-layout>