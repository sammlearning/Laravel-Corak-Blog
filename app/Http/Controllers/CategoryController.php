<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $categories = Category::withCount('posts')->get();

      if ($categories->isEmpty()) {
        return redirect()->route('categories.create')->with('No categories', 'There are no published categories. You can create a new category from this page.');
      }

      return view('dashboard.categories.index', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.categories.create');
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
        'category_title' => 'required',
        'category_description' => 'required',
      ]);

      Category::create([
        'title' => $request->category_title,
        'description' => $request->category_description,
      ]);

      return redirect()->route('categories.index')->with('success', 'Category created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $posts = Category::findOrFail($id)->posts()->orderBy('id', 'DESC')->paginate(7);
      $posts->withPath('/categories/'. $id);
      $category = Category::find($id);
      $popular_posts = Post::orderByDesc('id')->withCount('comments')->limit(7)->get()->sortByDesc('comments_count');
      $latest_posts = Post::orderByDesc('id')->limit(7)->get();
      return view('category', compact('category', 'posts', 'popular_posts', 'latest_posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $category = Category::findOrFail($id);
      return view('dashboard.categories.edit', ['category' => $category]);

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
        'category_title' => 'required',
        'category_description' => 'required',
      ]);

      $category = Category::findOrFail($id);
      $category->update([
        'title' => $request->category_title,
        'description' => $request->category_description,
      ]);

      return redirect()->route('categories.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $category = Category::findOrFail($id);
      $category->delete();
      return redirect()->route('categories.index')->with('success', 'Category deleted successfully');

    }
}
