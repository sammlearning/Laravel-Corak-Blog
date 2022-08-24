@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <div class="post-page">
        <div class="post-info">
          <h4 class="post-title">How to play Euro Truck Simulator 2 on low PC</h4>
          <span>Published at 12/8/2022 By <b>Ahmed Nabil</b></span>
        </div>
        <img class="post-img" src="{{asset('images/post7.jpg')}}">
        <div class="post-body">
          <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
          <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
          <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
          <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>
        </div>
        <div class="post-categories">
          <a href="#"><span class="badge rounded-pill post-category">Gaming</span></a>
          <a href="#"><span class="badge rounded-pill post-category">Technology</span></a>
          <a href="#"><span class="badge rounded-pill post-category">Internet</span></a>
        </div>
      </div>
      <section class="post-page-comments">
        <div class="comments">
          <div class="post-page-comments-title">
            <h5>Comments (10)</h5>
          </div>
          <div class="add-comment">
            <form class="">
              <div class="col-auto">
                <img src="{{asset('images/man1.png')}}" alt="">
              </div>
              <div class="form-floating col-7 col-md-8 col-xl-9">
                <input type="text" class="form-control" id="addComment" placeholder="Add comment" required>
                <label for="addComment">Add comment</label>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-light add_comment_btn">Enter</button>
              </div>
            </form>
          </div>
          @for ($x = 0; $x <= 5; $x++)
            <div class="row g-3 comment">
              <div class="col-auto">
                <img src="{{asset('images/man2.png')}}" alt="">
              </div>
              <div class="col-9 comment-info">
                <span><b>Ahmed Nabil</b></span>
                <p>Maecenas nec sapien vel lorem placerat tempus quis vitae lorem.</p>
                <span>Published at 12/8/2022</span>
              </div>
            </div>
          @endfor
        </div>
      </section>
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
