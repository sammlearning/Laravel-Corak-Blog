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
          @if (session('No categories'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              {{ session('No categories') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card-header">
            <h4>Create a new category</h4>
          </div>
          <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="categoryTitle" class="form-label">Category title</label>
                <input type="text" class="form-control @error('category_title') is-invalid @enderror" id="categoryTitle" name="category_title" value="{{ old('category_title') }}" required>
                @error('category_title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="mb-3">
                  <label for="categoryDescription" class="form-label">Description</label>
                  <textarea class="form-control @error('category_description') is-invalid @enderror" id="categoryDescription" name="category_description" rows="6" required>{{ old('category_description') }}</textarea>
                  @error('category_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Publish</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
