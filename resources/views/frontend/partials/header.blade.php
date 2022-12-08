<header class="header bg-white">
  <div class="container px-lg-3">
    <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0">
      <a class="navbar-brand" href="{{ url('/') }}">
        <span class="fw-bold text-uppercase text-dark">{{ config('app.name', 'Clashy') }}</span>
      </a>
      <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.html">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="detail.html">Contact Us</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#!"> 
              <i class="far fa-heart me-1"></i><small class="text-gray fw-normal"> (0)</small></a>
          </li>

          @guest
            <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">
              <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a>
            </li>
          @else
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          @endguest
        </ul>
      </div>
    </nav>
  </div>
</header>