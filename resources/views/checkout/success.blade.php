<x-main-layout>
    <div class="relative bg-indigo-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Order Successful!</h1>
            <p class="mt-4 text-lg text-white">Thank you for your order. We have received your payment and are processing your order.</p>
        </div>
    </div>

    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800">Order Details</h3>

            <!-- Order summary or details -->
            <div class="mt-4">
                <p class="text-lg text-gray-600">Your order has been successfully placed and your payment was processed. A confirmation email has been sent to you with your order details.</p>

                <!-- You could show more order details here like items, total amount, etc. -->
                <ul class="mt-4 space-y-2">
                    <li class="flex justify-between">
                        <span class="text-gray-700">Order Number:</span>
                        <span class="font-semibold text-indigo-600">{{ session('order_number') }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-700">Total:</span>
                        <span class="font-semibold text-indigo-600">AUD ${{ number_format(session('total_amount'), 2) }}</span>
                    </li>
                </ul>
            </div>

            <!-- Button to continue shopping or go to the homepage -->
            <div class="flex justify-center mt-6 space-x-4">
                <a href="{{ route('home') }}" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Continue Shopping</a>
                <a href="{{ route('cart.index') }}" class="px-4 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700">View Cart</a>
            </div>
        </div>
    </div>
</x-main-layout>
