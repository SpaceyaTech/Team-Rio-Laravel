<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['category_name' => 'Sports','post_views' => 23,],
            ['category_name' => 'Education','post_views' => 12,],
            ['category_name' => 'Science','post_views' => 50,],
            ['category_name' => 'Technology','post_views' => 100,],
               
        ];

        foreach ($items as $item) {
            Category::create($item);
        }
    
    }
}
