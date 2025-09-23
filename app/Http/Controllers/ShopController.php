<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){
        return view('user.shop');
    }

     public function show($id, $slug)
{
    $product = Product::with('category')->findOrFail($id);

    // Optional: redirect if slug in URL doesn't match DB slug (for SEO)
    if ($product->slug !== $slug) {
        return redirect()->route('product.show', [$product->id, $product->slug]);
    }

    return view('user.single', compact('product'));
}

    public function checkout(){
        return view('user.checkout');
    }
}
