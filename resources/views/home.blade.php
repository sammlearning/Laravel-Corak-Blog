@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      @if (session('search'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          Your search for <b> {{ session('search') }} </b> did not return any results.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (session('category'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          The <b> {{ session('category') }} </b> category is empty.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if ($featured_post != false && $posts->currentPage() == 1)
        <div class="featured-post" style="background-image: url('{{asset($featured_post->image->url)}}')">
          <div class="post-info">
            <h4 class="post-title">{{ $featured_post->subject }}</h4>
            <span>Published at {{ $featured_post->created_at }} By <b>{{ $featured_post->user->name }}</b></span>
            <div class="post-categories">
              @foreach ($featured_post->categories as $category)
                <a href="{{ route('categories.show', $category->id) }}"><span class="badge text-bg-light text-decoration-none">{{ $category->title }}</span></a>
              @endforeach
            </div>
          </div>
        </div>
      @endif
      @foreach ($posts as $post)
        <div class="post" style="transform: rotate(0);">
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
                <span class="badge text-bg-light text-decoration-none"> {{ $category->title }} </span>
              @endforeach
            </span>
            <a class="btn post-read-more stretched-link" href="{{route('posts.show', $post->id)}}">Read more <i class="bi bi-chevron-right"></i></a>
          </div>
        </div>
      @endforeach
      {{ $posts->onEachSide(2)->links() }}
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
