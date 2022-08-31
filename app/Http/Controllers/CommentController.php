<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return abort(404);
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
        'comment' => 'required|string|max:255',
      ]);

      Comment::create([
        'user_id' => Auth::user()->id,
        'post_id' => $request->post_id,
        'comment' => $request->comment,
      ]);

      return redirect()->route('posts.show', $request->post_id)->with(['success' => 'Comment published successfully', 'scroll' => '#post-page-comments']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
      return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

      if ($comment->user->id != Auth::user()->id) {
        return redirect()->route('posts.show', $comment->post_id)->with('scroll', '#post-page-comments');
      }

      $post = Post::findOrFail($comment->post_id);
      $comments = Comment::where('post_id', $post->id)->orderBy('id', 'DESC')->get();

      $edit_comment = $comment;

      return view('post', compact('post', 'comments', 'edit_comment'))->with('scroll', '#post-page-comments');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {

      if ($comment->user->id != Auth::user()->id) {
        return redirect()->route('posts.show', $comment->post_id)->with('scroll', '#post-page-comments');
      }

      $request->validate([
        'comment' => 'required|string|max:255',
      ]);

      $comment->update([
        'comment' => $request->comment,
      ]);

      return redirect()->route('posts.show', $comment->post_id)->with(['success' => 'Comment updated successfully', 'scroll' => '#post-page-comments']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {

      if ($comment->user->id != Auth::user()->id) {
        return redirect()->route('posts.show', $comment->post_id)->with('scroll', '#post-page-comments');
      }

      Comment::destroy($comment->id);

      return redirect()->route('posts.show', $comment->post_id)->with(['success' => 'Comment deleted successfully', 'scroll' => '#post-page-comments']);

    }
}
