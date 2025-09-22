<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index(){
    //     $products = Product::with('category')->get();
    //     return view('user.index', compact('products'));
    // }
    public function index(){
    $products = Product::with('category')->get();
    $categories = Category::all(); // Get all categories
    return view('user.index', compact('products', 'categories'));
}

public function productShow(){
    $products = Product::with('category')->get();
    $categories = Category::all(); // Get all categories
    return view('user.index', compact('products', 'categories'));
}

    public function shop(){
        return view('user.shop');
    }

    public function single(){
        // dd('sdfsdf');
        return view('user.single');
    }
    public function contact(){
        return view('user.contact');
    }
}
