<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index () {
    $posts = Post::count();
    $comments = Comment::count();
    $categories = Category::count();
    $users = User::count();
    $top_5_categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->limit(5)->get();
    $top_10_categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->limit(10)->get();
    $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
    $latest_posts = Post::orderByDesc('id')->limit(7)->get();
    $latest_comments = Comment::orderByDesc('id')->limit(7)->get();
    return view('dashboard.index', compact('posts', 'comments', 'categories', 'users', 'top_5_categories', 'top_10_categories', 'popular_posts', 'latest_posts', 'latest_comments'));
  }
}
