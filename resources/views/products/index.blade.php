<x-main-layout>
    <!-- Hero Section with Subtle Animation -->
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-900 to-purple-900">
        <div class="relative z-10 px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl animate-fade-in">
                Explore Our Collection
            </h1>
            <p class="mt-4 text-xl text-indigo-200 animate-fade-in-delay">
                Discover Authentic African Fashion
            </p>
        </div>
    </div>

    <!-- Products Section with Filtering -->
    <div class="py-12 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                <!-- Filters Sidebar -->
                <div class="sticky p-6 bg-white shadow-lg lg:col-span-1 rounded-xl h-fit top-6">
                    <form id="product-filters" method="GET" action="{{ route('products.index') }}">
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Categories</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input
                                            type="checkbox"
                                            id="category-{{ $category->id }}"
                                            name="categories[]"
                                            value="{{ $category->id }}"
                                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                        >
                                        <label
                                            for="category-{{ $category->id }}"
                                            class="block ml-3 text-sm text-gray-700"
                                        >
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Price Range</h3>
                            <div class="space-y-2">
                                <div class="flex items-center space-x-3">
                                    <input
                                        type="number"
                                        name="min_price"
                                        placeholder="Min"
                                        value="{{ request('min_price') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    >
                                    <span class="text-gray-500">to</span>
                                    <input
                                        type="number"
                                        name="max_price"
                                        placeholder="Max"
                                        value="{{ request('max_price') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Predefined Price Ranges -->
                        <div class="mb-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900">Quick Price Filters</h3>
                            <div class="space-y-2">
                                @php
                                    $priceRanges = [
                                        ['label' => 'Under $50', 'min' => 0, 'max' => 50],
                                        ['label' => '$50 - $100', 'min' => 50, 'max' => 100],
                                        ['label' => '$100 - $250', 'min' => 100, 'max' => 250],
                                        ['label' => 'Over $250', 'min' => 250, 'max' => '']
                                    ];
                                @endphp
                                @foreach($priceRanges as $range)
                                    <div class="flex items-center">
                                        <input
                                            type="radio"
                                            id="price-range-{{ $loop->index }}"
                                            name="price_range"
                                            value="{{ $range['min'] }}-{{ $range['max'] }}"
                                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                            {{ request('price_range') === $range['min'] . '-' . $range['max'] ? 'checked' : '' }}
                                        >
                                        <label
                                            for="price-range-{{ $loop->index }}"
                                            class="block ml-3 text-sm text-gray-700"
                                        >
                                            {{ $range['label'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex space-x-2">
                            <button
                                type="submit"
                                class="w-full py-2 text-white transition duration-300 bg-indigo-600 rounded-md hover:bg-indigo-700"
                            >
                                Apply Filters
                            </button>
                            <a
                                href="{{ route('products.index') }}"
                                class="w-full py-2 text-center text-gray-800 transition duration-300 bg-gray-200 rounded-md hover:bg-gray-300"
                            >
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="lg:col-span-3">
                    <!-- Sort Options -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-gray-600">
                            Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} products
                        </div>
                        <div>
                            <select
                                id="sort-select"
                                name="sort"
                                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md form-select focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                onchange="this.form.submit()"
                            >
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                    Newest Arrivals
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                        @forelse($products as $product)
                            <div class="overflow-hidden transition duration-300 transform bg-white shadow-lg rounded-xl hover:scale-105 hover:shadow-xl">
                                <a href="{{ route('product.show', $product->id) }}" class="relative">
                                    <img
                                        src="{{ asset('storage/'.$product->image_url) }}"
                                        alt="{{ $product->name }}"
                                        class="object-contain w-full h-64"
                                    >
                                    @if($product->is_new)
                                        <span class="absolute px-2 py-1 text-xs text-white bg-green-500 rounded-full top-4 right-4">
                                            New
                                        </span>
                                    @endif
                                </a>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="mb-2 text-sm text-gray-500">
                                        {{ $product->category->name }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-indigo-600">
                                            AUD ${{ number_format($product->price, 2) }}
                                        </span>
                                        <form action="{{
                                            Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists()
                                            ? route('favorites.destroy', $product->id)
                                            : route('favorites.store', $product->id) }}" method="POST">

                                            @csrf
                                            @if(Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists())
                                                @method('DELETE') <!-- Use DELETE method for removing from favorites -->
                                            @endif

                                            <button type="submit"
                                                class="p-1.5 transition-colors duration-300 ease-in-out
                                                {{ Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'text-red-600 bg-red-100' : 'text-gray-400 bg-transparent' }}
                                                hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 rounded-full"
                                                aria-label="{{ Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Remove from favorites' : 'Add to favorites' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'fill-red-500' : 'fill-none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg>
                                            </button>

                                        </form>
                                    </div>

                                    <!-- Average Rating Display -->
                                    <div class="mt-4">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $i <= $product->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 15l-6.16 3.243L5.31 12.9 0 8.686l7.47-.645L10 2l2.53 5.041L20 8.686l-5.31 4.214 1.47 5.343L10 15z" />
                                                </svg>
                                            @endfor
                                            <span class="ml-2">({{ $product->reviews->count() }} reviews)</span>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
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


                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center bg-white shadow-lg col-span-full rounded-xl">
                                <p class="text-xl text-gray-600">
                                    No products found matching your filters.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animations and Styling -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in-delay {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }

        .animate-fade-in-delay {
            animation: fade-in-delay 1s ease-out 0.3s backwards;
        }
    </style>
</x-main-layout>
