<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Link;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(rand(5, 15))->create();

        Link::factory(3, ['position' => 'navtop'])->for(Category::all()->random())->create();

        Link::factory(8, ['position' => 'navbar'])->for(Category::all()->random())->create();

        Link::factory(8, ['position' => 'footer', 'parent_list' => 1])->for(Category::all()->random())->create();

        Link::factory(5, ['position' => 'footer', 'parent_list' => 2])->for(Category::all()->random())->create();

        DB::table('config')->update([
          'blog_title' => 'World Of Technology',
          'blog_description' => fake()->sentence(15),
          'facebook' => '#',
          'instagram' => '#',
          'youtube' => '#',
          'twitter' => '#',
        ]);

        User::factory(25)->has(Image::factory([
          'rid' => 'profile',
          'url' => 'images/profile.png',
          'url_md' => 'images/profile.png',
          'url_sm' => 'images/profile.png',
        ]))->create();

        User::factory()->has(Image::factory([
          'rid' => 'profile',
          'url' => 'images/profile.png',
          'url_md' => 'images/profile.png',
          'url_sm' => 'images/profile.png',
        ]))->create([
          'name' => 'Admin Account',
          'is_admin' => '1',
          'email' => 'admin@example.com',
          'password' => Hash::make('admin'),
        ]);

        // Featured Post
        Post::factory()->has(Image::factory([
          'rid' => 'cityscape-view-sceneric-urban-downtown',
          'url' => 'images/cityscape-view-sceneric-urban-downtown.jpg',
          'url_md' => 'images/cityscape-view-sceneric-urban-downtown.jpg',
          'url_sm' => 'images/cityscape-view-sceneric-urban-downtown.jpg',
        ]))->for(User::all()->random())->hasAttached(Category::all()->random(4))->create();

        Post::factory(25)->has(Image::factory([
          'rid' => 'project-thumbnail',
          'url' => 'images/project-thumbnail.jpg',
          'url_md' => 'images/project-thumbnail.jpg',
          'url_sm' => 'images/project-thumbnail.jpg',
        ]))->for(User::all()->random())->hasAttached(Category::all()->random(3))->create();

        Comment::factory(rand(5, 10), [
          'post_id' => User::all()->random(),
        ])->for(User::all()->random())->create();

        DB::table('featured_post')->update([
          'status' => '1',
          'post_id' => '1',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
