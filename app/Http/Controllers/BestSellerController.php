<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BestSellerController extends Controller
{
    public function bestSeller(){
        return view('user.best-seller');
    }
}
