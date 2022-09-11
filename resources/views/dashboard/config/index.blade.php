@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col-md-12 mb-0">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @error('image')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @enderror
      <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
        After uploading a new blog icon or logo, it may take some time to appear due to caching.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <div class="col-md-4 dashboard-col">
      <div class="dashboard-card profile-page h-auto">
        <div class="card-header">
          <h5 class="profile-page-title">Change blog icon</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.logo') }}" method="POST" id="iconForm">
            @csrf
            <div class="inf__drop-area w-100">
              <span class="inf__btn">Choose files</span>
              <span class="inf__hint">or drag and drop files here</span>
              <input type="file" name="iconInput" id="iconInput" data-logo="icon" required>
            </div>
            <div class="center-loader text-primary d-none" id="iconLoader">
              <h4 class="center-loader-message">Loading your icon</h4>
              <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div class="d-none" id="iconUploaded">
              <div class="mt-4">
                <img src="" id="iconImage" style="max-width: 100%">
              </div>
              <div class="uploaded-image-actions d-block mx-auto mt-2">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleX"><i class="bi bi-arrow-left-right"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleY"><i class="bi bi-arrow-down-up"></i></button>
                </div>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateRight"><i class="bi bi-arrow-clockwise"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateLeft"><i class="bi bi-arrow-counterclockwise"></i></button>
                </div>
                <button type="button" class="btn btn-primary" onclick="changeLogo('icon', 'icon')"><i class="bi bi-upload"></i> Upload icon</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 dashboard-col">
      <div class="dashboard-card profile-page h-auto">
        <div class="card-header">
          <h5 class="profile-page-title">Change logo <span class="badge bg-secondary">Light</span></h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.logo') }}" method="POST" id="logoLightForm">
            @csrf
            <div class="inf__drop-area w-100">
              <span class="inf__btn">Choose files</span>
              <span class="inf__hint">or drag and drop files here</span>
              <input type="file" name="logoLightInput" id="logoLightInput" data-logo="logoLight" required>
            </div>
            <div class="center-loader text-primary d-none" id="logoLightLoader">
              <h4 class="center-loader-message">Loading your logo</h4>
              <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div class="d-none" id="logoLightUploaded">
              <div class="mt-4">
                <img src="" id="logoLightImage" style="max-width: 100%">
              </div>
              <div class="uploaded-image-actions d-block mx-auto mt-2">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleX"><i class="bi bi-arrow-left-right"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleY"><i class="bi bi-arrow-down-up"></i></button>
                </div>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateRight"><i class="bi bi-arrow-clockwise"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateLeft"><i class="bi bi-arrow-counterclockwise"></i></button>
                </div>
                <button type="button" class="btn btn-primary" onclick="changeLogo('logoLight', 'logo_light')"><i class="bi bi-upload"></i> Upload Logo</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 dashboard-col">
      <div class="dashboard-card profile-page h-auto">
        <div class="card-header">
          <h5 class="profile-page-title">Change logo <span class="badge bg-secondary">Dark</span></h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.logo') }}" method="POST" id="logoDarkForm">
            @csrf
            <div class="inf__drop-area w-100">
              <span class="inf__btn">Choose files</span>
              <span class="inf__hint">or drag and drop files here</span>
              <input type="file" name="logoDarkInput" id="logoDarkInput" data-logo="logoDark" required>
            </div>
            <div class="center-loader text-primary d-none" id="loader">
              <h4 class="center-loader-message">Loading your logo</h4>
              <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div class="d-none" id="logoDarkUploaded">
              <div class="mt-4">
                <img src="" id="logoDarkImage" style="max-width: 100%">
              </div>
              <div class="uploaded-image-actions d-block mx-auto mt-2">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleX"><i class="bi bi-arrow-left-right"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleY"><i class="bi bi-arrow-down-up"></i></button>
                </div>
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateRight"><i class="bi bi-arrow-clockwise"></i></button>
                  <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateLeft"><i class="bi bi-arrow-counterclockwise"></i></button>
                </div>
                <button type="button" class="btn btn-primary" onclick="changeLogo('logoDark', 'logo_dark')"><i class="bi bi-upload"></i> Upload Logo</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Blog Configuration</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.update') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Blog title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $errors->any() ? old('title') : $config->blog_title }}" required>
              @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Blog description</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ $errors->any() ? old('description') : $config->blog_description }}</textarea>
              @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="facebook" class="form-label"><i class="bi bi-facebook"></i> Facebook</label>
              <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ $errors->any() ? old('facebook') : config('app.facebook') }}" placeholder="Facebook url">
              @error('facebook')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @else
                <div id="facebookHelp" class="form-text">Leave it blank if you do not want the Facebook link to appear in navbar and footer.</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="instagram" class="form-label"><i class="bi bi-instagram"></i> Instagram</label>
              <input type="url" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ $errors->any() ? old('instagram') : config('app.instagram') }}" placeholder="Instagram url">
              @error('instagram')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @else
                <div id="instagramHelp" class="form-text">Leave it blank if you do not want the Instagram link to appear in navbar and footer.</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="youtube" class="form-label"><i class="bi bi-youtube"></i> Youtube</label>
              <input type="url" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{ $errors->any() ? old('youtube') : config('app.youtube') }}" placeholder="Youtube url">
              @error('youtube')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @else
                <div id="youtubeHelp" class="form-text">Leave it blank if you do not want the Youtube link to appear in navbar and footer.</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="twitter" class="form-label"><i class="bi bi-twitter"></i> Twitter</label>
              <input type="url" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{ $errors->any() ? old('twitter') : config('app.twitter') }}" placeholder="Twitter url">
              @error('twitter')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @else
                <div id="twitterHelp" class="form-text">Leave it blank if you do not want the Twitter link to appear in navbar and footer.</div>
              @enderror
            </div>
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="comments" name="comments" {{ $config->allow_comments == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="comments"><i class="bi bi-chat-dots-fill text-muted"></i> Allow comments</label>
              </div>
            </div>
            {{-- <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="auth" name="auth" {{ $config->allow_register == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="auth"><i class="bi bi-people-fill text-muted"></i> Allow registration</label>
              </div>
            </div> --}}
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/logo.js') }}"></script>
@endsection

