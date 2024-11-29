<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        // Set your Stripe secret key
        Stripe::setApiKey(config('stripe.secret'));

        // Get the current user's active cart items
        $cart = auth()->user()->carts()->where('status', 'active')->first();
        $cartItems = $cart ? $cart->cartItems()->get() : collect(); // If no active cart, return empty collection

        // Calculate total amount of the cart
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Return the checkout page with cart items, total amount, and Stripe key
        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'stripeKey' => config('stripe.key'),
        ]);
    }

    public function process(Request $request)
    {
        // Start a database transaction to ensure the order is only created if the payment is successful
        \DB::beginTransaction();

        try {
            // Set your Stripe secret key
            Stripe::setApiKey(config('stripe.secret'));

            // Create a PaymentIntent to handle the payment process
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->input('amount'),  // Total amount in cents
                'currency' => 'aud',
                'description' => 'Order Payment',
            ]);

            // Return the client secret to the frontend
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $request->input('amount'),  // Pass the amount for order creation
            ]);

        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function success(Request $request)
    {
        // Process the order creation and return the order_id
        $user = auth()->user();
        $payment_id = $request->input('payment_id');
        $total_amount = $request->input('total_amount');

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total_amount / 100, // Convert cents to dollars
            'delivery_address' => $request->input('delivery_address'),
            'status' => 'completed',
            'payment_intent_id' => $payment_id,
        ]);

        // Optionally, create OrderItems from the cart items
        // Retrieve the active cart for the current user
        $cart = $user->carts()->where('status', 'active')->first();

        // If the cart exists, associate the cart items with the order
        if ($cart) {
            // Create order items from the cart items
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price_at_time_of_order' => $cartItem->product->price,
                ]);
            }

            // Delete all cart items associated with the user's active cart
            $cart->cartItems()->delete();

            // Optionally, mark the cart as inactive or delete it
            $cart->update(['status' => 'completed']);  // Or you can delete the cart: $cart->delete();
        }

        return response()->json(['order_id' => $order->id]);
    }



    public function showSuccessPage(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::with('orderItems')->find($orderId);

        if (!$order) {
            return redirect()->route('checkout.index')->withErrors(['error' => 'Order not found']);
        }

        return view('checkout.success', ['order' => $order]);
    }



}
