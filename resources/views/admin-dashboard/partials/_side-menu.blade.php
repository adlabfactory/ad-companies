<aside class="sidebar">
  <style>
    .sidebar-logo {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
    .center-img {
      display: block;
      margin: 0 auto;
    }
    /* Style pour les liens de la sidebar */
    .sidebar-menu a {
      text-decoration: none; /* Supprime la décoration par défaut du lien */
      color: black; /* Couleur par défaut du texte */
      padding: 10px;
      display: flex;
      align-items: center;
    }
    .sidebar-menu a:focus {
      background: #ffda40 !important; /* Fond jaune */
      color: black !important; /* Texte noir */
      outline: none; /* Supprime le contour de focus bleu par défaut */
    }
    .sidebar-menu a:not(:hover):not(:active) {
      background: transparent; /* Fond transparent lorsque ni hover ni focus */
      color: black; /* Texte noir */
    }
    /* Lorsque le lien est actif, focus ou survolé */
    .sidebar-menu a:active,
    .sidebar-menu a:hover {
      background: #ffda40 !important; /* Fond jaune */
      color: black !important; /* Texte noir */
      outline: none; /* Supprime le contour de focus bleu par défaut */
    }
  </style>

  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>

  <div>
    <a href="#" class="sidebar-logo">
      <img src="https://adlabfactory.com/wp-content/uploads/2024/12/Adlab-dark-Logo-siteweb.png" width="150" />
    </a>
  </div>

  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      <!-- Lien Home accessible pour tous les utilisateurs -->
      @if(Auth::guard('web')->check())
      <li>
        <a href="{{ route('dashboard') }}">
          <iconify-icon icon="mdi:home" class="menu-icon"></iconify-icon>
          <span>Home</span>
        </a>
      </li>
      <!-- Lien Packs List accessible pour tous les utilisateurs -->
      <li>
        <a href="{{ route('packs.list') }}">
          <iconify-icon icon="mdi:view-list" class="menu-icon"></iconify-icon>
          <span>Packs List</span>
        </a>
      </li>
      @endif
      @if(Auth::guard('company')->check())
      <li>
        <a href="{{ route('company.dashboard') }}">
          <iconify-icon icon="mdi:home" class="menu-icon"></iconify-icon>
          <span>Home</span>
        </a>
      </li>
      <!-- Lien Packs List accessible pour tous les utilisateurs -->
      <li>
        <a href="{{ route('packs.packslist') }}">
          <iconify-icon icon="mdi:view-list" class="menu-icon"></iconify-icon>
          <span>Packs List</span>
        </a>
      </li>
      <li>
        <a href="{{ route('projects.create') }}">
          <iconify-icon icon="mdi:folder-plus" class="menu-icon"></iconify-icon>
          <span>Add Project</span>
        </a>
      </li>
      @endif
  
      <!-- Liens accessibles uniquement pour les utilisateurs authentifiés -->
      @if(Auth::guard('web')->check())
        <li>
          <a href="{{ route('profile.edit') }}">
            <iconify-icon icon="mdi:account-circle" class="menu-icon"></iconify-icon>
            <span>Profile</span>
          </a>
        </li>
      @endif
  
      <!-- Liens accessibles uniquement pour l'utilisateur ayant le rôle 'company' -->
      @if(Auth::guard('web')->check() && Auth::guard('web')->user()->role === 'company')
        <!-- Pas besoin de répéter 'Packs List' ici, car il est déjà visible au-dessus -->
      @endif
  
      <!-- Liens accessibles uniquement pour l'utilisateur ayant le rôle 'super-admin' -->
      @if(Auth::guard('web')->check() && Auth::guard('web')->user()->role === 'super-admin')
        <li>
          <a href="{{ route('userslist') }}">
            <iconify-icon icon="mdi:account-group" class="menu-icon"></iconify-icon>
            <span>Users List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user.add') }}">
            <iconify-icon icon="mdi:account-plus" class="menu-icon"></iconify-icon>
            <span>Add User</span>
          </a>
        </li>
      @endif
  
      <!-- Liens accessibles pour tous les utilisateurs avec authentification -->
      @if(Auth::guard('web')->check())
        <li>
          <a href="{{ route('companies.create') }}">
            <iconify-icon icon="fa6-solid:building" class="menu-icon"></iconify-icon>
            <span>Add Company</span>
          </a>
        </li>
        <li>
          <a href="{{ route('companies.list') }}">
            <iconify-icon icon="mdi:home-city" class="menu-icon"></iconify-icon>
            <span>Companies List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('packs.create') }}">
            <iconify-icon icon="mdi:package-variant-closed" class="menu-icon"></iconify-icon>
            <span>Add Pack</span>
          </a>
        </li>
        <li>
          <a href="{{ route('features.create') }}">
            <iconify-icon icon="mdi:star-circle" class="menu-icon"></iconify-icon>
            <span>Add Feature</span>
          </a>
        </li>
      @endif
      <li>
        <a href="{{ route('projects.index') }}">
            <iconify-icon icon="mdi:folder-multiple" class="menu-icon"></iconify-icon> <!-- Changer l'icône ici -->
            <span>Projects List</span>
        </a>
    </li>    
    </ul>
  </div>
  
</aside>