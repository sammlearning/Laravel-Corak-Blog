@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <div class="featured-post" style="background-image: url('{{asset('images/post7.jpg')}}')">
        <div class="post-info">
          <h4 class="post-title">How to play Euro Truck Simulator 2 on low PC</h4>
          <span>Published at 12/8/2022 By <b>Ahmed Nabil</b></span>
          <div class="post-categories">
            <a href="#"><span class="badge rounded-pill post-category">Gaming</span></a>
            <a href="#"><span class="badge rounded-pill post-category">Technology</span></a>
            <a href="#"><span class="badge rounded-pill post-category">Internet</span></a>
          </div>
        </div>
      </div>
      <div class="row g-0 bg-light position-relative">
        <div class="col-md-6 mb-md-0 p-md-4">
          <img src="{{ asset('images/post5.jpg') }}" class="w-100" alt="...">
        </div>
        <div class="col-md-6 p-4 ps-md-0">
          <h5 class="mt-0">Columns with stretched link</h5>
          <p>Another instance of placeholder content for this other custom component. It is intended to mimic what some real-world content would look like, and we're using it here to give the component a bit of body and size.</p>
          <a href="#" class="stretched-link">Go somewhere</a>
        </div>
      </div>
      <div class="row g-0 bg-light position-relative">
        <div class="col-md-6 mb-md-0 p-md-4">
          <img src="{{ asset('images/post4.jpg') }}" class="w-100" alt="...">
        </div>
        <div class="col-md-6 p-4 ps-md-0">
          <h5 class="mt-0">Columns with stretched link</h5>
          <p>Another instance of placeholder content for this other custom component. It is intended to mimic what some real-world content would look like, and we're using it here to give the component a bit of body and size.</p>
          <a href="#" class="stretched-link">Go somewhere</a>
        </div>
      </div>
      @foreach ($posts as $post)
        <div class="post">
          <img class="post-img" src="{{asset('images/post1.jpg')}}" alt="">
          <div class="post-info">
            <h5 class="post-title">{{ $post->subject }}</h5>
            <span>Published at {{ $post->created_at }} By <b>{{ $post->user->name }}</b></span>
            <p class="post-short-description">{{ $post->body }}</p>
            <span class="post-categories">
              @foreach ($post->categories as $category)
                {{ $category->title }} ,
              @endforeach
            </span>
            <a class="btn post-read-more" href="{{route('posts.show', $post->id)}}">Read more <i class="bi bi-chevron-right"></i></a>
          </div>
        </div>
      @endforeach
      <nav aria-label="...">
        <ul class="pagination">
          <li class="page-item disabled">
            <span class="page-link">Previous</span>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
          <li class="page-item active" aria-current="page">
            <span class="page-link">4</span>
          </li>
          <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
          <li class="page-item"><a class="page-link" href="#">6</a></li>
          <li class="page-item"><a class="page-link" href="#">7</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="col-lg-4">
      <div class="sidebar-posts">
        <div class="sidebar-posts-title">
          <h5>Top posts</h5>
        </div>
        @for ($x = 1; $x <= 7; $x++)
          <a class="post post-small" href="#">
            <img class="post-img" src="{{asset('images/post'.$x.'.jpg')}}" alt="">
            <div class="post-info">
              <b class="post-title">List of the best blog website templates</b>
              <span>Published at 12/8/2022</span>
            </div>
          </a>
        @endfor
      </div>
      <div class="sidebar-posts">
        <div class="sidebar-posts-title">
          <h5>Latest posts</h5>
        </div>
        @for ($x = 1; $x <= 7; $x++)
          <a class="post post-small" href="#">
            <img class="post-img" src="{{asset('images/post'.$x.'.jpg')}}" alt="">
            <div class="post-info">
              <b class="post-title">List of the best blog website templates</b>
              <span>Published at 12/8/2022</span>
            </div>
          </a>
        @endfor
      </div>
    </div>
  </div>
@endsection
