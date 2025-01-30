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
      background:  #ffda40 !important; /* Fond noir */
      color: black!important; /* Texte blanc */
      outline: none; /* Supprime le contour de focus bleu par défaut */
}
.sidebar-menu a:not(:hover):not(:active) {
  background:transparent; /* Fond transparent lorsque ni hover ni focus */
  color: black; /* Texte noir */
}


    /* Lorsque le lien est actif, focus ou survolé */
.sidebar-menu a:active,
.sidebar-menu a:hover {
  background:  #ffda40 !important; /* Fond noir */
  color: black!important; /* Texte blanc */
  outline: none; /* Supprime le contour de focus bleu par défaut */
}

  </style>
  
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  
  <div>
    <a href="index.html" class="sidebar-logo">
      <img src="https://adlabfactory.com/wp-content/uploads/2024/12/Adlab-dark-Logo-siteweb.png" width="150" />
    </a>
  </div>
  
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      <li>
        <a href="{{ route('dashboard') }}">
          <iconify-icon icon="mdi:home" class="menu-icon"></iconify-icon>
          <span>Home</span>
        </a>
      </li>
      <li>
        <a href="{{ route('userslist') }}">
          <iconify-icon icon="mdi:account-group" class="menu-icon"></iconify-icon>
          <span>Users List</span>
        </a>
        <a href="{{ route('user.create') }}">
          <iconify-icon icon="mdi:account-plus" class="menu-icon"></iconify-icon>
          <span>Add User</span>
        </a>
      </li>
      <li>
        <a href="{{ route('profile.edit') }}">
          <iconify-icon icon="mdi:account-circle" class="menu-icon"></iconify-icon>
          <span>Profile</span>
        </a>
      </li>
      <li>
        <a href="chat-message.html">
          <iconify-icon icon="mdi:cog" class="menu-icon"></iconify-icon>
          <span>Settings</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
