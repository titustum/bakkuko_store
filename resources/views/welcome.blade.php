<x-main-layout>

    <!-- Hero Section -->
    <div class="relative bg-indigo-900">
        <div class="px-4 py-24 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">Discover African Fashion</h1>
            <p class="max-w-2xl mx-auto mt-6 text-xl text-indigo-200">Explore our collection of authentic African clothing and accessories.</p>
            <div class="mt-10">
                <a href="{{ route('products.index') }}" class="px-8 py-3 font-medium text-indigo-600 transition-colors bg-white rounded-md hover:bg-indigo-50">Shop Now</a>
            </div>
        </div>
    </div>

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

                    <!-- Check if the product is already in the favorites -->
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
            @empty
                <p class="text-gray-500">No featured products available.</p>
            @endforelse
        </div>

    </div>

</x-main-layout>
