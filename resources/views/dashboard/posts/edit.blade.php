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
        <div class="dashboard-card profile-page h-auto">
          <div class="card-header">
            <h5 class="profile-page-title">Post info</h5>
          </div>
          <div class="card-body profile-card-body">
            <img class="rounded-sqare post-image" src="{{ asset($post->image->url) }}" alt="">
            <ul>
              <li><h5 class="user-name">{{ $post->subject }}</h5></li>
              <li>Post author <a class="profile-link ms-1" href="{{ route('users.edit', $post->user->id) }}"><img src="{{ asset($post->user->image->url) }}" class="rounded-circle user-profile-image me-0" alt="Profile image"> {{ $post->user->name }}</a></li>
              <li>Categories
                @foreach ($post->categories as $category)
                  <a href="#"><span class="badge bg-primary">{{$category->title}}</span></a>
                @endforeach
              </li>
              <li>Comments <div class="badge bg-primary">{{ $post->comments->Count() }}</div></li>
              <li>Created at {{ $post->created_at }}</li>
            </ul>
          </div>
        </div>
        <div class="dashboard-card mt-4">
          <div class="card-header">
            <h5 class="card-header-title">Edit post</h5>
          </div>
          <div class="card-body">
            <form action="{{route('posts.update', $post->id)}}" method="POST" id="update-post-form">
              @method('PUT')
              @csrf
              <div class="mb-3">
                <label for="postSubject" class="form-label">Post subject</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="postSubject" name="subject" value="{{ $post->subject }}" required>
                @error('subject')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                @error('category')
                  <label for="postCategory" class="form-label text-danger">{{ $message }}</label>
                @else
                  <label for="postCategory" class="form-label">Category</label>
                @enderror
                <select id="postCategory" placeholder="Search for categories" multiple name="category[]">
                  @foreach ($all_categories as $category)
                    <option value="{{$category->id}}" @foreach ($categories as $ctg) {{ $category->id == $ctg->id ? 'selected' : '' }} @endforeach >{{$category->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <div class="mb-3">
                  <label for="postBody" class="form-label">Body</label>
                  <div class="form-control @error('body') is-invalid @enderror" id="postBody">{!! $post->body !!}</div>
                  @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <button type="button" class="btn btn-primary" onclick="publish_post('update', 'update-post-form')">Update</button>
              <a href="{{ route('posts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
          </div>
        </div>
        <div class="dashboard-card profile-page h-auto mt-4">
          <div class="card-header">
            <h5 class="profile-page-title">Change post image</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('post.image') }}" method="POST" id="upload_image_form">
              @csrf
              <input type="hidden" name="post" value="{{ $post->id }}">
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
                <div class="uploaded-image-actions d-block mx-auto mt-2">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleX"><i class="bi bi-arrow-left-right"></i></button>
                    <button type="button" class="btn btn-primary cropper-action" data-cropper="scaleY"><i class="bi bi-arrow-down-up"></i></button>
                  </div>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateRight"><i class="bi bi-arrow-clockwise"></i></button>
                    <button type="button" class="btn btn-primary cropper-action" data-cropper="rotateLeft"><i class="bi bi-arrow-counterclockwise"></i></button>
                  </div>
                  <button type="button" class="btn btn-primary" onclick="publish_post('image', 'upload_image_form')"><i class="bi bi-upload"></i> Upload image</button>
                </div>
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
