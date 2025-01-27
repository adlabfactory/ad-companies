<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  <div>
    <a href="index.html" class="sidebar-logo">
      <img src="assets/images/logo.png" alt="site logo" class="light-logo">
      <img src="assets/images/logo-light.png" alt="site logo" class="dark-logo">
      <img src="assets/images/logo-icon.png" alt="site logo" class="logo-icon">
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
<a href="{{ route('dashboard') }}">
    <iconify-icon icon="mdi:account-group" class="menu-icon"></iconify-icon>
    <span>Users List</span> 
  </a>
  <a href="{{ route('dashboard') }}">
    <iconify-icon icon="mdi:account-plus" class="menu-icon"></iconify-icon>
    <span>Add User</span>
  </a>
</li>
<li>
  <a href="{{ route('dashboard') }}">
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