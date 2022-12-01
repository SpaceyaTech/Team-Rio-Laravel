<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => fake()->randomElement(User::pluck('id')),
            "account_name" =>fake()->firstName()."_".fake()->lastName(),
            "image" => fake()->imageUrl(),
            "bio_data" =>fake()->text(),
        ];
    }
}
