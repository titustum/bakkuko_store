<x-main-layout>
    <!-- Hero Section -->
    <div class="relative bg-indigo-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">All Products</h1>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-900">All Products</h2>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <div class="relative flex flex-col group">
                    <div class="overflow-hidden transition-transform duration-300 bg-gray-100 border border-gray-200 rounded-lg aspect-w-1 aspect-h-1 group-hover:scale-105">
                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                 class="object-contain bg-white object-center w-full h-[300px]" />
                        </a>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-800">{{ $product->name }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $product->category->name }}</p>
                            <p class="mt-1 text-sm font-medium text-indigo-600">AUD $ {{ $product->price }}</p>
                        </div>
                        <button
                            class="p-1.5 text-gray-400 transition-colors duration-300 ease-in-out hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 rounded-full"
                            aria-label="Add to favorites">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </button>
                    </div>

                    <form method="post" action="{{ route('cart.add', $product->id) }}" class="flex pt-3 mt-auto">
                        @csrf
                        <button
                            class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-300 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-opacity-50 active:bg-indigo-800">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Add to Cart
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</x-main-layout>
