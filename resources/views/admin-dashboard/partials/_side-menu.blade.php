<aside class="sidebar">
  <style>
    .sidebar-logo {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%; /* Ajuste si nécessaire */
    }
  
    .center-img {
      display: block;
      margin: 0 auto;
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

<!--li class="sidebar-menu-group-title">Application</li-->
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
  <a href="{{ route('/profileuser') }}">
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