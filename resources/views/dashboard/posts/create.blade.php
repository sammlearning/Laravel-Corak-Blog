@extends('layouts.dashboard')

@section('content')
    <div class="row">
      <div class="col-md-12 dashboard-col">
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session('No categories'))
          <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
            {{ session('No categories') }}
          </div>
        @endif
        @if (session('No posts'))
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('No posts') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @error('image')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @enderror
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Create a new post</h5>
          </div>
          <div class="card-body">
            <form action="{{route('posts.store')}}" method="POST" id="publish_post">
              @csrf
              <div class="mb-3 publish_post_form_group">
                <label for="postSubject" class="form-label">Post subject</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="postSubject" name="subject" value="{{ old('subject') }}" required>
                @error('subject')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3 publish_post_form_group">
                @error('category')
                  <label for="postCategory" class="form-label text-danger">{{ $message }}</label>
                @else
                  <label for="postCategory" class="form-label">Category</label>
                @enderror
                <select id="postCategory" placeholder="Search for categories" multiple name="category[]">
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3 publish_post_form_group">
                <label for="postBody" class="form-label">Body</label>
                <div class="form-control @error('body') is-invalid @enderror" id="postBody">{!! old('body') !!}</div>
                @error('body')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="inf__drop-area w-100">
                  <span class="inf__btn">Choose files</span>
                  <span class="inf__hint">or drag and drop files here</span>
                  <input type="file" name="upload_image" id="upload_image" required>
                </div>
                <div class="center-loader text-primary d-none" id="loader">
                  <h4 class="center-loader-message">Loading your image</h4>
                  <div class="spinner-grow" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
                <div class="d-none" id="uploaded-image">
                  <div class="mt-4">
                    <img src="" id="post-thumbnail" style="max-width: 100%">
                  </div>
                  <div class="uploaded-image-actions d-block mx-auto mt-2" style="width: fit-content">
                    <div class="btn-group" role="group" aria-label="Image Options">
                      <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleX"><i class="bi bi-arrow-left-right"></i></button>
                      <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleY"><i class="bi bi-arrow-down-up"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Image Options">
                      <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateRight"><i class="bi bi-arrow-clockwise"></i></button>
                      <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateLeft"><i class="bi bi-arrow-counterclockwise"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="publish_post_form_group">
                <button type="button" class="btn btn-primary" onclick="publish_post('store', 'publish_post')">Publish</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('assets/post.js') }}"></script>
  <script src="{{ asset('assets/post-body.js') }}"></script>
  <script src="{{ asset('assets/post-thumbnail.js') }}"></script>
@endsection
