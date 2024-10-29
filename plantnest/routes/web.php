<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OrderController; // Import OrderController
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderTrackingController;
use Illuminate\Http\Request; // Import Request for the route closure

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop/Products Routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{category}/{type}/{product}', [ShopController::class, 'show'])->name('shop.show');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Feedback Routes
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

// Static Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/thank-you', function (Request $request) {
    return view('checkout.thank-you', ['orderNumber' => $request->query('orderNumber')]);
})->name('checkout.thank-you');

Route::post('reviews/{productId}', [ReviewController::class, 'store'])->name('reviews.store');

// Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Dashboard Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.admindashboard');
})->middleware(['auth', 'verified', 'user'])->name('admin.dashboard');

// User Management
Route::middleware(['auth', 'verified', 'user'])->prefix('admin')->group(function () {
    Route::get('dashboard/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('dashboard/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::get('/track-order', [OrderTrackingController::class, 'showTrackOrderForm'])->name('track.order.form');
Route::post('/track-order', [OrderTrackingController::class, 'trackOrder'])->name('track.order');

// Order Details Page
Route::get('/track-order/{orderNumber}', [OrderTrackingController::class, 'showOrderDetails'])->name('track.order.details');

// Order Deletion
Route::delete('/track-order/{orderNumber}', [OrderTrackingController::class, 'destroy'])->name('track.order.destroy');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category CRUD
Route::middleware(['auth', 'verified', 'user'])->prefix('admin')->group(function () {
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Product CRUD
Route::middleware(['auth', 'verified', 'user'])->prefix('admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'user'])->group(function () {
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{orderNumber}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{orderNumber}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/orders/{orderNumber}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{orderNumber}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('admin.customers.show');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});

// Authentication Routes
require __DIR__.'/auth.php';
