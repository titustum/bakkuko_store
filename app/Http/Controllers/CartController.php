<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

        // Check if the user already has an active cart
        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

        if (!$cart) {
            // If no active cart, create a new one
            $cart = Cart::create(['user_id' => $user->id, 'status' => 'active']);
        }

        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // If the product is already in the cart, increase the quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price_at_time_of_addition' => $product->price,  // Store the price at the time of addition
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Display cart contents
    public function index()
    {
        $user = Auth::user();
        $cart = $user->carts()->where('status', 'active')->first();

        $cartItems = $cart->cartItems()->get(); // This should return a collection, not an array.


        // Calculate total price
        $total = $cartItems->sum(function ($item) {
            return $item->price_at_time_of_addition * $item->quantity;
        });

        return view('carts.index', compact('cartItems', 'total'));
    }


    // Remove a product from the cart
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();  // Remove the cart item

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    // Count the total number of items in the cart
    public function cartItemsCount()
    {
        $user = Auth::user();
        $cart = $user->carts()->where('status', 'active')->first();

        // If no active cart, return count as 0
        if (!$cart) {
            return response()->json(['count' => 0]);
        }

        // Return the count of cart items
        return response()->json(['count' => $cart->cartItems()->count()]);
    }
}
