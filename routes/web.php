<?php

use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/single-product', [HomeController::class, 'single'])->name('single-product');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/best-seller', [BestSellerController::class, 'bestSeller'])->name('best-seller');
