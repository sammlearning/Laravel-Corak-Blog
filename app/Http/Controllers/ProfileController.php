<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

      if (Auth::user()->id != $id) {
        return redirect()->route('profile.index');
      }

      $validate = collect([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
      ]);

      $data = collect([
        'name' => $request->name,
        'email' => $request->email,
      ]);

      if (!empty($request->password)) {
        $validate->put('password', 'required|string|min:8|confirmed');
        $data->put('password', $request->password);
        $data->put('password_confirmation', $request->password_confirmation);
      }

      if ($request->email != Auth::user()->email) {
        $validate->put('email', 'required|string|email|max:255|unique:users');
      }

      $validator = Validator::make($data->all(), $validate->all());

      if ($validator->fails()) {
        return redirect()->route('profile.index')->with('scroll', '#edit-profile')->withErrors($validator)->withInput();
      }

      if (!empty($request->password)) {
        $data->put('password', Hash::make($request->password));
        $data->forget('password_confirmation');
      }

      $user = User::find($id);

      $user->update($data->all());

      return redirect()->route('profile.index')->with(['success' => 'Profile updated successfully', 'scroll' => '#edit-profile']);

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
