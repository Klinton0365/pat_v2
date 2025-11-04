<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('user.cart', compact('cartItems'));
    }

    // public function addToCart(Request $request)
    // {
    //     $product = Product::findOrFail($request->product_id);

    //     $cartItem = Cart::updateOrCreate(
    //         ['user_id' => Auth::id(), 'product_id' => $product->id],
    //         ['quantity' => \DB::raw('quantity + 1'), 'price' => $product->price]
    //     );

    //     return response()->json(['success' => true, 'message' => 'Product added to cart']);
    // }

    public function addToCart(Request $request)
    {
        \Log::info('ADD TO CAR: ', $request->all());
        $product = Product::findOrFail($request->product_id);

        $cartItem = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['quantity' => \DB::raw('quantity + 1'), 'price' => $product->price]
        );

        return response()->json(['success' => true, 'message' => 'Product added to cart successfully!']);
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Cart cleared');
    }
}
