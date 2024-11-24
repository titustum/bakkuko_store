<x-main-layout>
<div class="container">
    <h2>Create New Category</h2>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Category Name -->
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Category Image URL (Optional) -->
        <div class="form-group">
            <label for="image_url">Category Image URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>
</x-main-layout>
