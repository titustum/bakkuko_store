<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;  // Assuming you're using CartItem
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        // Set your Stripe secret key
        Stripe::setApiKey(config('stripe.secret'));

        // Example data for cart items (replace with your cart data)
        $cartItems = CartItem::where('user_id', auth()->id() ?? 2)->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'stripeKey' => config('stripe.key'),
        ]);
    }

    public function process(Request $request)
    {
        try {
            Stripe::setApiKey(config('stripe.secret'));

            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->input('amount'),  // Total amount in cents
                'currency' => 'aud',
                'description' => 'Order Payment',
            ]);

            // On success, store order details in session and redirect to success page
            return redirect()->route('checkout.success');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function success(Request $request)
    {
        // Example of how you can store order details in session (adjust as needed for your application)
        session([
            'order_number' => 'ORD-' . strtoupper(uniqid()),  // Example order number
            'total_amount' => $request->input('amount') / 100, // Amount is in cents, convert to dollars
        ]);

        return view('checkout.success');
    }



}


