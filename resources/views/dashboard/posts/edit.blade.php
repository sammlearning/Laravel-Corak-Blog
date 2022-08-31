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
            <form action="{{route('posts.update', $post->id)}}" method="POST">
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
                  <textarea class="form-control @error('body') is-invalid @enderror" id="postBody" name="body" rows="6" required>{{ $post->body }}</textarea>
                  @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
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
              <div class="d-none" id="uploaded-image">
                <div class="mt-4" id="profile-image"></div>
                <button type="button" class="btn btn-primary d-block mx-auto mt-2" id="crop-image">Update</button>
              </div>
            </form>
            <script>
              $image_crop = $("#profile-image").croppie({
                enableExif: true,
                viewport: {
                  width: 800,
                  height: 500,
                  type: 'sqare'
                },
                boundary: {
                  width: 1000,
                  height: 700
                }
              });

              var post_image = false, input = '';

              $("#upload_image").on("change", function(){

                var reader = new FileReader();
                reader.onload = function (event) {
                  $image_crop.croppie("bind", {url: event.target.result});
                }

                post_image = true;
                reader.readAsDataURL(this.files[0]);
                $("#uploaded-image").toggleClass('d-none');

              });

              $("#crop-image").click(function(event){

                $image_crop.croppie("result", {
                  type: "canvas",
                  size: "viewport"
                }).then(function(response){
                  if (post_image === true) {
                    input = $("<input>").attr("type", "hidden").attr("name", "image").val(response);
                  }
                  $('#upload_image_form').append(input).submit();
                });

              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var multipleCancelButton = new Choices('#postCategory', {
      removeItemButton: true,
      // maxItemCount:5,
      // searchResultLimit:5,
      // renderChoiceLimit:5
    });
  </script>
@endsection
