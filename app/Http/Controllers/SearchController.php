<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function index(Request $request) {
    $request->validate(['q' => 'string|max:255|required']);
    $posts = Post::where('subject', 'like', '%'.$request->q.'%')->orderBy('id', 'DESC')->paginate(6);
    $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
    $latest_posts = Post::orderByDesc('id')->limit(7)->get();
    $search = $request->q;
    if ($posts->isEmpty()) {
      return redirect()->route('home')->with('search', $search);
    }
    $posts->withPath('/search?q='. $search);
    return view('search', compact('posts', 'popular_posts', 'latest_posts', 'search'));
  }
}
