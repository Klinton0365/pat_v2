<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function shop()
    {
        return view('user.shop');
    }

    // public function show($id, $slug)
    // {
    //     // dd($id, $slug);
    //     $product = Product::with('category')->findOrFail($id);
    //     // dd($product);
    //     // Optional: redirect if slug in URL doesn't match DB slug (for SEO)
    //     $categories = Category::all(); // Get all categories
        
    //     if ($product->slug !== $slug) {
    //         // dd('hjsgdfyis');
    //         return redirect()->route('product.show', [$product->id, $product->slug]);
    //     }

    //     // dd('sjdihfius');
    //     return view('user.single', compact('product', 'categories'));
    // }

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
