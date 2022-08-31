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
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Manage Posts</h5>
        </div>
        <div class="card-body">
          <table id="postsTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Post author</th>
                <th>Post subject</th>
                {{-- <th>Body</th> --}}
                <th>Categories</th>
                <th>Comments</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td><a class="profile-link" href="{{ route('users.edit', $post->user->id) }}"><img src="{{ asset($post->user->image->url) }}" class="rounded-circle user-profile-image" alt="Profile image"> {{ $post->user->name }}</a></td>
                  <td><a class="profile-link" href="{{ route('posts.show', $post->id) }}">{{ $post->subject }}</a></td>
                  {{-- <td>{{ $post->body }}</td> --}}
                  <td>
                    @foreach ($post->categories as $category)
                      <a href="#"><span class="badge rounded-pill category-badge">{{$category->title}}</span></a>
                    @endforeach
                  </td>
                  <td>
                    <span class="badge rounded-pill category-badge">{{ $post->comments->Count() }}</span>
                  </td>
                  <td>{{ $post->created_at }}</td>
                  <td>
                    <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a class="btn btn-sm btn-light me-2" href="{{ route('posts.edit', $post->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Post author</th>
                <th>Post subject</th>
                {{-- <th>Body</th> --}}
                <th>Categories</th>
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
  <script>
    $(document).ready(function () {
      $('#postsTable').DataTable({
        "order": [ 0, 'desc' ]
      });
    });
  </script>
@endsection
