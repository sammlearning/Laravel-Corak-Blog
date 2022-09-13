<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class LinkController extends Controller
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
      $categories = Category::get();
      return view('dashboard.config.links.create', compact('categories'));
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
        'title' => 'required|string|max:255',
        'parent' => 'required|integer',
        'type' => 'required|string|max:255',
      ]);

      $url = $category = NULL;

      if ($request->type == 'url') {
        $request->validate([
          'url' => 'required|url',
        ]);
        $url = $request->url;
      }

      if ($request->type == 'category') {
        $request->validate([
          'category' => 'required|integer',
        ]);
        $category = $request->category;
      }

      if ($request->position != 'footer' && $request->position != NULL) {
        $request->parent == 0 ? $parent = NULL : $parent = $request->parent;
        $position = $request->position;
        $parent_list = NULL;
      } else {
        $parent = NULL;
        $parent_list = $request->parent;
        $position = 'footer';
      }

      if ($parent == NULL && $position != 'footer') {
        if ($position == 'navbar') {
          $links = Link::where('link_id', NULL)->where('position', 'navbar')->count();
        } elseif ($position == 'navtop') {
          $links = Link::where('link_id', NULL)->where('position', 'navtop')->count();
        }
        if ($links >= 8) {
          return redirect()->route('config.navbar')->with('error', 'Cannot create more parents now, You can add subsidiary links');
        }
      }

      if ($parent != NULL && $position != 'footer') {
        $link = Link::findOrFail($parent);
        $position = $link->position;
      }

      Link::create([
        'title' => $request->title,
        'link_id' => $parent,
        'parent_list' => $parent_list,
        'position' => $position,
        'type' => $request->type,
        'url' => $url,
        'category_id' => $category,
      ]);

      if ($position == 'footer') {
        return redirect()->route('config.footer')->with('success', 'Link created successfully');
      } else {
        return redirect()->route('config.navbar')->with('success', 'Link created successfully');
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
      $links = Link::get();
      $categories = Category::get();
      return view('dashboard.config.links.edit', compact('link', 'links', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
      $request->validate(['title' => 'required|string|max:255']);

      if ($link->type == 'dropdown') {
        $request->validate(['position' => 'required|string|max:255']);
        $link->update([
          'title' => $request->title,
          'position' => $request->position,
        ]);
      }

      $request->parent == 0 ? $parent = NULL : $parent = $request->parent;
      $url = $category = NULL;
      $position = $request->position;

      $request->validate([
        'parent' => 'required|integer',
        'type' => 'required|string|max:255',
      ]);

      if ($parent != NULL) {
        $parent = Link::findOrFail($request->parent);
        $position = $parent->position;
        $parent = $parent->id;
      }

      if ($parent == NULL && $link->parent != NULL) {
        if ($link->position == 'navtop') {
          $links = Link::where('link_id', NULL)->where('position', 'navtop')->count();
        }
        if ($link->position == 'navbar') {
          $links = Link::where('link_id', NULL)->where('position', 'navbar')->count();
        }
        if ($links >= 8) {
          return redirect()->route('config.navbar')->with('error', 'Cannot create more parents now, You can add subsidiary links');
        }
      }

      if ($request->type == 'category') {
        $request->validate([
          'category' => 'required|integer',
        ]);
        $category = $request->category;
      }

      if ($request->type == 'url') {
        $request->validate([
          'url' => 'required|url',
        ]);
        $url = $request->url;
      }

      $link->update([
        'title' => $request->title,
        'link_id' => $parent,
        'position' => $position,
        'type' => $request->type,
        'url' => $url,
        'category_id' => $category,
      ]);

      if ($link->position != 'footer') {
        return redirect()->route('config.navbar')->with('success', 'Link updated successfully');
      } else {
        return redirect()->route('config.footer')->with('success', 'Link updated successfully');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
      $link->delete();
      if ($link->position != 'footer') {
        return redirect()->route('config.navbar')->with('success', 'Link deleted successfully');
      } else {
        return redirect()->route('config.footer')->with('success', 'Link deleted successfully');
      }
    }
}
