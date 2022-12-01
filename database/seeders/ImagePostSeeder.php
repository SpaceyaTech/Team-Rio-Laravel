<?php

namespace Database\Seeders;

use App\Models\ImagePost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagePostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagePost::factory()->count(10)->create();
    }
}
