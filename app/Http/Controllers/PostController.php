<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
      $categories = Category::get();

      $featured_post = DB::table('featured_post')->first();

      if ($posts->isEmpty()) {
        if ($categories->isEmpty()) {
          return redirect()->route('posts.create')->with(['No posts' => 'There are no published posts. You can create a new post from this page.', 'No categories' => 'It seems that you have not created any categories yet, you must create one before you start publishing posts.']);
        }
        return redirect()->route('posts.create')->with('No posts', 'There are no published posts. You can create a new post from this page.');
      }

      return view('dashboard.posts.index', compact('posts', 'featured_post'));

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
        'image_lg' => 'required',
        'image_md' => 'required',
        'image_sm' => 'required',
      ]);

      $categories = $request->category;

      $post = Post::create([
        'user_id' => Auth::user()->id,
        'subject' => $request->subject,
        'body' => $request->body,
      ]);

      $post->categories()->attach($categories);

      $images = collect([
        ['image_lg', ''],
        ['image_md', '-md'],
        ['image_sm', '-sm']
      ]);

      $id = Str()->random(10);

      // Upload post image
      for ($i=0; $i < $images->count(); $i++) {

        $input = $images[$i][0];
        $image_64 = $request->$input; //your base64 encoded data
        // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        // find substring fro replace here eg: data:image/png;base64,
        $uploaded_image = str_replace($replace, '', $image_64);
        $uploaded_image = str_replace(' ', '+', $uploaded_image);
        $imageName = 'posts/'.$id.$images[$i][1].'.png';
        Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

      }

      $image = new Image;
      $image->rid = $id;
      $image->url = 'storage/posts/'.$id.'.png';
      $image->url_md = 'storage/posts/'.$id.'-md.png';
      $image->url_sm = 'storage/posts/'.$id.'-sm.png';
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
      $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
      $latest_posts = Post::orderByDesc('id')->limit(7)->get();
      return view('post', compact('post', 'comments', 'popular_posts', 'latest_posts'));

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
