<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed categories
        Category::factory(10)->create()->each(function ($category) {
            // Seed menus for each category
            Menu::factory(5)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}