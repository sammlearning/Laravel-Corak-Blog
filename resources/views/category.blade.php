@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <h5 class="mb-3">{{ $posts->total() }} published {{ $posts->total() > 1 ? 'posts' : 'post' }} in the <b>{{ $category->title }}</b> category</h5>
      @foreach ($posts as $post)
        <div class="row g-0 bg-white mb-4 position-relative post">
          <div class="col-md-5 post-thumbnail" style="background-image: url({{ asset($post->image->url_md) }});"></div>
          <div class="col-md-7 p-3 p-md-4">
            <h5 class="post-title">{{ $post->subject }}</h5>
            <div class="mb-2 text-muted post-date">
              <span>Published at {{ $post->created_at }}</span>
              <span>By <b>{{ $post->user->name }}</b></span>
            </div>
            <p class="mb-2 text-muted">{{ Str::limit(strip_tags($post->body), 150) }}</p>
            <p class="post-categories">
              @foreach ($post->categories as $category)
                <span class="badge text-bg-light text-decoration-none"> {{ $category->title }} </span>
              @endforeach
            </p>
            <a href="{{route('posts.show', $post->id)}}" class="stretched-link text-decoration-none">Read more <i class="bi bi-chevron-right"></i></a>
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
          <div class="row g-0 bg-white position-relative sidebar-post">
            <div class="col-md-4 post-thumbnail" style="background-image: url({{ asset($post->image->url_md) }});"></div>
            <div class="col-md-8 p-3 p-md-2">
              <a class="stretched-link text-decoration-none" href="{{ route('posts.show', $post->id) }}"><h6 class="post-title"><b>{{ $post->subject }}</b></h6></a>
              <p class="m-0 text-muted">Published at {{ $post->created_at->format('Y-m-d') }}</p>
              <span class="text-muted">By <b>{{ $post->user->name }}</b></span>
            </div>
          </div>
        @endforeach
      </div>
      <div class="sidebar-posts">
        <div class="sidebar-posts-title">
          <h5>Latest posts</h5>
        </div>
        @foreach ($latest_posts as $post)
          <div class="row g-0 bg-white position-relative sidebar-post">
            <div class="col-md-4 post-thumbnail" style="background-image: url({{ asset($post->image->url_md) }});"></div>
            <div class="col-md-8 p-3 p-md-2">
              <a class="stretched-link text-decoration-none" href="{{ route('posts.show', $post->id) }}"><h6 class="post-title"><b>{{ $post->subject }}</b></h6></a>
              <p class="m-0 text-muted">Published at {{ $post->created_at->format('Y-m-d') }}</p>
              <span class="text-muted">By <b>{{ $post->user->name }}</b></span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
