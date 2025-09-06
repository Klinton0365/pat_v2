<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/Register', [AuthController::class, 'register'])->name('Register');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');

Route::get('/single-product', [HomeController::class, 'single'])->name('single-product');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best-seller');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
});




// ADMIN
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});