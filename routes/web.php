<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('category.show');

//Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{productId}', [ProductController::class, 'show'])->name('product.show');
// Show the product creation form
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Store the newly created product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

//cart routes
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
// Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Submit a review for a product
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


//Carts

// View cart page
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Add product to cart
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
// Remove a cart item
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/items/count', [CartController::class, 'cartItemsCount'])->name('cart.items.count');

// Checkouts
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Checkout process route (this would handle the form submission)
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
//success message after successful payment
Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');


require __DIR__.'/auth.php';
