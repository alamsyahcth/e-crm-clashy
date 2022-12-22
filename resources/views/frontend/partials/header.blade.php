<header class="header bg-white">
  <div class="container px-lg-3">
    <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('img/logo.jpg') }}" alt="" width="150px">
      </a>
      <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link @if(request()->is('/')) active @endif" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(request()->is('produk*')) active @endif" href="{{ url('/produk') }}">Produk</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          @guest
            <li class="nav-item"><a class="nav-link @if(request()->is('login*')) active @endif" href="{{ url('login') }}">
              <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a>
            </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="authDropdown" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user me-1 text-gray fw-normal"></i> {{ Auth::user()->email }}
              </a>
              <div class="dropdown-menu mt-3 shadow-sm" style="min-width: 12rem;" aria-labelledby="authDropdown">
                <a class="dropdown-item border-0 transition-link" href="{{ url('profil') }}"><i class="far fa-user text-gray me-2"></i>Profil</a>
                <a class="dropdown-item border-0 transition-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt text-gray me-2"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
                </div>
            </li>
          @endguest
        </ul>
      </div>
    </nav>
  </div>
</header>