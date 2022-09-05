<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'rid' => 'profile',
          'url' => 'images/profile.png',
          'url_md' => 'images/profile.png',
          'url_sm' => 'images/profile.png',
          'imageable_id' => User::factory(),
        ];
    }
}
