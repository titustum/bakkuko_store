<x-main-layout>
    <div class="relative bg-indigo-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Order Success</h1>
        </div>
    </div>

    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <h3 class="text-xl font-semibold">Thank you for your order!</h3>
        <p>Your order has been successfully placed. Below are your order details:</p>

        <div class="mt-4">
            <h4 class="text-lg font-medium">Order ID: {{ $order->id }}</h4>
            <p>Status: {{ ucfirst($order->status) }}</p>
            <p>Total: AUD $ {{ number_format($order->total_amount, 2) }}</p>
            <p>Payment ID: {{ $order->payment_id }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-indigo-600">Return to Home</a>
        </div>
    </div>
</x-main-layout>
