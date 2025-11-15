<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function terms()
    {
        return view('user.terms');
    }

    public function privacy()
    {
        return view('user.privacy');
    }

    public function faq()
    {
        return view('user.faq');
    }
}
