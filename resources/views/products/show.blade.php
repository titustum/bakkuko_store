<x-main-layout>
    <!-- Single Product Page -->
    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Product Image -->
            <div class="relative">
                <div class="overflow-hidden bg-gray-100 border border-gray-200 rounded-lg">
                    <img
                        src="{{ asset('storage/' . $product->image_url) }}"
                        alt="{{ $product->name }}"
                        class="object-contain object-center w-full h-[300px] md:h-[600px] bg-white"
                    />
                </div>
            </div>

            <!-- Product Details -->
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 md:text-2xl">{{ $product->name }}</h2>
                    <p class="mt-2 italic text-gray-600 md:text-lg">{{ $product->category->name }}</p>
                    <p class="mt-4 text-lg font-medium text-indigo-600 md:text-xl">AUD ${{ $product->price }}</p>
                    <p class="mt-2 text-sm text-gray-700 lg:text-base">{{ $product->description }}</p>

                    <hr class="my-2">

                    <!-- Product Attributes (New Fields) -->
                    @if($product->brand)
                        <p class="mt-2 text-sm text-gray-600">Brand: {{ $product->brand }}</p>
                    @endif
                    @if($product->color)
                        <p class="mt-2 text-sm text-gray-600">Color: {{ $product->color }}</p>
                    @endif
                    @if($product->material)
                        <p class="mt-2 text-sm text-gray-600">Material: {{ $product->material }}</p>
                    @endif
                    @if($product->size)
                        <p class="mt-2 text-sm text-gray-600">Size: {{ $product->size }}</p>
                    @endif
                    @if($product->fit)
                        <p class="mt-2 text-sm text-gray-600">Fit: {{ $product->fit }}</p>
                    @endif
                    @if($product->shoe_type)
                        <p class="mt-2 text-sm text-gray-600">Shoe Type: {{ ucfirst($product->shoe_type) }}</p>
                    @endif

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

                    <!-- Add to Cart Button -->
                    <div class="mt-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="my-2 flex items-center space-x-2">
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" value="1">
                            </div>

                            <button
                                type="submit"
                                class="flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-300 bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-opacity-50 active:bg-indigo-800"
                            >
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-900">Customer Reviews</h3>

                    @if(session('success'))
                        <div class="p-4 text-white bg-green-500 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        @foreach ($product->reviews as $review)
                            <div class="p-4 mb-4 border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-md">{{ $review->user->name }}</h4>
                                <p class="mt-1 text-sm text-gray-600">Rating: {{ $review->rating }} / 5</p>
                                <p class="mt-2 text-gray-700">{{ $review->review }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Review Form -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-gray-900">Leave a Review</h4>
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                            @csrf
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700" for="review">Your Review</label>
                                <textarea id="review" name="review" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>
                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700" for="rating">Rating</label>
                                <select id="rating" name="rating" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
