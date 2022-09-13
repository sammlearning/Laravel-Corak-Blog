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
    </div>
    <div class="col-md-12 dashboard-col">
      <div class="dashboard-card">
        <div class="card-header">
          <h5 class="card-header-title">Edit link <span class="badge bg-secondary">{{ $link->title }}</span></h5>
        </div>
        <div class="card-body">
          <form action="{{ route('link.update', $link->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="title" class="form-label">Link title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $errors->any() ? old('title') : $link->title }}" required>
                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="parent" class="form-label">Parent dropdown</label>
                <select class="form-control @error('parent') is-invalid @enderror" @if($link->type == 'dropdown') disabled @endif name="parent" id="parent" required>
                  <option value="0" selected>None</option>
                  @if ($link->type != 'dropdown')
                    @foreach ($links as $parent)
                      @if ($parent->type == 'dropdown')
                        <option value="{{ $parent->id }}" {{ $link->parent == $parent ? 'selected' : '' }}>{{ $parent->title }}</option>
                      @endif
                    @endforeach
                  @endif
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
                  <option value="navtop" @if($link->position == 'navtop') selected @endif>Top Navbar</option>
                  <option value="navbar" @if($link->position == 'navbar') selected @endif>Center Navbar</option>
                  @if ($link->type != 'dropdown')
                    <option value="footer" @if($link->position == 'footer') selected @endif>Footer</option>
                  @endif
                </select>
                @error('position')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="type" class="form-label">Type</label>
                <select class="form-control @error('type') is-invalid @enderror" @if($link->type == 'dropdown') disabled @endif name="type" id="type" required>
                  <option value="url" @if($link->type == 'url') selected @endif>URL</option>
                  <option value="category" @if($link->type == 'category') selected @endif>Category</option>
                  <option value="dropdown" @if($link->type == 'dropdown') selected @endif>Dropdown</option>
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
              <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $errors->any() ? old('url') : '' }} @if($link->type == 'url') {{ $link->url }} @endif" placeholder="URL">
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
                  <option value="{{ $category->id }}" @if($link->type == 'category' && $link->category == $category) selected @endif>{{ $category->title }}</option>
                @endforeach
              </select>
              @error('category')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            @if ($link->position == 'footer')
              <a href="{{ route('config.footer') }}" class="btn btn-secondary ms-2">Cancel</a>
            @else
              <a href="{{ route('config.navbar') }}" class="btn btn-secondary ms-2">Cancel</a>
            @endif
          </form>
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
      } else if (linkType.val() == 'category') {
        $('#linkURL').addClass('d-none');
        $('#linkCategory').removeClass('d-none');
      }

      if (linkParent.val() != '0') {
        $('#type > option:nth-child(3)').remove();
        $('#position').append($('<option>').attr('id', 'pp').text('Parent position').prop('selected', true));
        $('#position').prop('disabled', true);
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
