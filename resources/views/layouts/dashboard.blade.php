<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.title') }} | Dashboard</title>

    <meta name="description" content="{{ config('app.description') }}">

    @if (Storage::disk('public')->exists('icon.png'))
      <link rel="icon" type="image/png" href="{{ asset('storage/icon.png') }}">
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

    {{-- jQuery cropper --}}
    <script src="{{ asset('assets/cropper.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/cropper.css') }}">
    <script src="{{ asset('assets/jquery-cropper.js') }}"></script>

    {{-- Quill editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    {{-- Compressor --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js" integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>
<body class="dashboard">
  <div class="row w-100 m-0">
    <div class="col-md-2 p-0">
      <nav class="navbar navbar-dark navbar-expand-lg dashboard-sidebar">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}" target="_blank">
            @if (Storage::disk('public')->exists('logo_dark.png'))
              <link rel="icon" type="image/png" href="{{ asset('storage/logo_dark.png') }}">
              <img class="header-logo" src="{{ asset('storage/logo_dark.png') }}" alt="{{ config('app.title') }} logo">
            @else
              <img src="{{ asset('images/header-logo-dark.png') }}" alt="{{ config('app.title') }} logo">
            @endif
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Dashboard</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><span class="dashboard-list-icon"><i class="bi bi-pie-chart-fill"></i></span> Analytics</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Configuration</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'config.index' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('config.index') }}"><span class="dashboard-list-icon"><i class="bi bi-gear-fill"></i></span> Blog</a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() == 'config.navbar' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('config.navbar') }}"><span class="dashboard-list-icon"><i class="bi bi-ui-checks"></i></span> Navbar</a>
              </li>
              {{-- <li class="nav-item {{ Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><span class="dashboard-list-icon"><i class="bi bi-grid-1x2-fill"></i></span> Sidebar</a>
              </li> --}}
              <li class="nav-item {{ Route::currentRouteName() == 'config.footer' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('config.footer') }}"><span class="dashboard-list-icon"><i class="bi bi-view-list"></i></span> Footer</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Users</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><span class="dashboard-list-icon"><i class="bi bi-people-fill"></i></span> Manage Users</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Categories</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'categories.index' || Route::currentRouteName() == 'categories.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}"><span class="dashboard-list-icon"><i class="bi bi-bookmarks-fill"></i></span> Manage Categories</a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() == 'categories.create' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories.create') }}"><span class="dashboard-list-icon"><i class="bi bi-bookmark-plus-fill"></i></span> New Category</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Posts</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'posts.index' || Route::currentRouteName() == 'posts.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}"><span class="dashboard-list-icon"><i class="bi bi-file-bar-graph-fill"></i></span> Manage Posts</a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() == 'posts.create' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.create') }}"><span class="dashboard-list-icon"><i class="bi bi-file-richtext-fill"></i></span> New post</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <li class="nav-item {{ Route::currentRouteName() == 'route' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}" target="_blank"><span class="dashboard-list-icon"><i class="bi bi-box-arrow-up-right"></i></span> View Blog</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="col-md-10 p-0 dashboard-content">
      <nav class="dashboard-nav-top">
        <div class="container-fluid p-4">
          <h4 class="dashboard-navtop-title">Dashboard</h4>
          <div class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle dashboard-navtop-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <img src="{{ asset(Auth::user()->image->url_sm) }}" class="rounded-circle navtop-profile-image" alt="Profile image"> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('home') }}">{{ __('View Blog') }}</a>
              <a href="{{ route('profile.index') }}" class="dropdown-item">Profile</a>
              <hr class="dropdown-divider">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </nav>
      <div class="container-fluid p-4">
        @yield('content')
      </div>
    </div>
  </div>
  @yield('scripts')
</body>
</html>
