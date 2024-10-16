<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ], [
            'total_price' => 0, 
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)->where('menu_id', $menu->id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->price = $menu->price * $cartItem->quantity; 
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->price,
            ]);
        }

        $cart->total_price = CartItem::where('cart_id', $cart->id)->sum('price');
        $cart->save();

        return redirect()->back()->with('success', "{$menu->name} added to cart!");
    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.menu')->first();
        return view('cart.view', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->cart->user_id == auth()->id()) {
            $cartItem->delete();

            $cart = Cart::find($cartItem->cart_id);
            $cart->total_price = CartItem::where('cart_id', $cart->id)->sum('price');
            $cart->save();

            return redirect()->back()->with('success', 'Item removed from cart');
        }

        return redirect()->back()->with('error', 'Unauthorized action');
    }
}
