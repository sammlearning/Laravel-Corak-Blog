@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      @if ($featured_post != false)
        <div class="featured-post" style="background-image: url('{{asset($featured_post->image->url)}}')">
          <div class="post-info">
            <h4 class="post-title">{{ $featured_post->subject }}</h4>
            <span>Published at {{ $featured_post->created_at }} By <b>{{ $featured_post->user->name }}</b></span>
            <div class="post-categories">
              @foreach ($featured_post->categories as $category)
                <a href="#"><span class="badge rounded-pill post-category">{{ $category->title }}</span></a>
              @endforeach
            </div>
          </div>
        </div>
      @endif
      @foreach ($posts as $post)
        <div class="post">
          <img class="post-img image-loader" src="{{ asset($post->image->url_md) }}">
          <div class="post-info">
            <h5 class="post-title">{{ $post->subject }}</h5>
            <div class="post-date">
              <span>Published at {{ $post->created_at }}</span>
              <span>By <b>{{ $post->user->name }}</b></span>
            </div>
            <p class="post-short-description">{{ strip_tags($post->body) }}</p>
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
          <h5>Popular posts</h5>
        </div>
        @foreach ($popular_posts as $post)
          <a class="post post-small" href="{{ route('posts.show', $post->id) }}">
            <img class="post-img image-loader" src="{{ asset($post->image->url_sm) }}" alt="">
            <div class="post-info">
              <b class="post-title">{{ $post->subject }}</b>
              <span>Published at {{ $post->created_at }}</span>
            </div>
          </a>
        @endforeach
      </div>
      <div class="sidebar-posts">
        <div class="sidebar-posts-title">
          <h5>Latest posts</h5>
        </div>
        @foreach ($latest_posts as $post)
          <a class="post post-small" href="{{ route('posts.show', $post->id) }}">
            <img class="post-img image-loader" src="{{ asset($post->image->url_sm) }}" alt="">
            <div class="post-info">
              <b class="post-title">{{ $post->subject }}</b>
              <span>Published at {{ $post->created_at }}</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
@endsection
