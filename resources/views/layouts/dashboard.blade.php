<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>

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

  </head>
<body class="dashboard">
  <div class="row w-100 m-0">
    <div class="col-md-2 p-0">
      <nav class="navbar navbar-dark navbar-expand-lg dashboard-sidebar">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/header-logo-dark.png') }}" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Dashboard</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><span class="dashboard-list-icon"><i class="bi bi-pie-chart-fill"></i></span> Home</a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() == 'route' ? 'active' : '' }}">
                <a class="nav-link" href="#"><span class="dashboard-list-icon"><i class="bi bi-people-fill"></i></span> Link</a>
              </li>
            </ul>
            <ul class="dashboard-list">
              <h6 class="dashboard-list-title">Users</h6>
              <li class="nav-item {{ Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.edit' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><span class="dashboard-list-icon"><i class="bi bi-person-plus-fill"></i></span> Manage Users</a>
              </li>
              <li class="nav-item {{ Route::currentRouteName() == 'route' ? 'active' : '' }}">
                <a class="nav-link" href="#"><span class="dashboard-list-icon"><i class="bi bi-people-fill"></i></span> Link</a>
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
                <a class="nav-link" href="{{ route('home') }}"><span class="dashboard-list-icon"><i class="bi bi-box-arrow-up-right"></i></span> View Blog</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="col-md-10 p-4 dashboard-content">
      <main class="px-2">
        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>
