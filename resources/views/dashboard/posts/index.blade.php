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
      <div class="dashboard-card mb-3">
        <div class="card-header">
          <h5 class="card-header-title">Featured Post</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('post.featured') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="form-check form-switch @error('featured_status') is-invalid @enderror">
                  <input class="form-check-input" type="checkbox" role="switch" id="featured_status" name="featured_status" {{ $featured_post->status == 1 ? 'checked' : '' }}>
                  <label class="form-check-label" for="featured_status">Enable featured post</label>
                  @error('featured_status')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-12 mt-3">
                <select id="featured" placeholder="Search for post" name="featured_post">
                  @foreach ($posts as $post)
                    <option value="{{$post->id}}" {{ $featured_post->post_id == $post->id ? 'selected' : '' }}>{{$post->subject}}</option>
                  @endforeach
                </select>
                @error('featured_post')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
          </form>
        </div>
      </div>
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Manage Posts</h5>
        </div>
        <div class="card-body" style="overflow: auto">
          <table id="postsTable" class="table table-striped table-responsive">
            <thead>
              <tr>
                <th>#</th>
                <th>Post</th>
                {{-- <th>Body</th> --}}
                {{-- <th>Categories</th> --}}
                <th>Comments</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <td>
                    <div class="table-center-items ms-1">
                      {{ $post->id }}
                    </div>
                  </td>
                  <td>
                    <div class="post-info">
                      <a href="{{ route('posts.show', $post->id) }}" target="_blank">
                        <img src="{{ asset($post->image->url_sm) }}" class="post-thumbnail">
                      </a>
                      <div class="post-links">
                        <h7 class="mb-2">
                          <b>
                            <a class="profile-link" href="{{ route('posts.show', $post->id) }}" target="_blank">
                              {{ $post->subject }} <i class="bi bi-box-arrow-up-right ms-1"></i>
                              @if ( $featured_post->post_id == $post->id )
                                <span class="badge text-bg-light">Featured</span>
                              @endif
                            </a>
                          </b>
                        </h7>
                        <div class="post-author mb-2">
                          <span class="ms-1 me-1">Published by</span>
                          <a class="profile-link" href="{{ route('users.edit', $post->user->id) }}"><img src="{{ asset($post->user->image->url_sm) }}" class="rounded-circle user-profile-image me-1" width="20" alt="Profile image"> {{ $post->user->name }}</a>
                        </div>
                        <div class="post-categories">
                          @foreach ($post->categories as $category)
                            <a href="{{ route('categories.edit', $category->id) }}" class=""><span class="badge text-bg-light">{{$category->title}}</span></a>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </td>
                  {{-- <td>{{ $post->body }}</td> --}}
                  {{-- <td>
                    <div class="table-center-items">
                    @foreach ($post->categories as $category)
                      <a href="#" class="ms-1"><span class="badge rounded-pill category-badge">{{$category->title}}</span></a>
                    @endforeach
                  </div>
                  </td> --}}
                  <td>
                    <div class="table-center-items">
                      <span class="">{{ $post->comments->Count() }}</span>
                    </div>
                  </td>
                  <td>
                    <div class="table-center-items">
                      {{ $post->created_at }}
                    </div>
                  </td>
                  <td>
                    <div class="table-center-items">
                      <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-sm btn-light me-2" href="{{ route('posts.edit', $post->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                        <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Post</th>
                {{-- <th>Body</th> --}}
                {{-- <th>Categories</th> --}}
                <th>Comments</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
      $('#postsTable').DataTable({
        "order": [ 0, 'desc' ]
      });
    });
    var multipleCancelButton = new Choices('#featured', {
      removeItemButton: true,
      maxItemCount:1,
      // searchResultLimit:5,
      // renderChoiceLimit:5
    });
  </script>
@endsection
