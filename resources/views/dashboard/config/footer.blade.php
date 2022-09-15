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
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Footer lists</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.footer.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-2">
              <div class="col-md-6">
                <label for="list01">List title</label>
                <input type="text" class="form-control" id='list01' name="list01" placeholder="List title" value="{{ config('app.footer.title01') }}" required>
              </div>
              <div class="col-md-6">
                <label for="list02">List title</label>
                <input type="text" class="form-control" id='list02' name="list02" placeholder="List title" value="{{ config('app.footer.title02') }}" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Create a new link</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('link.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="title" class="form-label">Link title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $errors->any() ? old('title') : '' }}" required>
                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="type" class="form-label">Type</label>
                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required>
                  <option value="url" @error('url') selected @enderror>URL</option>
                  <option value="category" @error('category') selected @enderror>Category</option>
                </select>
                @error('type')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="parent" class="form-label">Parent list</label>
                <select class="form-control @error('parent') is-invalid @enderror" name="parent" id="parent" required>
                  <option value="1" selected>{{ config('app.footer.title01') }}</option>
                  <option value="2">{{ config('app.footer.title02') }}</option>
                </select>
                @error('parent')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6 @error('url') @else d-none @enderror" id="linkURL">
                <label for="url" class="form-label">URL</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $errors->any() ? old('url') : '' }}" placeholder="URL">
                @error('url')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6 @error('category') @else d-none @enderror" id="linkCategory">
                <label for="category" class="form-label">Category</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                  @endforeach
                </select>
                @error('category')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Footer links <span class="badge bg-secondary">Highlights</span></h5>
        </div>
        <div class="card-body">
          <table id="footer01LinksTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Link</th>
                <th>Type</th>
                <th>URL</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($links01 as $link)
                <tr>
                  <td>{{ $link->id }}</td>
                  <td>{{ $link->title }}</td>
                  <td>@if ($link->type == 'url') URL @elseif ($link->type == 'category') Category @else Dropdown @endif</td>
                  <td>
                    @if ($link->type != 'dropdown')
                      <a class="profile-link d-flex" @if ($link->type == 'url') href="{{ $link->url }}" @elseif ($link->type == 'category') href="{{ route('categories.show', $link->category) }}" @endif target="_blank"> <p class="link-url"> @if ($link->type == 'url') {{ $link->url }} @elseif ($link->type == 'category') {{ $link->category->title }} Category @endif </p> <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                    @else
                      <span class="text-muted">None</span>
                    @endif
                  <td>
                    <form action="{{ route('link.destroy', $link->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a class="btn btn-sm btn-light me-2" href="{{ route('link.edit', $link->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Link</th>
                <th>Type</th>
                <th>URL</th>
                <th>Actions</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Footer links <span class="badge bg-secondary">Useful</span></h5>
        </div>
        <div class="card-body">
          <table id="footer02LinksTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Link</th>
                <th>Type</th>
                <th>URL</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($links02 as $link)
                <tr>
                  <td>{{ $link->id }}</td>
                  <td>{{ $link->title }}</td>
                  <td>@if ($link->type == 'url') URL @elseif ($link->type == 'category') Category @else Dropdown @endif</td>
                  <td>
                    @if ($link->type != 'dropdown')
                      <a class="profile-link d-flex" @if ($link->type == 'url') href="{{ $link->url }}" @elseif ($link->type == 'category') href="{{ route('categories.show', $link->category) }}" @endif target="_blank"> <p class="link-url"> @if ($link->type == 'url') {{ $link->url }} @elseif ($link->type == 'category') {{ $link->category->title }} Category @endif </p> <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                    @else
                      <span class="text-muted">None</span>
                    @endif
                  <td>
                    <form action="{{ route('link.destroy', $link->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a class="btn btn-sm btn-light me-2" href="{{ route('link.edit', $link->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
                      <button class="btn btn-sm btn-light" type="submit"><i class="bi bi-trash3 me-1"></i> Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Link</th>
                <th>Type</th>
                <th>URL</th>
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
      $('#footer01LinksTable').DataTable();
      $('#footer02LinksTable').DataTable();

      let linkType = $('#type'), linkParent = $('#parent'), linkPosition = $('#position');

      if (linkType.val() == 'url') {
        $('#linkCategory').addClass('d-none');
        $('#linkURL').removeClass('d-none');
      }

      $(linkType).change(function () {
        if (linkType.val() == 'url') {
          $('#linkCategory').addClass('d-none');
          $('#linkURL').removeClass('d-none');
        } else if ((linkType.val() == 'category')) {
          $('#linkURL').addClass('d-none');
          $('#linkCategory').removeClass('d-none');
        } else {
          $('#linkCategory').addClass('d-none');
          $('#linkURL').addClass('d-none');
        }
      });
    });
  </script>
@endsection
