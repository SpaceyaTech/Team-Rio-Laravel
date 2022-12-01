<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagePost>
 */
class ImagePostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           
            'image_id'=> fake()->randomElement(Image::pluck('id')),
            'post_id'=> fake()->randomElement(Post::pluck('id')),
        ];
    }
}
