<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderDetail;
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

    public function updateCartItem(Request $request, $id, $action)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->cart->user_id == auth()->id()) {
            if ($action == 'increase') {
                $cartItem->quantity++;
            } elseif ($action == 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity--;
            }

            $cartItem->price = $cartItem->menu->price * $cartItem->quantity;
            $cartItem->save();

            $cart = Cart::find($cartItem->cart_id);
            $cart->total_price = CartItem::where('cart_id', $cart->id)->sum('price');
            $cart->save();

            return redirect()->back()->with('success', 'Cart updated');
        }

        return redirect()->back()->with('error', 'Unauthorized action');
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

    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.menu')->first();
        if ($cart && $cart->items->count()) {
            foreach ($cart->items as $item) {
                OrderDetail::create([
                    'user_id' => auth()->id(),
                    'state' => 'waiting',
                    'address' => $request->address ?? 'Default Address', 
                    'menu_id' => $item->menu_id,
                    'quantity' => $item->quantity,
                    'total_price' => $item->price,
                ]);
            }

            // Clear the cart after checkout
            $cart->items()->delete();
            $cart->total_price = 0;
            $cart->save();

            return redirect()->route('cart.view')->with('success', 'Order placed successfully!');
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }
}