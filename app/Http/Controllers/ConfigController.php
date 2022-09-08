<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
  public function config_index () {
    $config = DB::table('config')->first();
    return view('dashboard.config.index', compact('config'));
  }

  public function config_update (Request $request) {

    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string|max:255',
    ]);

    $comments = $request->comments == 'on' ? 1 : 0;
    $auth = $request->auth == 'on' ? 1 : 0;

    DB::table('config')->update([
      'blog_title' => $request->title,
      'blog_description' => $request->description,
      'allow_comments' => $comments,
      'allow_register' => $auth,
    ]);

    return redirect()->route('config.index')->with('success', 'Blog configuration updated successfully');
  }

  public function logo (Request $request) {

    if (isset($request->icon)) {
      $logo = $request->icon;
      $logo_name = 'icon';
    } elseif (isset($request->logo_light)) {
      $logo = $request->logo_light;
      $logo_name = 'logo_light';
    } elseif (isset($request->logo_dark)) {
      $logo = $request->logo_dark;
      $logo_name = 'logo_dark';
    } else {
      return abort(404);
    }

    $image_64 = $logo; //your base64 encoded data
    // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
    $replace = substr($image_64, 0, strpos($image_64, ',')+1);
    // find substring fro replace here eg: data:image/png;base64,
    $uploaded_image = str_replace($replace, '', $image_64);
    $uploaded_image = str_replace(' ', '+', $uploaded_image);

    $imageName = $logo_name.'.png';

    Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

    return redirect()->route('config.index')->with('success', 'Blog logo updated successfully');

  }
}
