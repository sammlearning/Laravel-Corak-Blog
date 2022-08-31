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
            <form action="{{route('posts.store')}}" method="POST" id="publish-post-form">
              @csrf
              <div class="mb-3">
                <label for="postSubject" class="form-label">Post subject</label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" id="postSubject" name="subject" value="{{ old('subject') }}" required>
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
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="postBody" class="form-label">Body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="postBody" name="body" rows="6" required>{{ old('body') }}</textarea>
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
                <div class="d-none" id="uploaded-image">
                  <div class="mt-4" id="profile-image"></div>
                </div>
              </div>
              <button type="button" class="btn btn-primary" id="publish-post">Publish</button>
              <a href="{{ route('posts.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
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

    $("#publish-post").click(function(event){

      $image_crop.croppie("result", {
        type: "canvas",
        size: "viewport"
      }).then(function(response){
        if (post_image === true) {
          input = $("<input>").attr("type", "hidden").attr("name", "image").val(response);
        }
        $('#publish-post-form').append(input).submit();
      });

    });

  </script>
@endsection
