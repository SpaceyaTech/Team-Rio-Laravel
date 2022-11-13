<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_title' =>fake()->realTextBetween(100,300),
            'post_description' =>fake()->text(),
            'post_content' => fake()->realText(),
            'account_id' => fake()->randomElement(Account::pluck('id'))
        ];
    }
}
