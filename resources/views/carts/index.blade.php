<x-main-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-indigo-900 to-purple-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Your Cart</h1>
        </div>
    </div>

    <!-- Cart Items -->
    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col">
            @forelse($cartItems as $cartItem)
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $cartItem->product->image_url) }}" alt="{{ $cartItem->product->name }}"
                             class="object-contain w-20 h-20 rounded">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-800">{{ $cartItem->product->name }}</h3>
                            <p class="text-sm text-gray-600">AUD $ {{ number_format($cartItem->price_at_time_of_addition, 2) }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $cartItem->quantity }}</p>

                            <!-- Additional Product Info (optional) -->
                            {{-- <p class="text-sm text-gray-600">{{ $cartItem->product->size ? 'Size: ' . $cartItem->product->size : '' }}</p>
                            <p class="text-sm text-gray-600">{{ $cartItem->product->color ? 'Color: ' . $cartItem->product->color : '' }}</p>
                            <p class="text-sm text-gray-600">{{ $cartItem->product->brand ? 'Brand: ' . $cartItem->product->brand : '' }}</p> --}}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="font-medium text-indigo-600">AUD $ {{ number_format($cartItem->price_at_time_of_addition * $cartItem->quantity, 2) }}</p>
                        <a href="{{ route('cart.remove', $cartItem->id) }}" class="ml-4 text-red-500 cursor-pointer hover:text-red-700" aria-label="Remove from cart">
                            @csrf
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <p>Your cart is empty.</p>
            @endforelse
        </div>

        <!-- Cart Total -->
        @if($cartItems->isNotEmpty())  <!-- This works on collections -->
        <div class="flex justify-between mt-8 font-semibold">
            <p>Total:</p>
            <p>AUD $ {{ number_format($total, 2) }}</p>
        </div>

        <!-- Checkout Button -->
        <div class="flex justify-end mt-6">
            <a href="{{ route('checkout.index') }}" class="flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l1 5h13l1-5h2M3 3l1 5m-1-5h18l-1 5H7m6 4h2l3 9H8l3-9zm0 0l3-4-3 4zm-3-4h6m-6 0l-3 4" />
                </svg>
                Proceed to Checkout
            </a>
        </div>
        @endif

    </div>
</x-main-layout>
