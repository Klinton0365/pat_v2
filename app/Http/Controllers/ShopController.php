<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FestivalOffer;
use App\Models\Product;

class ShopController extends Controller
{
    public function shop()
    {
        $products = Product::with('category')->where('is_published', 1)->get();
        $categories = Category::withCount('products')->get();

        // Get featured products
        $featuredProducts = Product::where('featured', 1)
            ->where('is_published', 1)
            ->limit(3)
            ->get();

        // Get price range
        $minPrice = Product::where('is_published', 1)->min('price');
        $maxPrice = Product::where('is_published', 1)->max('price');

        $amountOffer = FestivalOffer::with('product')
            ->where('is_percentage', 0)
            ->where('status', 1)
            ->first();

        $percentageOffer = FestivalOffer::with('product')
            ->where('is_percentage', 1)
            ->where('status', 1)
            ->first();

        return view('user.shop', compact(
            'categories',
            'products',
            'featuredProducts',
            'minPrice',
            'maxPrice',
            'amountOffer',
            'percentageOffer'
        ));
    }

    public function show($id, $slug)
    {
        $product = Product::with('category')->findOrFail($id);

        // Redirect if slug doesn't match (for SEO)
        if ($product->slug !== $slug) {
            return redirect()->route('product.show', [$product->id, $product->slug], 301);
        }

        // Increment product views
        $product->increment('views');

        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_published', 1)
            ->where('stock', '>', 0)
            ->limit(6)
            ->get();

        // Get all categories for sidebar
        $categories = Category::withCount('products')
            // ->where('status', 'active')
            ->get();

        // Get featured products for sidebar
        $featuredProducts = Product::where('featured', 1)
            ->where('is_published', 1)
            ->where('id', '!=', $product->id)
            ->limit(6)
            ->get();

        // Get product tags
        $productTags = ['New', 'Brand', 'Sale', 'Hot', 'Featured', 'Trending'];

        return view('user.single', compact(
            'product',
            'relatedProducts',
            'categories',
            'featuredProducts',
            'productTags'
        ));
    }

    public function checkout()
    {
        return view('user.checkout');
    }
}
