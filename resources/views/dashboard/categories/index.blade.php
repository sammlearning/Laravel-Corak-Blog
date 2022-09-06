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
          <h5 class="card-header-title">Manage Categories</h5>
        </div>
        <div class="card-body">
          <table id="categoriesTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Description</th>
                <th>Posts</th>
                <th>Created at</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td><a class="profile-link" href="{{ route('categories.show', $category->id) }}" target="blank"> {{ $category->title }} <i class="bi bi-box-arrow-up-right ms-1"></i></a></td>
                  <td>{{ $category->description }}</td>
                  <td><span class="badge rounded-pill category-badge">{{ $category->posts_count }}</span></td>
                  <td>{{ $category->created_at }}</td>
                  <td>
                    <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a class="btn btn-sm btn-light me-2" href="{{ route('categories.edit', $category->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Description</th>
                <th>Posts</th>
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
      $('#categoriesTable').DataTable({
        "order": [ 0, 'desc' ]
      });
    });
  </script>
@endsection
