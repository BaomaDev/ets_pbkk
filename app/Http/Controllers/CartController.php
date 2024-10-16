<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);

        // Get the cart from the session, or create a new one if it doesn't exist
        $cart = session()->get('cart', []);

        // Add the menu item to the cart
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity']++;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'quantity' => 1,
                'price' => $menu->price,
                'image' => $menu->image,
            ];
        }

        // Update the cart session
        session()->put('cart', $cart);

        // Redirect back to the menu page
        return redirect()->back()->with('success', "{$menu->name} added to cart!");
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.view', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart');
    }
}
