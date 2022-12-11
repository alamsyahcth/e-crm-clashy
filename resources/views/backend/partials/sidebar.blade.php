<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ url('/') }}">
        <h6>{{ config('app.name', 'Clashy') }}</h6>
      </a>
    </li>
    <li class="nav-item active mt-5">
      <a class="nav-link active @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-compass-outline menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/customer*')) active @endif" href="{{ url('admin/customer') }}">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Customer</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-message-text-outline menu-icon"></i>
        <span class="menu-title">Diskusi</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-thumb-down-outline menu-icon"></i>
        <span class="menu-title">Keluhan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-contact-mail menu-icon"></i>
        <span class="menu-title">Kontak</span>
      </a>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item @if(request()->is('admin/produk*') || request()->is('admin/kategori-produk*')) active @endif">
      <a class="nav-link @if(!request()->is('admin/produk*') || !request()->is('admin/kategori-produk*')) collapsed @endif" data-toggle="collapse" href="#menu-products" aria-expanded="@if(request()->is('admin/produk*') || request()->is('admin/kategori-produk*')) true @else false @endif" aria-controls="menu-products">
        <i class="mdi mdi-sunglasses menu-icon"></i>
        <span class="menu-title">Produk</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse @if(request()->is('admin/produk*') || request()->is('admin/kategori-produk*')) show @endif" id="menu-products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item @if(request()->is('admin/produk*')) active @endif">
            <a class="nav-link @if(request()->is('admin/produk*')) active @endif" href="{{ url('admin/produk') }}">Data Produk</a>
          </li>
          <li class="nav-item @if(request()->is('admin/kategori-produk*')) active @endif">
            <a class="nav-link @if(request()->is('admin/kategori-produk*')) active @endif" href="{{ url('admin/kategori-produk') }}">Kategori Produk</a>
          </li>
        </ul>
      </div>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Laporan 1</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Laporan 2</span>
      </a>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item @if(request()->is('admin/user') || request()->is('admin/user/create') || request()->is('admin/banner*')) active @endif">
      <a class="nav-link @if(!request()->is('admin/user') || !request()->is('admin/user/create') || !request()->is('admin/banner*')) collapsed @endif" data-toggle="collapse" href="#menu-settings" aria-expanded="@if(request()->is('admin/user') || request()->is('admin/user/create') || request()->is('admin/banner*')) true @else false @endif" aria-controls="menu-settings">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Pengaturan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse @if(request()->is('admin/user') || request()->is('admin/user/create') || request()->is('admin/banner*')) show @endif" id="menu-settings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item @if(request()->is('admin/banner*')) active @endif">
            <a class="nav-link @if(request()->is('admin/banner*')) active @endif" href="{{ url('admin/banner') }}">Banner</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(request()->is('admin/dashboard*')) active @endif" href="{{ url('admin/dashboard') }}">General</a>
          </li>
          <li class="nav-item @if(request()->is('admin/user') || request()->is('admin/user/create')) active @endif">
            <a class="nav-link @if(request()->is('admin/user') || request()->is('admin/user/create')) active @endif" href="{{ url('admin/user') }}">Manage Admin</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>