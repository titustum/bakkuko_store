<x-main-layout>
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900">Your Favorite Products</h1>

        @if($favorites->isEmpty())
            <p class="mt-4 text-lg text-gray-600">You have no favorite products yet.</p>
        @else
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($favorites as $favorite)
                    <div class="p-4 bg-white border rounded-lg">
                        <img src="{{ asset('uploads/' . $favorite->product->image_url) }}" alt="{{ $favorite->product->name }}" class="object-cover w-full h-64 mb-4 rounded-lg">
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