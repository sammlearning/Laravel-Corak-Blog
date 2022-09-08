<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeaturedPost extends Controller
{

  public function update(Request $request) {

    $request->validate([
      'featured_post' => 'required',
    ]);

    $post = Post::findOrFail($request->featured_post);

    $request->featured_status == 'on' ? $status = '1' : $status = '0';

    DB::table('featured_post')->update([
      'status' => $status,
      'post_id' => $post->id,
    ]);

    return redirect()->route('posts.index')->with('success', 'Featured post updated successfully');

  }
}
