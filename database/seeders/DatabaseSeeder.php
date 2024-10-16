<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Category, Menu, Cart, CartItem, OrderDetail};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 categories
        Category::factory(5)->create()->each(function ($category) {
            // For each category, create 5 menus
            Menu::factory(5)->create([
                'category_id' => $category->id,
            ]);
        });

        // Create 10 carts with items
        Cart::factory(10)->create()->each(function ($cart) {
            CartItem::factory(3)->create([
                'cart_id' => $cart->id,
            ]);
        });

        // Create 5 order details
        OrderDetail::factory(5)->create();
    }
}

