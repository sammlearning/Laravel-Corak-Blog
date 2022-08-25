@extends('layouts.dashboard')

@section('content')
    <div class="row">
      <div class="col-md-12 dashboard-col">
        <div class="dashboard-card">
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card-header">
            <h5 class="card-header-title">Edit user : {{ $user->name }}</h5>
          </div>
          <div class="card-body">
            <form action="{{route('users.update', $user->id)}}" method="POST">
              @method('PUT')
              @csrf
              <div class="mb-3">
                <label for="userName" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="userName" name="name" value="{{ $errors->any() ? old('name') : $user->name }}" required>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="userEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="userEmail" name="email" value="{{ $errors->any() ? old('email') : $user->email }}" required>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="userPassword" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="userPassword" name="password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @else
                  <div id="passwordHelp" class="form-text">Leave it blank if you do not want to change user password</div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" aria-label="Select user role" id="role" name="role" @disabled($user->id == Auth::user()->id)>
                  @if ($user->id != Auth::user()->id)
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                  @else
                    <option>Admin</option>
                  @endif
                </select>
                @error('role')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
