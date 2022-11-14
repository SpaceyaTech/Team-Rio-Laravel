<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        
        return [
            'content'=>fake()->realText(),
            'account_id' => fake()->randomElement(Account::pluck('id')),
            'post_id'=> fake()->randomElement(Post::pluck('id')),
            'comment_id' => fake()->randomElement(Post::pluck('id')),
        ];
    }
}


