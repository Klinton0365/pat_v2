<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('user.cart', compact('cartItems', 'categories'));
    }

    public function addToCart($product_id)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart',
                    'redirect' => route('login')
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Please login to add items to cart');
        }

        Log::info('ADD TO CART (GET): ', ['product_id' => $product_id]);

        $product = Product::findOrFail($product_id);

        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        $cartItem->quantity = ($cartItem->exists ? $cartItem->quantity + 1 : 1);
        $cartItem->price = $product->price;
        $cartItem->save();

        // Return JSON for AJAX requests
        if (request()->ajax() || request()->wantsJson()) {
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    // Update cart quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        // Check stock availability
        if ($request->quantity > $cart->product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Requested quantity exceeds available stock'
            ], 400);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'data' => $cart
        ]);
    }

    // Remove item from cart
    public function remove($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully'
        ]);
    }

    // Apply coupon
    public function applyCoupon(Request $request)
    {
        try {
            Log::info('Applying coupon', ['code' => $request->code]);

            $request->validate([
                'code' => 'required|string',
            ]);

            $coupon = Coupon::where('code', strtoupper($request->code))
                ->where('is_active', true)
                ->first();

            Log::info('Coupon found', ['coupon' => $coupon]);

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code'
                ]);
            }

            // Check if coupon is expired
            $today = now();

            if ($coupon->end_date && $today->gt($coupon->end_date)) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon has expired'
                ]);
            }

            // Check usage limit (make sure usage_count column exists)
            if ($coupon->usage_limit) {
                $usageCount = $coupon->usage_count ?? 0;
                if ($usageCount >= $coupon->usage_limit) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This coupon has reached its usage limit'
                    ]);
                }
            }

            // Store coupon in session
            session(['applied_coupon' => [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => floatval($coupon->value),
            ]]);

            Log::info('Coupon applied successfully', ['coupon' => $coupon->code]);

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully!',
                'coupon' => [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => floatval($coupon->value),
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Coupon application error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while applying the coupon: ' . $e->getMessage()
            ], 500);
        }
    }

    // Prepare checkout
    public function prepareCheckout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*' => 'exists:carts,id',
            'coupon' => 'nullable|string',
        ]);

        // Verify all items belong to the user
        $cartItems = Cart::whereIn('id', $request->items)
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->count() !== count($request->items)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid cart items'
            ], 400);
        }

        // Check stock availability for all items
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient stock for {$item->product->name}"
                ], 400);
            }
        }

        // Store selected items and coupon in session
        session([
            'checkout_items' => $request->items,
            'checkout_coupon' => $request->coupon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ready to checkout'
        ]);
    }

    // Get cart count (for header)
    public function count()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    // Clear cart
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }

    // public function remove($id)
    // {
    //     Cart::where('id', $id)->where('user_id', Auth::id())->delete();

    //     return redirect()->back()->with('success', 'Item removed from cart');
    // }

    // public function clear()
    // {
    //     Cart::where('user_id', Auth::id())->delete();

    //     return redirect()->back()->with('success', 'Cart cleared');
    // }
}
