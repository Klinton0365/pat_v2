<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceRequestController;
use App\Http\Controllers\Admin\AdminTechnicianController;
use App\Http\Controllers\Admin\FestivalOfferController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\CheckoutController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceBookingController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');


Route::get('/shop', [ShopController::class, 'shop'])->name('shop');

// Route::get('/product/{slug}', [ShopController::class, 'shop'])->name('product.show');

Route::get('/product/{id}/{slug}', [ShopController::class, 'show'])->name('product.show');

Route::get('/single-product', [HomeController::class, 'single'])->name('single-product');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best-seller');


Route::get('/services', [ServiceBookingController::class, 'index'])->name('services');
Route::post('/service-book', [ServiceBookingController::class, 'store'])->name('service.book');



// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
Route::middleware(['auth.ensure', 'auth:sanctum', 'verified'])->group(function () {

    Route::get('/cart', [CartController::class, 'cart'])->name('cart');

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('orders', OrderController::class);
    Route::resource('services', ServiceController::class);

    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    // Route::get('/cart', [CartController::class, 'cart'])->name('cart');
});



// Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
    Route::post('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
// });


// ADMIN
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('inventories', AdminInventoryController::class);
    Route::resource('service-requests', AdminServiceRequestController::class);
    Route::resource('festival-offers',FestivalOfferController::class)->names('admin.festival-offers');

    Route::get('/admin/get-product-details/{id}', [AdminProductController::class, 'getProductDetails'])->name('admin.getProductDetails');

    Route::get('/user-details', [AdminProductController::class, 'userDetails'])->name('admin.user.details');

    Route::resource('customers', AdminUserController::class)->names('admin.customers');
    Route::resource('technicians', AdminTechnicianController::class)->names('admin.technicians');
});

// Admin Panel
// Route::prefix('admin')->middleware('auth', 'is_admin')->group(function () {
//     Route::resource('categories', Admin\CategoryController::class);
//     Route::resource('products', Admin\ProductController::class);
//     Route::resource('orders', Admin\OrderController::class);
//     Route::resource('inventories', Admin\InventoryController::class);
//     Route::resource('service-requests', Admin\ServiceRequestController::class);
// });

// User Panel
Route::prefix('user')->middleware('auth')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('services', ServiceController::class);
});
