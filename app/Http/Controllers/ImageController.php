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
      'image_lg' => 'required',
      'image_md' => 'required',
      'image_sm' => 'required',
    ]);

    $images = collect([
      ['image_lg', ''],
      ['image_md', '-md'],
      ['image_sm', '-sm']
    ]);

    $user = Auth::user();
    $id = Str()->random(10);

    // Update user image
    for ($i=0; $i < $images->count(); $i++) {

      $input = $images[$i][0];
      $image_64 = $request->$input; //your base64 encoded data
      // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
      $replace = substr($image_64, 0, strpos($image_64, ',')+1);
      // find substring fro replace here eg: data:image/png;base64,
      $uploaded_image = str_replace($replace, '', $image_64);
      $uploaded_image = str_replace(' ', '+', $uploaded_image);

      if ($user->image->url == 'images/profile.png') {
        $imageName = $id.$images[$i][1].'.png';
      } else {
        $imageName = $user->image->rid.$images[$i][1].'.png';
      }

      Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

    }

    if ($user->image->url == 'images/profile.png') {
      $image = $user->image;
      $image->rid = $id;
      $image->url = 'storage/'.$id.'.png';
      $image->url_md = 'storage/'.$id.'-md.png';
      $image->url_sm = 'storage/'.$id.'-sm.png';
      $image->save();
    }

    return redirect()->route('profile.index')->with('profile picture', 'Profile picture updated successfully');

  }

  // Update post image
  public function post(Request $request) {

    $request->validate([
      'post' => 'integer',
      'image_lg' => 'required',
      'image_md' => 'required',
      'image_sm' => 'required',
    ]);

    $post = Post::findOrFail($request->post);

    if ($post->user->id != Auth::user()->id) {
      return redirect()->route('posts.index');
    }

    $images = collect([
      ['image_lg', ''],
      ['image_md', '-md'],
      ['image_sm', '-sm']
    ]);

    // Update post image
    for ($i=0; $i < $images->count(); $i++) {

      $input = $images[$i][0];
      $image_64 = $request->$input; //your base64 encoded data
      // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
      $replace = substr($image_64, 0, strpos($image_64, ',')+1);
      // find substring fro replace here eg: data:image/png;base64,
      $uploaded_image = str_replace($replace, '', $image_64);
      $uploaded_image = str_replace(' ', '+', $uploaded_image);
      $imageName = 'posts/'.$post->image->rid.$images[$i][1].'.png';
      Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

    }

    return redirect()->route('posts.edit', $post->id)->with('success', 'Post image updated successfully');

  }

}
