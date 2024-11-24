<x-main-layout>
    <!-- Hero Section -->
    <div class="relative bg-indigo-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                Shop by Category
            </h1>
            <p class="mt-4 text-lg text-gray-300">Browse through our wide range of categories to find what you're looking for.</p>
        </div>
    </div>

    <!-- Categories List -->
    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            @foreach($categories as $category)
                <div class="flex flex-col items-center p-6 bg-white border rounded-lg shadow-sm hover:shadow-lg">
                    <img src="{{ asset('uploads/' . $category->image_url) }}" alt="{{ $category->name }}" class="object-cover w-full h-48 mb-4 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                    <div class="mt-4">
                        <a href="{{ route('category.show', $category->id) }}" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                            View Products
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-main-layout>
