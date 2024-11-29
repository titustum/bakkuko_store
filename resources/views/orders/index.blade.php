<x-main-layout>

    <!-- Orders List -->
    <div class="mt-6">
        <h2 class="text-xl font-bold">Your Orders</h2>
        <ul class="mt-4">
            @foreach ($orders as $order)
                <li class="py-2 border-b">
                    <a href="{{ route('orders.show', $order->id) }}">
                        Order #{{ $order->id }} - Total: AUD ${{ number_format($order->total_amount, 2) }} - Status: {{ $order->status }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-main-layout>
