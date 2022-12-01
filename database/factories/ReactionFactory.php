<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaction>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
 
        
        return [
            'reaction_type'=>fake()->randomElement(Reaction::pluck('reaction_type')),
            'post_id' =>fake()->randomElement(Post::pluck('id')),
            'comment_id' =>fake()->randomElement(Comment::pluck('id')),
            'account_id'=>fake()->randomElement(Account::pluck('id')),
        ];
    }
}
