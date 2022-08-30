<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $user = User::findOrFail(1);

      // $image = $user->image;
      // $image->url = 'Hello world :D';

      // $image->save();

      return response('Done :D');
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
        $imageName = $user->image->url;
        $imageName = substr($imageName, 8);
      } else {
        $imageName = Str()->random(10).'.png';
      }

      Storage::disk('public')->put($imageName, base64_decode($uploaded_image));

      $image = $user->image;
      $image->url = 'storage/'.$imageName;

      $image->save();

      return redirect()->route('profile.index')->with('profile picture', 'Profile picture updated successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
