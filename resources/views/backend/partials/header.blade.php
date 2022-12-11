<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-chevron-double-left"></span>
    </button>
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('backend/images/logo-mini.svg') }}"
          alt="logo" /></a>
    </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown d-none d-md-block">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-text">{{ Auth::user()->email }}</div>
        </a>
        <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="{{ url('admin/user/edit') }}">Edit Profil</a>
          <a class="dropdown-item" href="{{ url('admin/user/change-password') }}">Ubah Password</a>
          <hr>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>