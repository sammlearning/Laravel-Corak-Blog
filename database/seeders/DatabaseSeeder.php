<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory(10)->create();

        \App\Models\User::factory(25)->has(Image::factory()->count(1))->create();

        \App\Models\User::factory()->has(Image::factory()->count(1))->create([
          'name' => 'Ahmed Nabil',
          'is_admin' => '1',
          'email' => 'ahmed.nabil.home@gmail.com',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
