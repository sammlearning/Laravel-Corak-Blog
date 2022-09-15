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
  <div class="container">
    <div class="row auth-row">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header"><h5>{{ config('app.name') .' | '. __('Login') }}</h5></div>
          <div class="card-body">
            <img src="{{asset('images/login.png')}}" alt="">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-floating col-md-10 mb-3 mx-auto">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="email" autofocus>
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-floating col-md-10 mb-3 mx-auto">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="current-password">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="row mb-3">
                <div class="col-md-10 mx-auto">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2 mb-3 col-md-10 mx-auto">
                <button class="btn btn-primary auth-submit-btn" type="submit">{{ __('Login') }}</button>
              </div>
              <div class="col-md-10 mb-3 mx-auto text-center">
                <a href="{{ route('home') }}">{{ __('Back to home page') }}</a>
                <span class="ms-1 me-1">|</span>
                {{-- @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                @endif --}}
                @if (Route::has('register'))
                  <a href="{{ route('register') }}">{{ __('Register a new user') }}</a>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
