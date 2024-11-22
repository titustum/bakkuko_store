<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Place an order after successful payment
    public function placeOrder()
    {
        $user = Auth::user();
        $cart = $user->carts()->where('status', 'active')->first();

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $cart->total_amount,
            'status' => 'pending', // Initially set the order status to 'pending'
            'payment_intent_id' => null, // Add the payment intent ID after successful payment
        ]);

        // Add order items
        foreach ($cart->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price_at_time_of_order' => $cartItem->product->price,
            ]);
        }

        // Mark the cart as completed
        $cart->update(['status' => 'completed']);

        return redirect()->route('orders.show', $order->id);
    }

    // Display an order
    public function show(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }

    // Display all orders for the user
    public function index()
    {
        $orders = Auth::user()->orders;

        return view('orders.index', compact('orders'));
    }
}
