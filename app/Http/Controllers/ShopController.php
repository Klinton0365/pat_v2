<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function shop()
    {
        return view('user.shop');
    }

    public function show($id)
    {
        // dd($id, $slug);
        $product = Product::with('category')->findOrFail($id);
        // dd($product);
        // Optional: redirect if slug in URL doesn't match DB slug (for SEO)
        
        // if ($product->slug !== $slug) {
        //     dd('hjsgdfyis');
        //     return redirect()->route('product.show', [$product->id, $product->slug]);
        // }

        // dd('sjdihfius');
        return view('user.single', compact('product'));
    }

    public function checkout()
    {
        return view('user.checkout');
    }
}
