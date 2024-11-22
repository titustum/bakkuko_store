<x-main-layout>
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-2xl font-extrabold text-gray-900 lg:text-4xl">Your Favorite Products</h1>

        @if($favorites->isEmpty())
            <p class="mt-4 text-lg text-gray-600">You have no favorite products yet.</p>
        @else
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($favorites as $favorite)
                    <div class="p-4 bg-white border rounded-lg">
                         <a href="{{ route('product.show', $favorite->product->id) }}">
                                <img src="{{ asset('storage/' .$favorite->product->image_url) }}" alt="{{ $favorite->product->name }}"
                                     class="object-contain bg-white object-center w-full h-[300px]" />
                        </a>
                        <h3 class="text-lg font-medium text-gray-800">{{ $favorite->product->name }}</h3>
                        <p class="text-sm text-gray-600">AUD $ {{ number_format($favorite->product->price, 2) }}</p>
                        <form action="{{ route('favorites.destroy', $favorite->product->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Remove from Favorites</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-main-layout>
