<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all categories with the count of associated products
        $categories = Category::withCount('products')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the products in a specific category.
     *
     * @param  int  $categoryId
     * @return \Illuminate\View\View
     */
    public function show($categoryId)
    {
        // Fetch the category with its associated products
        $category = Category::with('products')->findOrFail($categoryId);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image
        ]);

        // Handle image upload
        if ($request->hasFile('image_url')) {
            // Store the image and get the file path
            $imagePath = $request->file('image_url')->store('categories', 'public');
        } else {
            $imagePath = null; // No image uploaded
        }

        // Create the category and save it to the database
        Category::create([
            'name' => $validated['name'],
            'image_url' => $imagePath,  // Store the file path in the database
        ]);

        // Redirect to the categories index or wherever you want with success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }
}
