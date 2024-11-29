<x-main-layout>
    <!-- Hero Section with Animated Checkmark -->
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-900 to-purple-900">
        <div class="relative px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <!-- Animated Checkmark -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center justify-center w-24 h-24 bg-green-500 rounded-full animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                Order Confirmed
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-indigo-200">
                Thank you for your purchase! Your order has been successfully processed and is being prepared.
            </p>
        </div>
    </div>

    <!-- Order Details Section with Enhanced Layout -->
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8 bg-gray-50">
        <div class="grid gap-8 md:grid-cols-2">
            <!-- Order Summary Card -->
            <div class="p-6 bg-white border-t-4 border-indigo-600 shadow-2xl rounded-xl">
                <h3 class="mb-4 text-2xl font-bold text-gray-900">Order Summary</h3>

                <div class="space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b">
                        <span class="text-gray-600">Order ID</span>
                        <span class="font-semibold text-indigo-600">{{ $order->id }}</span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="
                            px-3 py-1 rounded-full text-sm font-medium
                            @if($order->status == 'completed')
                                bg-green-100 text-green-800
                            @elseif($order->status == 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'failed')
                                bg-red-100 text-red-800
                            @else
                                bg-gray-100 text-gray-800
                            @endif
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between pb-2 border-b">
                        <span class="text-gray-600">Total Amount</span>
                        <span class="font-bold text-gray-900">
                            AUD ${{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Payment ID</span>
                        <span class="text-indigo-600 truncate max-w-[200px]">
                            {{ $order->payment_intent_id }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Next Steps & Additional Information -->
            <div class="p-6 bg-white border-t-4 border-green-500 shadow-2xl rounded-xl">
                <h3 class="mb-4 text-2xl font-bold text-gray-900">What's Next?</h3>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-600">
                            We've sent a confirmation email to your registered email address.
                        </p>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-600">
                            Estimated delivery: {{ now()->addDays(3)->format('D, M d') }}
                        </p>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2v-5l-3-3-3 3-3-5z" />
                        </svg>
                        <p class="text-gray-600">
                            Track your order in the customer portal.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center mt-10 space-x-4">
            <a href="#" class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition duration-300 bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Track Order
            </a>

            <a href="{{ route('welcome') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-indigo-700 transition duration-300 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Return Home
            </a>
        </div>
    </div>
</x-main-layout>
