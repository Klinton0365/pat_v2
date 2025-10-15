<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class BestSellerController extends Controller
{
    public function bestSeller(){

        $categories = Category::withCount('products')
            // ->where('status', 'active')
            ->get();

        return view('user.best-seller', compact('categories'));
    }
}
