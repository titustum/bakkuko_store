<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add a product to the cart
    public function add(Product $product)
    {
        $user = Auth::user();

        // Check if the product is already in the cart
        $cartItem = CartItem::where('user_id', $user->id ?? 2)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // If the product is already in the cart, increase the quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            CartItem::create([
                'user_id' => $user->id ?? 2,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Display cart contents
    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id ?? 2)->get();

        // Calculate total price
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('carts.index', compact('cartItems', 'total'));
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();  // Remove the cart item
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function cartItemsCount(){
        return CartItem::count();
    }

}
