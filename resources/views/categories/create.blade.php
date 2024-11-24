<!-- resources/views/categories/create.blade.php -->
<x-main-layout>
    <div class="max-w-3xl p-8 mx-auto mt-10 bg-white rounded-lg shadow-lg">
        <h2 class="mb-6 text-2xl font-semibold text-gray-900">Create a New Category</h2>

        <!-- Display Success or Error Messages -->
        @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="block w-full p-3 mt-1 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Category Image Field -->
            <div class="mb-4">
                <label for="image_url" class="block text-sm font-medium text-gray-700">Category Image</label>
                <input type="file" id="image_url" name="image_url" class="block w-full mt-1 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Create Category
            </button>
        </form>
    </div>
</x-main-layout>
