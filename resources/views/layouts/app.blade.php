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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- JQuery Cropper --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
  <nav class="navbar navbar-dark navbar-expand-lg navtop">
    <div class="container navtop-container">
      <button class="navbar-toggler navtop-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navtop" aria-controls="navtop" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navtop">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <div class="navtop-social-links">
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
          </div>
          <li class="nav-item">
            <a class="nav-link" href="#">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact us</a>
          </li>
        </ul>
      </div>
      <ul class="navbar-nav static-navtop-list">
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
            <a id="navtop-profile-dropdown" class="nav-link dropdown-toggle navtop-profile-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset(Auth::user()->image->url) }}" class="rounded-circle navtop-profile-image" alt="Profile image"> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
              @if (Auth::user()->is_admin)
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
              @endif
              <li>
                <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
              </li>
              <hr class="dropdown-divider">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </nav>
  <section class="header">
    <div class="container">
        <img class="header-logo" src="{{asset('images/header-logo.png')}}" alt="">
    </div>
  </section>
  <nav class="navbar navbar-dark navbar-expand-lg navbar-center sticky-top">
    <div class="container">
      <button class="navbar-toggler navbar-center-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-center" aria-controls="navbar-center" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}"><i class="bi bi-house-door-fill me-1"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Gaming</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Technology</a>
        </li>
      </ul>
      <div class="collapse navbar-collapse" id="navbar-center">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <form action="">
              <div class="nav-search">
                <i class="bi bi-search"></i>
                <input type="search" name="" id="" placeholder="Search">
              </div>
            </form>
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
  @if (isset($scroll) || session('scroll'))
    <script>
      $([document.documentElement, document.body]).animate({
          scrollTop: $("{{ $scroll ?? session('scroll') }}").offset().top-100
      });
    </script>
  @endif
</body>
</html>
