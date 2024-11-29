<x-main-layout>
    <!-- Hero Section with Modern Layout and Animation -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 to-purple-900">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>

        <div class="relative px-4 py-24 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <div class="relative z-10">
                <!-- Animated Text Reveal -->
                <div class="inline-block mb-6">
                    <span class="text-4xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-indigo-400 to-purple-500 sm:text-5xl md:text-6xl animate-text-reveal">
                        Discover African Fashion
                    </span>
                </div>

                <p class="max-w-3xl mx-auto mt-6 text-xl leading-relaxed text-indigo-100 animate-fade-in">
                    Embark on a journey through our curated collection of authentic African clothing and accessories that tell a story of tradition, craftsmanship, and cultural heritage.
                </p>

                <div class="grid justify-center gap-3 mt-10 md:flex md:space-x-4">
                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center px-8 py-3 font-semibold text-indigo-600 transition-all duration-300 ease-in-out transform bg-white rounded-full shadow-lg hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:-translate-y-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Shop Now
                    </a>

                    <a
                        href="{{ route('about') }}"
                        class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all duration-300 ease-in-out transform border-2 border-white rounded-full hover:bg-white hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 hover:-translate-y-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Subtle Background Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-purple-700 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 bg-indigo-600 rounded-full w-72 h-72 opacity-10 blur-3xl"></div>
    </div>

    <!-- Optional: Custom CSS for Animations -->
    <style>
        @keyframes text-reveal {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .animate-text-reveal {
            animation: text-reveal 1s ease-out;
        }

        .animate-fade-in {
            animation: fade-in 1.2s ease-out;
        }

        .bg-pattern {
            background-image:
                linear-gradient(45deg, rgba(255,255,255,0.05) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(255,255,255,0.05) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(255,255,255,0.05) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(255,255,255,0.05) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }
    </style>

    <!-- Categories  -->
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Shop by Category</h2>
            <a href="{{ route('categories.index') }}" class="text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                View All Categories
                <span aria-hidden="true"> →</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($categories as $category)
                <a href="{{ route('category.show', $category->id) }}" class="group">
                    <div class="relative p-6 overflow-hidden transition-all duration-300 border border-gray-200 rounded-lg bg-gray-50 group-hover:bg-white group-hover:shadow-lg group-hover:border-indigo-100">
                        <!-- Category Image -->
                        <div class="hidden mb-4 md:block">
                            @if ($category->image_url)
                                <img src="{{ asset('storage/'. $category->image_url) }}" alt="{{ $category->name }}" class="object-contain w-full h-48 rounded-lg">
                            @else
                                <div class="flex items-center justify-center w-full h-48 text-gray-500 bg-gray-200 rounded-lg">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- Category Info -->
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 transition-colors group-hover:text-indigo-600">
                                    {{ $category->name }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $category->products_count }}+ items</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 transition-transform duration-300 group-hover:text-indigo-600 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500">No categories available.</p>
            @endforelse
        </div>
    </div>


    <!-- Featured Products -->
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Featured Products</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                View All Products
                <span aria-hidden="true"> →</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($products as $product)
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
                <p class="text-gray-500">No featured products available.</p>
            @endforelse
        </div>

    </div>

</x-main-layout>
