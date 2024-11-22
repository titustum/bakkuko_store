<x-main-layout>
    <div class="mt-6">
        <h2 class="text-xl font-bold">Order Success</h2>
        <p>Thank you for your purchase! Your order has been successfully placed.</p>

        <h3 class="mt-4">Order #{{ $order->id }}</h3>
        <p>Total: AUD ${{ number_format($order->total_amount, 2) }}</p>
        <p>Status: {{ $order->status }}</p>
        <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>

        <h4 class="mt-4">Items in your Order:</h4>
        <ul>
            @foreach ($order->orderItems as $orderItem)
                <li>{{ $orderItem->product->name }} (x{{ $orderItem->quantity }}) - AUD ${{ number_format($orderItem->price_at_time_of_order, 2) }}</li>
            @endforeach
        </ul>
    </div>
</x-main-layout>

