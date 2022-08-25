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
            <h5 class="card-header-title">Edit category</h5>
          </div>
          <div class="card-body">
            <form action="{{route('categories.update', $category->id)}}" method="POST">
              @method('PUT')
              @csrf
              <div class="mb-3">
                <label for="categoryTitle" class="form-label">Category title</label>
                <input type="text" class="form-control @error('category_title') is-invalid @enderror" id="categoryTitle" name="category_title" value="{{ $category->title }}" required>
                @error('category_title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="mb-3">
                <div class="mb-3">
                  <label for="categoryDescription" class="form-label">Description</label>
                  <textarea class="form-control @error('category_description') is-invalid @enderror" id="categoryDescription" name="category_description" rows="6" required>{{ $category->description }}</textarea>
                  @error('category_description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
