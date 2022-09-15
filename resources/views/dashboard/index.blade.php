@extends('layouts.dashboard')

@section('content')
    <div class="row">
      <div class="col-md-3 mb-2">
        <div class="dashboard-small-card card-primary">
          <div>
            <h4>Registered users</h4>
            <span class="number">{{ $users }}</span>
          </div>
          <i class="bi bi-people-fill"></i>
        </div>
      </div>
      <div class="col-md-3 mb-2">
        <div class="dashboard-small-card card-info">
          <div>
            <h4>Published posts</h4>
            <span class="number">{{ $posts }}</span>
          </div>
          <i class="bi bi-postcard-heart-fill"></i>
        </div>
      </div>
      <div class="col-md-3 mb-2">
        <div class="dashboard-small-card card-danger">
          <div>
            <h4>Categories</h4>
            <span class="number">{{ $categories }}</span>
          </div>
          <i class="bi bi-bookmarks-fill"></i>
        </div>
      </div>
      <div class="col-md-3 mb-2">
        <div class="dashboard-small-card card-success">
          <div>
            <h4>Published comments</h4>
            <span class="number">{{ $comments }}</span>
          </div>
          <i class="bi bi-chat-dots-fill"></i>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Categories <span class="badge bg-secondary">Top 10</span></h5>
          </div>
          <div class="card-body">
            <canvas id="categoriesTop10" width="400" height="400"></canvas>
            <script>
              const categoriesTop10 = document.getElementById('categoriesTop10');
              const categoriesTop10Chart = new Chart(categoriesTop10, {
                type: 'bar',
                data: {
                  labels: [
                    @foreach ($top_10_categories as $category)
                      '{{ $category->title }}',
                    @endforeach
                  ],
                  datasets: [{
                    label: 'Posts',
                    data: [
                      @foreach ($top_10_categories as $category)
                        {{ $category->posts->count() }},
                      @endforeach
                    ],
                    backgroundColor: [
                      'rgb(81, 50, 82 ,0.2)',
                      'rgba(142, 68, 173, 0.2)',
                      'rgb(19, 99, 223, 0.2)',
                      'rgba(196, 69, 105, 0.2)',
                      'rgb(255, 193, 142 ,0.2)',
                      'rgba(247, 143, 179, 0.2)',
                      'rgb(41, 52, 98 ,0.2)',
                      'rgba(11, 232, 129, 0.2)',
                      'rgba(255, 63, 52, 0.2)',
                      'rgba(255, 218, 121, 0.2)'
                    ],
                    borderColor: [
                      'rgb(81, 50, 82 , 1)',
                      'rgba(142, 68, 173, 1)',
                      'rgb(19, 99, 223, 1)',
                      'rgba(196, 69, 105, 1)',
                      'rgb(255, 193, 142 , 1)',
                      'rgba(247, 143, 179, 1)',
                      'rgb(41, 52, 98 , 1)',
                      'rgba(11, 232, 129, 1)',
                      'rgba(255, 63, 52, 1)',
                      'rgba(255, 218, 121, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: { scales: { y: { beginAtZero: true } } }
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Categories <span class="badge bg-secondary">Top 5</span></h5>
          </div>
          <div class="card-body">
            <canvas id="categoriesTop5"></canvas>
            <script>
              const categoriesTop5 = document.getElementById('categoriesTop5');
              const categoriesTop5Chart = new Chart(categoriesTop5, {
                type: 'radar',
                data: {
                  labels: [
                    @foreach ($top_5_categories as $category)
                      '{{ $category->title }}',
                    @endforeach
                  ],
                  datasets: [{
                    label: 'Posts',
                    data: [
                      @foreach ($top_5_categories as $category)
                        '{{ $category->posts_count }}',
                      @endforeach
                    ],
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)'
                  }]
                },
                options: { elements: { line: { borderWidth: 3 } } }
              });
            </script>
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Posts & Categories Overview</h5>
          </div>
          <div class="card-body">
            <canvas id="postsCategoriesOverview"></canvas>
            <script>
              const postsCategoriesOverview = document.getElementById('postsCategoriesOverview');
              const postsCategoriesOverviewData = {
                labels: [
                  'Posts',
                  'Comments',
                  'Categories'
                ],
                datasets: [{
                  label: 'My First Dataset',
                  data: [{{ $posts }}, {{ $comments }}, {{ $categories }}],
                  backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                  ],
                  hoverOffset: 4
                }]
              };
              const postsCategoriesOverviewChart = new Chart(postsCategoriesOverview, {
                type: 'doughnut',
                data: postsCategoriesOverviewData
              });
            </script>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Popular posts</h5>
          </div>
          <div class="card-body p-0">
            @foreach ($popular_posts as $post)
              <div class="row g-0 bg-white position-relative sidebar-post">
                <div class="col-md-3 post-thumbnail" style="background-image: url({{ asset($post->image->url_md) }});"></div>
                <div class="col-md-8 p-3 p-md-2">
                  <a class="stretched-link text-decoration-none" href="{{ route('posts.show', $post->id) }}" target="_blank"><h6 class="post-title"><b>{{ $post->subject }}</b><i class="bi bi-box-arrow-up-right ms-2"></i></h6></a>
                  <p class="m-0 text-muted">Published at {{ $post->created_at->format('Y-m-d') }}</p>
                  <span class="text-muted">By <b>{{ $post->user->name }}</b></span>
                </div>
              </div>
              <hr>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Latest posts</h5>
          </div>
          <div class="card-body p-0">
            @foreach ($latest_posts as $post)
              <div class="row g-0 bg-white position-relative sidebar-post">
                <div class="col-md-3 post-thumbnail" style="background-image: url({{ asset($post->image->url_md) }});"></div>
                <div class="col-md-8 p-3 p-md-2">
                  <a class="stretched-link text-decoration-none" href="{{ route('posts.show', $post->id) }}" target="_blank"><h6 class="post-title"><b>{{ $post->subject }}</b><i class="bi bi-box-arrow-up-right ms-2"></i></h6></a>
                  <p class="m-0 text-muted">Published at {{ $post->created_at }}</p>
                  <span class="text-muted">By <b>{{ $post->user->name }}</b></span>
                </div>
              </div>
              <hr>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-4 dashboard-col">
        <div class="dashboard-card">
          <div class="card-header">
            <h5 class="card-header-title">Latest comments</h5>
          </div>
          <div class="card-body p-0 pb-4">
            @foreach ($latest_comments as $comment)
              <div class="row g-3 comment" style="transform: rotate(0);">
                <div class="col-auto">
                  <img src="{{ asset($comment->user->image->url_md) }}" class="rounded-circle" alt="">
                </div>
                <div class="col-9 comment-info">
                  <a href="{{ route('posts.show', $comment->post->id) }}#comment_{{ $comment->id }}" target="_blank" class="stretched-link text-decoration-none comment-link"><span><b>{{ $comment->user->name }}</b><i class="bi bi-arrow-right mx-1"></i> <b>{{ $comment->post->subject }}</b></span></a>
                  <p>{{ Str::limit(strip_tags($comment->comment), 50) }}</p>
                  <span>Published at {{ $comment->created_at }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
