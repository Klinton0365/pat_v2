<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = $cartItems->sum(fn ($item) => $item->quantity * $item->price);

        return view('user.checkout', compact('cartItems', 'total'));
    }

    // public function processPayment(Request $request)
    // {
    //     \Log::info('PROCESS PAYMENT: ', $request->all());
    //     $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    //     $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

    //     $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));

    //     $order = $api->order->create([
    //         'receipt' => Str::uuid(),
    //         'amount' => $total * 100, // Amount in paise
    //         'currency' => 'INR'
    //     ]);

    //     $orderData = Order::create([
    //         'user_id' => Auth::id(),
    //         'order_number' => $order->id,
    //         'total_amount' => $total,
    //         'payment_status' => 'pending'
    //     ]);

    //     foreach ($cartItems as $item) {
    //         OrderItem::create([
    //             'order_id' => $orderData->id,
    //             'product_id' => $item->product_id,
    //             'quantity' => $item->quantity,
    //             'price' => $item->price
    //         ]);
    //     }

    //     return view('user.razorpay', compact('order', 'total'));
    // }

    public function processPayment(Request $request)
    {
        \Log::info('PROCESS PAYMENT: ', $request->all());

        $userId = Auth::id();

        // 1️⃣ Fetch all cart items
        $cartItems = Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // 2️⃣ Calculate totals
        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->price);
        $discountAmount = 0;
        $couponDiscount = 0;
        $shippingAmount = 0;
        $taxAmount = 0;

        // Example coupon logic (customize as needed)
        if (! empty($request->coupon_code) && $request->coupon_code === 'REFER50') {
            $couponDiscount = $subtotal * 0.5; // 50% off example
        }

        $total = ($subtotal - $discountAmount - $couponDiscount) + $shippingAmount + $taxAmount;

        // 3️⃣ Create Razorpay Order via API
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));
        $razorpayOrder = $api->order->create([
            'receipt' => Str::uuid(),
            'amount' => (int) ($total * 100), // convert to paise
            'currency' => 'INR',
        ]);

        DB::beginTransaction();
        try {
            // 4️⃣ Create order record in DB
            $order = Order::create([
                'user_id' => $userId,
                'order_number' => $razorpayOrder['id'],
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'coupon_discount' => $couponDiscount,
                'coupon_code' => $request->coupon_code ?? null,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $total,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'payment_method' => 'Razorpay',
                'currency' => 'INR',
                'shipping_first_name' => $request->first_name,
                'shipping_last_name' => $request->last_name,
                'shipping_email' => $request->email,
                'shipping_phone' => $request->phone,
                'shipping_address' => $request->address,
                'shipping_city' => $request->city,
                'shipping_state' => $request->state,
                'shipping_zip' => $request->zip,
                'shipping_country' => $request->country,
            ]);

            // 5️⃣ Store each item snapshot
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'Unknown Product',
                    'product_sku' => $item->product->sku ?? null,
                    'product_image' => $item->product->main_image ?? null,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'discount' => 0,
                    'final_price' => $item->quantity * $item->price,
                    'tax_amount' => 0,
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            // 6️⃣ Redirect to Razorpay checkout page
            return view('user.razorpay', [
                'order' => $razorpayOrder,
                'total' => $total,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order creation failed', ['error' => $e->getMessage()]);

            return redirect()->route('checkout')->with('error', 'Order processing failed. Please try again.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        \Log::info('Razorpay Payment Success:', $request->all());

        $razorpayOrderId = $request->razorpay_order_id ?? null;

        $order = Order::where('order_number', $razorpayOrderId)->first();

        if (! $order) {
            return redirect()->route('checkout')->with('error', 'Order not found.');
        }

        $order->update([
            'payment_status' => 'paid',
            'razorpay_payment_id' => $request->razorpay_payment_id ?? null,
            'payment_date' => now(),
            'order_status' => 'processing',
        ]);

        // Empty cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('thankyou')->with('success', 'Payment Successful! Thank you for your order.');
    }

    // public function paymentSuccess(Request $request)
    // {
    //     $order = Order::where('order_number', $request->razorpay_order_id)->first();

    //     if ($order) {
    //         $order->update([
    //             'payment_status' => 'paid',
    //             'razorpay_payment_id' => $request->razorpay_payment_id,
    //         ]);

    //         Cart::where('user_id', Auth::id())->delete();

    //         return redirect()->route('order-thankyou')->with('success', 'Payment Successful!');
    //     }

    //     return redirect()->route('checkout')->with('error', 'Payment Failed!');
    // }
}
