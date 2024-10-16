<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

// Route::get('/admin', function () {
//     return view('admin.dashboard', ['title' => 'Monkey']);
// });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', AdminMenuController::class);
});

Route::get('/admin', [AdminMenuController::class, 'index']);

Route::get('/menu', function () {
    return view('menu.menus', ['title' => 'Monkeys', 'menus'=>App\Models\Menu::all()]);
});

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::fallback(function () {
    abort(404);
});
