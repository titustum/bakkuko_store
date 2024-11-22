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
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);

        } catch (\Exception $e) {
            // Rollback the transaction in case of any error
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function success(Request $request)
    {
        // Start a database transaction
        \DB::beginTransaction();

        try {
            // Retrieve the cart and order details from session or database
            $user = auth()->user();
            $cart = $user->carts()->where('status', 'active')->first();
            $cartItems = $cart->cartItems()->get();

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $request->input('total_amount'),  // Total amount in dollars
                'status' => 'completed',  // Order status (completed after successful payment)
                'payment_id' => $request->input('payment_id'), // Stripe payment ID
            ]);

            // Create OrderItems from cart items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price_at_time_of_order' => $cartItem->product->price,  // Price when added to the cart
                ]);
            }

            // Clear the user's cart after creating the order
            $cart->cartItems()->delete();

            // Commit the transaction
            \DB::commit();

            // Redirect to the order success page with the order ID
            return redirect()->route('checkout.success')->with('order', $order);

        } catch (\Exception $e) {
            // Rollback in case of error
            \DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
