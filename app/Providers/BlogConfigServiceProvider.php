<?php

namespace App\Providers;

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
      $this->app->singleton('blog_title', function () {
        $config = \DB::table('config')->first();
        return optional($config)->blog_title;
      });
      $this->app->singleton('blog_description', function () {
        $config = \DB::table('config')->first();
        return optional($config)->blog_description;
      });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
