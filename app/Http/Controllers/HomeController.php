<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $posts = Post::with(['categories'])->orderBy('id', 'DESC')->get();
      $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
      $latest_posts = Post::orderByDesc('id')->limit(7)->get();
      return view('home', compact('posts', 'popular_posts', 'latest_posts'));

    }
}
