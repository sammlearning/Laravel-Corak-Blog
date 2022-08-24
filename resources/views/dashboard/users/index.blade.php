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
          <h4>Manage Users</h4>
        </div>
        <div class="card-body">
          <table id="categoriesTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Posts</th>
                <th>Level</th>
                <th>Member Since</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->posts_count }}</td>
                  <td>
                  @if ($user->is_admin)
                    <span class="badge rounded-pill bg-success">Admin</span></td>
                  @else
                    <span class="badge rounded-pill bg-light text-dark">User</span></td>
                  @endif
                  <td>{{ $user->created_at }}</td>
                  <td>
                    <form action="{{route('categories.destroy', $user->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a class="btn btn-sm btn-light me-2" href="{{ route('categories.edit', $user->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Posts</th>
                <th>Level</th>
                <th>Member Since</th>
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
        $('#categoriesTable').DataTable();
    });
  </script>
@endsection
