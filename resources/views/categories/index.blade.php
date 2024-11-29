<x-main-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 to-purple-900">
        <div class="px-4 py-16 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                Shop by Category
            </h1>
            <p class="mt-4 text-lg text-gray-300">Browse through our wide range of categories to find what you're looking for.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <!-- Categories List -->
    <div class="px-4 py-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">


            @forelse ($categories as $category)
                <a href="{{ route('category.show', $category->id) }}" class="group">
                    <div class="relative p-6 overflow-hidden transition-all duration-300 border border-gray-200 rounded-lg bg-gray-50 group-hover:bg-white group-hover:shadow-lg group-hover:border-indigo-100">
                        <!-- Category Image -->
                        <div class="mb-4">
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
</x-main-layout>
