<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  <nav class="navbar navbar-expand-lg navtop">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-facebook"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-instagram"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-youtube"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-twitter"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>
        </ul>
        <ul class="navbar-nav d-flex">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @if (Auth::user()->is_admin)
                  <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                  <hr class="dropdown-divider">
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <section class="header">
    <div class="container">
        <img class="header-logo" src="{{asset('images/header-logo.png')}}" alt="">
    </div>
  </section>
  <nav class="navbar navbar-expand-lg navbar-center">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Gaming</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Technology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Global news</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Programming</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tutorials</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Play lists</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="py-4">
    <div class="container">
      @yield('content')
    </div>
  </main>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="footer-list">
            <h4 class="footer-list-title">World of technology</h4>
            <ul>
              <li><p>Sed dapibus ipsum eu ante dapibus volutpat, Ut vestibulum risus id urna molestie scelerisque.</p></li>
              <li><a class="pe-1" href="#"><i class="bi bi-facebook"></i></a> <a class="pe-1" href="#"><i class="bi bi-instagram"></i></a> <a class="pe-1" href="#"><i class="bi bi-twitter"></i></a> <a class="pe-1" href="#"><i class="bi bi-youtube"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="footer-list">
            <h4 class="footer-list-title">Highlights</h4>
            <ul>
              <li><a href="#">Advertise</a></li>
              <li><a href="#">Comunnety</a></li>
              <li><a href="#">Forum</a></li>
              <li><a href="#">Jobs</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="footer-list">
            <h4 class="footer-list-title">Useful</h4>
            <ul>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms And Conditions</a></li>
              <li><a href="#">Contact us</a></li>
              <li><a href="#">About us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-copyrights">
      <div class="container">
        <span>Copyrights 2022-2022 World Of Technology | Powered by Corak LLC</span>
      </div>
    </div>
  </footer>
</body>
</html>
