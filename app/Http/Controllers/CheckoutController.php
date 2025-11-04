<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);
        return view('user.checkout', compact('cartItems', 'total'));
    }

    public function processPayment(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => Str::uuid(),
            'amount' => $total * 100, // Amount in paise
            'currency' => 'INR'
        ]);

        $orderData = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $order->id,
            'total_amount' => $total,
            'payment_status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderData->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        return view('user.razorpay', compact('order', 'total'));
    }

    public function paymentSuccess(Request $request)
    {
        $order = Order::where('order_number', $request->razorpay_order_id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'paid',
                'razorpay_payment_id' => $request->razorpay_payment_id
            ]);

            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('thankyou')->with('success', 'Payment Successful!');
        }

        return redirect()->route('checkout')->with('error', 'Payment Failed!');
    }
}
