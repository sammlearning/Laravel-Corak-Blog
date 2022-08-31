<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $posts = Post::with(['categories'])->get();

      if ($posts->isEmpty()) {
        return redirect()->route('posts.create')->with('No posts', 'There are no published posted. You can post a new post from this page.');
      }

      return view('dashboard.posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::get();
      return view('dashboard.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $request->validate([
        'subject' => 'required',
        'category' => 'required',
        'body' => 'required',
        'image' => 'required',
      ]);

      $categories = $request->category;

      $post = Post::create([
        'user_id' => Auth::user()->id,
        'subject' => $request->subject,
        'body' => $request->body,
      ]);

      $post->categories()->attach($categories);

      // Upload post image

      $image_64 = $request->image; //your base64 encoded data

      // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

      $replace = substr($image_64, 0, strpos($image_64, ',')+1);

      // find substring fro replace here eg: data:image/png;base64,

      $uploaded_image = str_replace($replace, '', $image_64);

      $uploaded_image = str_replace(' ', '+', $uploaded_image);

      $imageName = 'posts/'.Str()->random(10).'.png';

      Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

      $image = new Image;

      $image->url = 'storage/'.$imageName;

      $post->image()->save($image);

      return redirect()->route('posts.index')->with('success', 'Post published successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $post = Post::findOrFail($id);
      $comments = Comment::where('post_id', $post->id)->orderBy('id', 'DESC')->get();

      return view('post', compact('post', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $post = Post::findOrFail($id);
      $categories = $post->categories;
      $all_categories = Category::get();
      return view('dashboard.posts.edit', ['post' => $post, 'all_categories' => $all_categories, 'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $request->validate([
        'subject' => 'required',
        'category' => 'required',
        'body' => 'required',
      ]);

      $categories = $request->category;

      $post = Post::findOrFail($id);
      $post->update([
        'subject' => $request->subject,
        'body' => $request->body,
      ]);

      $post->categories()->sync($categories);

      return redirect()->route('posts.index')->with('success', 'Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $post = Post::findOrFail($id);
      $post->delete();
      $post->image()->delete();
      return redirect()->route('posts.index')->with('success', 'Post deleted successfully');

    }
}
