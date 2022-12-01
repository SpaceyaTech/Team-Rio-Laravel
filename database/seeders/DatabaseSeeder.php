<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(UserSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ImagePostSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CategoryPostSeeder::class);
        $this->call(CommentSeeder::class);
       $this->call(ReactionSeeder::class);
       


    }
}
