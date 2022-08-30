<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $users = User::withCount('posts')->get();
      return view('dashboard.users.index', ['users' => $users]);

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

      $user = User::findOrFail($id);
      return view('dashboard.users.edit', ['user' => $user]);

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

      $user = User::findOrFail($id);

      $validate = collect([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
      ]);

      $data = collect([
        'name' => $request->name,
        'email' => $request->email,
      ]);

      if (!empty($request->password)) {
        $validate->put('password', 'required|string|min:8');
        $data->put('password', Hash::make($request->password));
      }

      if ($request->email != $user->email) {
        $validate->put('email', 'required|string|email|max:255|unique:users');
      }

      if ($id != Auth::user()->id) {
       $validate->put('role', 'required|integer');
       $data->put('is_admin', $request->role);
      }

      $request->validate($validate->all());
      $user->update($data->all());

      return redirect()->route('users.index')->with('success', 'User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
      if ($id != Auth::user()->id) {
        $user->delete();
        $user->image()->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
      }
    }
}
