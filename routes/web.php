<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('category.show');

//Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{productId}', [ProductController::class, 'show'])->name('product.show');



Route::middleware('auth')->group(function () {

    // Show the product creation form
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    // Store the newly created product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

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





    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

});


require __DIR__.'/auth.php';
