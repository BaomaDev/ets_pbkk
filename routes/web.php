<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');
Route::get('/user', function () {
    $menus = [
        ['name' => 'Grilled Chicken', 'description' => 'Juicy grilled chicken with herbs.', 'price' => '15.00', 'image' => 'path_to_image'],
        ['name' => 'Vegan Salad', 'description' => 'Fresh and healthy vegan salad.', 'price' => '12.00', 'image' => 'path_to_image'],
        ['name' => 'Spaghetti Carbonara', 'description' => 'Classic Italian pasta with creamy sauce.', 'price' => '13.00', 'image' => 'path_to_image'],
        ['name' => 'Beef Steak', 'description' => 'Tender and juicy beef steak.', 'price' => '25.00', 'image' => 'path_to_image'],
        ['name' => 'Fruit Dessert', 'description' => 'Delicious mix of seasonal fruits.', 'price' => '7.00', 'image' => 'path_to_image'],
    ];
    return view('user.home', compact('menus'));
});

Route::fallback(function () {
    abort(404);
});