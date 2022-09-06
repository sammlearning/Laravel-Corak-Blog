@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <h5 class="mb-3">{{ $category->posts->count() }} published {{ $category->posts->count() > 1 ? 'posts' : 'post' }} in the <b>{{ $category->title }}</b> category</h5>
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
                <a class="badge text-bg-light text-decoration-none" href="{{ route('categories.show', $category->id) }}"> {{ $category->title }} </a>
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
