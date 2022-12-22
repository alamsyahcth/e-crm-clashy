<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item pt-3">
      <a class="nav-link d-block" href="{{ url('/') }}">
        <h6><img src="{{ asset('img/logo.jpg') }}" alt="" width="150px"></h6>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/dashboard')) active @endif mt-5">
      <a class="nav-link @if(request()->is('admin/dashboard')) active @endif" href="{{ url('admin/dashboard') }}">
        <i class="mdi mdi-compass-outline menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item @if(request()->is('admin/booking*')) active @endif">
      <a class="nav-link @if(request()->is('admin/booking*')) active @endif" href="{{ url('admin/booking') }}">
        <i class="mdi mdi mdi-book-open menu-icon"></i>
        <span class="menu-title">Booking</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/jadwal*')) active @endif">
      <a class="nav-link @if(request()->is('admin/jadwal*')) active @endif" href="{{ url('admin/jadwal') }}">
        <i class="mdi mdi-calendar-multiple menu-icon"></i>
        <span class="menu-title">Atur Jadwal</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/diskusi*')) active @endif">
      <a class="nav-link @if(request()->is('admin/diskusi*')) active @endif" href="{{ url('admin/diskusi') }}">
        <i class="mdi mdi-message-text-outline menu-icon"></i>
        <span class="menu-title">Diskusi</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/keluhan*')) active @endif">
      <a class="nav-link @if(request()->is('admin/keluhan*')) active @endif" href="{{ url('admin/keluhan') }}">
        <i class="mdi mdi-emoticon-sad menu-icon"></i>
        <span class="menu-title">Keluhan</span>
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
    <li class="nav-item @if(request()->is('admin/customer*')) active @endif">
      <a class="nav-link @if(request()->is('admin/customer*')) active @endif" href="{{ url('admin/customer') }}">
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
        <span class="menu-title">Customer</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/karyawan*')) active @endif">
      <a class="nav-link @if(request()->is('admin/karyawan*')) active @endif" href="{{ url('admin/karyawan') }}">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Karyawan</span>
      </a>
    </li>
    <div class="py-1">
      <hr>
    </div>
    <li class="nav-item @if(request()->is('admin/laporan/laporan-register*')) active @endif">
      <a class="nav-link @if(request()->is('admin/laporan/laporan-register*')) active @endif" href="{{ url('admin/laporan/laporan-register') }}">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Laporan Register</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/laporan/laporan-review*')) active @endif">
      <a class="nav-link @if(request()->is('admin/laporan/laporan-review*')) active @endif" href="{{ url('admin/laporan/laporan-review') }}">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Laporan Review</span>
      </a>
    </li>
    <li class="nav-item @if(request()->is('admin/laporan/laporan-data-booking')) active @endif">
      <a class="nav-link @if(request()->is('admin/laporan/laporan-data-booking')) active @endif" href="{{ url('admin/laporan/laporan-data-booking') }}">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Laporan Data Booking</span>
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
          <li class="nav-item @if(request()->is('admin/user') || request()->is('admin/user/create')) active @endif">
            <a class="nav-link @if(request()->is('admin/user') || request()->is('admin/user/create')) active @endif" href="{{ url('admin/user') }}">Manage Admin</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>