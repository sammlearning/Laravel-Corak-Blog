<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {

  // Upload user image
  public function user(Request $request) {

    $request->validate([
      'image' => 'required',
    ]);

    $image_64 = $request->image; //your base64 encoded data

    // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

    $replace = substr($image_64, 0, strpos($image_64, ',')+1);

    // find substring fro replace here eg: data:image/png;base64,

    $uploaded_image = str_replace($replace, '', $image_64);

    $uploaded_image = str_replace(' ', '+', $uploaded_image);

    $user = Auth::user();

    if ($user->image->url != 'images/profile.png') {
      // storage/4GCnOZ3Lc7.png
      $imageName = $user->image->url;
      // storage/4GCnOZ3Lc7.png > 4GCnOZ3Lc7.png
      $imageName = substr($imageName, 8);
    } else {
      // 4GCnOZ3Lc7.png
      $imageName = Str()->random(10).'.png';
    }

    Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

    $image = $user->image;
    $image->url = 'storage/'.$imageName;

    $image->save();

    return redirect()->route('profile.index')->with('profile picture', 'Profile picture updated successfully');

  }

  // Upload post image
  public function post(Request $request) {

    $request->validate([
      'post' => 'integer',
      'image' => 'required',
    ]);

    $image_64 = $request->image; //your base64 encoded data

    // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

    $replace = substr($image_64, 0, strpos($image_64, ',')+1);

    // find substring fro replace here eg: data:image/png;base64,

    $uploaded_image = str_replace($replace, '', $image_64);

    $uploaded_image = str_replace(' ', '+', $uploaded_image);

    $post = Post::findOrFail($request->post);

    if ($post->user->id != Auth::user()->id) {
      return redirect()->route('posts.index');
    }

    // storage/posts/4GCnOZ3Lc7.png
    $imageName = $post->image->url;
    // storage/posts/4GCnOZ3Lc7.png > posts/4GCnOZ3Lc7.png
    $imageName = substr($imageName, 8);

    Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

    return redirect()->route('posts.edit', $post->id)->with('success', 'Post image updated successfully');

  }

}
