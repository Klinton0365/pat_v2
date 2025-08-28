<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){
        return view('user.shop');
    }

    public function checkout(){
        return view('user.checkout');
    }
}
