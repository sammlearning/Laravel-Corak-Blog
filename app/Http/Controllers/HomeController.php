<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

      if (DB::table('featured_post')->doesntExist()) {
        DB::table('featured_post')->insert([
          'status' => 0,
          'post_id' => 0,
        ]);
      }

      $post = DB::table('featured_post')->first();

      if ($post->status != 0) {
        $featured_post = Post::find($post->post_id);
        if (!$featured_post) {
          $featured_post = false;
        }
      } else {
        $featured_post = false;
      }

      $posts = Post::orderBy('id', 'DESC')->paginate(7);
      $posts->withPath('/home');
      $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
      $latest_posts = Post::orderByDesc('id')->limit(7)->get();
      return view('home', compact('posts', 'popular_posts', 'latest_posts', 'featured_post'));

    }
}
