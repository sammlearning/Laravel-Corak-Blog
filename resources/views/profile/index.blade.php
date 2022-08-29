@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-4 mb-4">
    <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
      <nav class="nav nav-pills flex-column">
        <a class="nav-link" href="#myprofile">My Profile</a>
        <a class="nav-link" href="#edit-profile">Edit Profile</a>
        <a class="nav-link" href="#profile-picture">Upload Profile Picture</a>
      </nav>
    </nav>
  </div>

  <div class="col-md-8">
    <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
      <div id="myprofile">
        <div class="card profile-page">
          <div class="card-header">
            <h5 class="profile-page-title">My Profile</h5>
          </div>
          <div class="card-body profile-card-body">
            <img class="rounded-circle profile-img" src="{{ asset('images/profile.jpg') }}" alt="">
            <ul>
              <li><h5 class="user-name">{{ Auth::user()->name }}</h5></li>
              <li>Role <div class="badge bg-primary">{{ Auth::user()->is_admin == 1 ? 'Admin' : 'User' }}</div></li>
              <li>Published Posts <div class="badge bg-primary">{{ Auth::user()->posts->Count() }}</div></li>
              <li>Published Comments <div class="badge bg-primary">{{ Auth::user()->posts->Count() }}</div></li>
              <li>Member Since {{ Auth::user()->created_at }}</li>
            </ul>
          </div>
        </div>
      </div>
      <div id="edit-profile">
        <div class="card profile-page mt-4">
          <div class="card-header">
            <h5 class="profile-page-title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
              @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $errors->any() ? old('name') : Auth::user()->name }}" required>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $errors->any() ? old('email') : Auth::user()->email }}" required>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="passwordHelp">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @else
                      <div id="passwordHelp" class="form-text">Leave it blank if you do not want to change your password</div>
                    @enderror
                  </div>
                  <div class="col">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password-confirm" name="password_confirmation">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
      <div id="profile-picture">
        <div class="card profile-page mt-4">
          <div class="card-header">
            <h5 class="profile-page-title">Upload Profile Picture</h5>
          </div>
          <div class="card-body profile-card-body">
            <img class="rounded-circle profile-img" src="{{ asset('images/profile.jpg') }}" alt="">
            <ul>
              <li><h5 class="user-name">{{ Auth::user()->name }}</h5></li>
              <li>Role <div class="badge bg-primary">{{ Auth::user()->is_admin == 1 ? 'Admin' : 'User' }}</div></li>
              <li>Published Posts <div class="badge bg-primary">{{ Auth::user()->posts->Count() }}</div></li>
              <li>Published Comments <div class="badge bg-primary">{{ Auth::user()->posts->Count() }}</div></li>
              <li>Member Since {{ Auth::user()->created_at }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
