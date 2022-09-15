<?php

namespace App\Providers;

use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class BlogConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      if (Schema::hasTable('config')) {
        $config = DB::table('config')->first();
        $links_top = $links_center = $list01 = $list02 = NULL;
        if (Schema::hasTable('links')) {
          $links_top = Link::where('position', 'navtop')->get();
          $links_center = Link::where('position', 'navbar')->get();
          $list01 = Link::where('position', 'footer')->where('parent_list', 1)->get();
          $list02 = Link::where('position', 'footer')->where('parent_list', 2)->get();
        }
        config([
          'app.title' => $config->blog_title,
          'app.description' => $config->blog_description,
          'app.sociallinks' => collect(['facebook', 'instagram', 'youtube', 'twitter']),
          'app.facebook' => $config->facebook,
          'app.instagram' => $config->instagram,
          'app.youtube' => $config->youtube,
          'app.twitter' => $config->twitter,
          'app.comments' => $config->allow_comments,
          'app.search' => $config->allow_search,
          'app.navbar.fixed' => $config->fixed_navbar,
          'app.navbar.links.center' => $links_center,
          'app.navbar.links.top' => $links_top,
          'app.featured.post' => $config->featured_post,
          'app.footer.list01' => $list01,
          'app.footer.list02' => $list02,
          'app.footer.title01' => $config->footer01,
          'app.footer.title02' => $config->footer02,
        ]);
      }
    }
}
