<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminServiceRequestController;
use App\Http\Controllers\Admin\AdminTechnicianController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\FestivalOfferController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceBookingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Shop & Product
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{id}/{slug}', [ShopController::class, 'show'])->name('product.show');

// Static / Info Pages
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best-seller');

Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('user.terms');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('user.privacy');

Route::get('/faq', [PageController::class, 'faq'])->name('user.faq');

// Services (Public Booking)
Route::get('/services', [ServiceBookingController::class, 'index'])->name('services');
Route::post('/service-book', [ServiceBookingController::class, 'store'])->name('service.book');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
// Route::middleware(['auth.ensure', 'auth:sanctum', 'verified'])->group(function () {
Route::middleware(['auth.ensure'])->group(function () {

    // Profile & Logout
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/add/{product_id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
    Route::post('/cart/prepare-checkout', [CartController::class, 'prepareCheckout'])->name('cart.prepare-checkout');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    // Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
    Route::post('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');

    Route::get('/thankyou', function () {
        return view('user.order.thank-you');
    })->name('thankyou');

    // User Orders & Services
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'dashboardIndex'])->name('user.dashboard');

        // Profile View
        Route::get('/profile', [UserDashboardController::class, 'profileIndex'])->name('user.profile');

        // Profile Update
        Route::post('/profile/update', [UserDashboardController::class, 'profileUpdate'])->name('user.profile.update');

        // Route::resource('orders', OrderController::class)->names('user.orders');
        Route::resource('services', ServiceController::class)->names('user.services');

        // Orders
        Route::get('/orders', [UserDashboardController::class, 'orderIndex'])->name('user.orders.index');
        Route::get('/orders/{order}', [UserDashboardController::class, 'orderShow'])->name('user.orders.show');

        // Services
        Route::get('/services', [UserDashboardController::class, 'serviceIndex'])->name('user.services.index');
        Route::get('/services/{service}', [UserDashboardController::class, 'serviceShow'])->name('user.services.show');
    });
});

Route::get('/check-session', function (Request $request) {
    session(['foo' => 'bar']);

    return session('foo'); // Should return "bar"
})->middleware('web');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // Admin Auth
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    // Protected Admin Area
    Route::middleware(['isAdmin'])->group(function () {

        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Core Management
        Route::resources([
            'categories' => AdminCategoryController::class,
            'products' => AdminProductController::class,
            'orders' => AdminOrderController::class,
            // 'inventories' => AdminInventoryController::class,
            'service-requests' => AdminServiceRequestController::class,
        ]);

        Route::resource('inventories', AdminInventoryController::class);
        Route::get('inventory/logs/{product}', [AdminInventoryController::class, 'logs'])->name('inventories.logs');

        Route::resource('orders', AdminOrderController::class)->names('admin.orders');

        // Named Resources
        Route::resource('festival-offers', FestivalOfferController::class)->names('admin.festival-offers');

        Route::resource('coupons', AdminCouponController::class)->names('admin.coupon');

        Route::resource('customers', AdminUserController::class)->names('admin.customers');
        Route::resource('technicians', AdminTechnicianController::class)->names('admin.technicians');

        Route::resource('services', AdminServiceController::class)->names('admin.services');

        // Extra service actions
        Route::post('services/{service}/assign-technician', [AdminServiceController::class, 'assignTechnician'])
            ->name('services.assignTechnician');

        Route::post('services/{service}/update-status', [AdminServiceController::class, 'updateStatus'])
            ->name('services.updateStatus');

        // Additional Admin Utilities
        Route::get('/get-product-details/{id}', [AdminProductController::class, 'getProductDetails'])->name('admin.getProductDetails');

        Route::get('/user-details', [AdminProductController::class, 'userDetails'])->name('admin.user.details');
    });
});

// =====================================================================================================================
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// // Google Login
// Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Route::get('/shop', [ShopController::class, 'shop'])->name('shop');

// // Route::get('/product/{slug}', [ShopController::class, 'shop'])->name('product.show');

// Route::get('/product/{id}/{slug}', [ShopController::class, 'show'])->name('product.show');

// Route::get('/single-product', [HomeController::class, 'single'])->name('single-product');

// Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
// Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best-seller');

// Route::get('/services', [ServiceBookingController::class, 'index'])->name('services');
// Route::post('/service-book', [ServiceBookingController::class, 'store'])->name('service.book');

// // Route::middleware(['auth:sanctum', 'verified'])->group(function () {
// Route::middleware(['auth.ensure', 'auth:sanctum', 'verified'])->group(function () {

//     Route::get('/cart', [CartController::class, 'cart'])->name('cart');

//     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

//     Route::get('/profile', [AuthController::class, 'profile']);
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     Route::resource('orders', OrderController::class);
//     Route::resource('services', ServiceController::class);

//     Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
//     // Route::get('/cart', [CartController::class, 'cart'])->name('cart');
// });

// // Route::middleware('auth')->group(function () {
//     Route::get('/cart', [CartController::class, 'index'])->name('cart');
//     // Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

//     Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//     Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

//     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
//     Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
//     Route::post('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
// // });

// // ADMIN
// Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

// Route::middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//     Route::resource('categories', AdminCategoryController::class);
//     Route::resource('products', AdminProductController::class);
//     Route::resource('orders', AdminOrderController::class);
//     Route::resource('inventories', AdminInventoryController::class);
//     Route::resource('service-requests', AdminServiceRequestController::class);
//     Route::resource('festival-offers',FestivalOfferController::class)->names('admin.festival-offers');

//     Route::get('/admin/get-product-details/{id}', [AdminProductController::class, 'getProductDetails'])->name('admin.getProductDetails');

//     Route::get('/user-details', [AdminProductController::class, 'userDetails'])->name('admin.user.details');

//     Route::resource('customers', AdminUserController::class)->names('admin.customers');
//     Route::resource('technicians', AdminTechnicianController::class)->names('admin.technicians');
// });

// // User Panel
// Route::prefix('user')->middleware('auth')->group(function () {
//     Route::resource('orders', OrderController::class);
//     Route::resource('services', ServiceController::class);
// });
// ============================================================================================================

// Admin Panel
// Route::prefix('admin')->middleware('auth', 'is_admin')->group(function () {
//     Route::resource('categories', Admin\CategoryController::class);
//     Route::resource('products', Admin\ProductController::class);
//     Route::resource('orders', Admin\OrderController::class);
//     Route::resource('inventories', Admin\InventoryController::class);
//     Route::resource('service-requests', Admin\ServiceRequestController::class);
// });
