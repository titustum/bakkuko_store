<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FavoriteController;

use Illuminate\Support\Facades\Route;

// 1. Public Routes (Unprotected)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::view('/about', 'about-us')->name('about');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy');
Route::view('/frequenty-asked-questions', 'faqs')->name('faqs');
Route::view('/terms-of-service', 'terms')->name('terms');
Route::view('/contact-us', 'contact-us')->name('contact');
Route::view('/dashboard1', 'dashboards.index')->name('dashboard1');

// 2. Authentication Routes (Requires login)
Route::middleware('auth')->group(function () {

    // User Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/items/count', [CartController::class, 'cartItemsCount'])->name('cart.items.count');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/success', [CheckoutController::class, 'showSuccessPage'])->name('checkout.showSuccessPage');

    // Order Routes
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

    // Favorite Routes
    Route::post('/favorites/{productId}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{productId}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

// 3. Admin Routes (Protected)
Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Dashboard Route
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Product Management Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/{productId}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Category Management Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

    // Additional Admin Routes (e.g., analytics, settings, etc.)
    // Add any additional routes here as needed

});

// 4. Public Product and Category Routes (Unprotected)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{productId}', [ProductController::class, 'show'])->name('product.show');

// 5. Authentication Routes
require __DIR__.'/auth.php';
