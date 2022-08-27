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
          @if (session('No posts'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              {{ session('No posts') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card-header">
            <h5 class="card-header-title">Create a new post</h5>
          </div>
          <div class="card-body">
            <form action="{{route('posts.store')}}" method="POST">
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
                <div class="mb-3">
                  <label for="postBody" class="form-label">Body</label>
                  <textarea class="form-control @error('body') is-invalid @enderror" id="postBody" name="body" rows="6" required>{{ old('body') }}</textarea>
                  @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Publish</button>
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
  </script>
@endsection
