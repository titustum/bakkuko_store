<x-main-layout>
    <div class="container px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-4 text-2xl font-semibold">Upload New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01"
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="image_url" id="image_url" accept="image/*"
                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('image_url')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand -->
            <div>
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                @error('brand')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Color -->
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                <input type="text" name="color" id="color" value="{{ old('color') }}" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                @error('color')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Material -->
            <div>
                <label for="material" class="block text-sm font-medium text-gray-700">Material</label>
                <input type="text" name="material" id="material" value="{{ old('material') }}" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                @error('material')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Size -->
            <div>
                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                <input type="text" name="size" id="size" value="{{ old('size') }}" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                @error('size')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fit (For clothing) -->
            <div>
                <label for="fit" class="block text-sm font-medium text-gray-700">Fit</label>
                <input type="text" name="fit" id="fit" value="{{ old('fit') }}" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                @error('fit')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Shoe Type (For shoes only) -->
            <div>
                <label for="shoe_type" class="block text-sm font-medium text-gray-700">Shoe Type</label>
                <select name="shoe_type" id="shoe_type" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Shoe Type</option>
                    <option value="sneakers" {{ old('shoe_type') == 'sneakers' ? 'selected' : '' }}>Sneakers</option>
                    <option value="boots" {{ old('shoe_type') == 'boots' ? 'selected' : '' }}>Boots</option>
                    <option value="sandals" {{ old('shoe_type') == 'sandals' ? 'selected' : '' }}>Sandals</option>
                    <option value="formal" {{ old('shoe_type') == 'formal' ? 'selected' : '' }}>Formal</option>
                    <option value="other" {{ old('shoe_type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('shoe_type')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Availability -->
            <div>
                <label for="is_available" class="block text-sm font-medium text-gray-700">Available</label>
                <input type="checkbox" name="is_available" id="is_available" {{ old('is_available') ? 'checked' : '' }}
                    class="mt-1">
                @error('is_available')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    Upload Product
                </button>
            </div>
        </form>
    </div>
</x-main-layout>
