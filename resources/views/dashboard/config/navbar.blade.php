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
          <h5 class="card-header-title">Navbar options</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('config.navbar.update') }}" method="POST">
            @csrf
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="navbar_search" name="navbar_search" {{ config('app.search') == TRUE ? 'checked' : '' }}>
              <label class="form-check-label" for="navbar_search">Allow searching</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="navbar_scroll" name="navbar_scroll" {{ config('app.navbar.fixed') == TRUE ? 'checked' : '' }}>
              <label class="form-check-label" for="navbar_scroll">Fixed navigation bar with scroll</label>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
          </form>
        </div>
      </div>
    </div>
    @if (session('error'))
      <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif
    @if ($navbar_parents >= 8)
      <div class="col-12">
        <div class="alert alert-warning alert-dismissible fade show mt-3 shadow-sm" role="alert">
          For design reasons, the maximum number of parents that can be added to the navbar is 8 parents.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif
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
                <label for="parent" class="form-label">Parent dropdown</label>
                <select class="form-control @error('parent') is-invalid @enderror" name="parent" id="parent" required>
                  <option value="0" selected>None</option>
                  @foreach ($links as $link)
                    @if ($link->type == 'dropdown')
                      <option value="{{ $link->id }}">{{ $link->title }}</option>
                    @endif
                  @endforeach
                </select>
                @error('parent')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="position" class="form-label">Position</label>
                <select class="form-control @error('position') is-invalid @enderror" name="position" id="position" required>
                  <option value="navtop">Top Navbar</option>
                  <option value="navbar" selected>Center Navbar</option>
                  <option value="footer">Footer</option>
                </select>
                @error('position')
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
                  <option value="dropdown">Dropdown</option>
                </select>
                @error('type')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="mb-3 @error('url') @else d-none @enderror" id="linkURL">
              <label for="url" class="form-label">URL</label>
              <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $errors->any() ? old('url') : '' }}" placeholder="URL">
              @error('url')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3 @error('category') @else d-none @enderror" id="linkCategory">
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
            <button type="submit" class="btn btn-primary">Create</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Navbar links</h5>
        </div>
        <div class="card-body">
          <table id="centerLinksTable" class="table table-striped" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Link</th>
                <th>Parent</th>
                <th>Type</th>
                <th>URL</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($links as $link)
                <tr>
                  <td>{{ $link->id }}</td>
                  <td>{{ $link->title }}</td>
                  <td>
                    @if ($link->link_id != NULL)
                      <span>{{ $link->parent->title }}</span>
                    @else
                      <span class="text-muted">None</span>
                    @endif
                  </td>
                  <td>@if ($link->type == 'url') URL @elseif ($link->type == 'category') Category @else Dropdown @endif</td>
                  {{-- <td><span class="badge rounded-pill category-badge">aaa</span></td> --}}
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
                <th>Parent</th>
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
      $('#centerLinksTable').DataTable();

      let linkType = $('#type'), linkParent = $('#parent'), linkPosition = $('#position');

      if (linkType.val() == 'url') {
        $('#linkCategory').addClass('d-none');
        $('#linkURL').removeClass('d-none');
      }

      $(linkParent).change(function () {
        if (linkParent.val() != '0') {
          $('#type > option:nth-child(3)').remove();
          // $('#position > option:nth-child(3)').remove();
          $('#position').append($('<option>').attr('id', 'pp').text('Parent position').prop('selected', true));
          $('#position').prop('disabled', true);
        } else {
          if (! $('#type > option:nth-child(3)').length) {
            $('#type').append($('<option>').val('dropdown').text('Dropdown'));
          }
          if (! $('#position > option:nth-child(3)').length) {
            $('#position').append($('<option>').val('footer').text('Footer'));
          }
          $('#pp').remove();
          $('#position').prop('disabled', false);
        }
      });

      $(linkPosition).change(function () {
        if (linkPosition.val() == 'footer') {
          $('#type > option:nth-child(3)').remove();
        } else {
          if (! $('#type > option:nth-child(3)').length) {
            $('#type').append($('<option>').val('dropdown').text('Dropdown'));
          }
        }
      });

      $(linkType).change(function () {
        if (! $('#position > option:nth-child(3)').length) {
          $('#position').append($('<option>').val('footer').text('Footer'));
        }
        if (linkType.val() == 'url') {
          $('#linkCategory').addClass('d-none');
          $('#linkURL').removeClass('d-none');
        } else if ((linkType.val() == 'category')) {
          $('#linkURL').addClass('d-none');
          $('#linkCategory').removeClass('d-none');
        } else {
          $('#linkCategory').addClass('d-none');
          $('#linkURL').addClass('d-none');
          $('#position > option:nth-child(3)').remove();
        }
      });

    });
  </script>
@endsection
