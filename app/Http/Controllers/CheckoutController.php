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
        \Log::info('PROCESS PAYMENT:', $request->all());

        $userId = Auth::id();

        /** ---------------------------------------------
         * 1️⃣ VALIDATE REQUEST
         * --------------------------------------------- */
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'zip' => 'required',
        //     'country' => 'required',
        //     'payment_method' => 'required|in:COD,Online',
        // ]);

        /** ---------------------------------------------
         * 2️⃣ Get Only Selected Cart Items
         * --------------------------------------------- */
        $selectedItems = json_decode($request->selected_items, true);

        if (empty($selectedItems)) {
            return back()->with('error', 'Please select at least one item.');
        }

        $cartItems = Cart::where('user_id', $userId)
            ->whereIn('id', $selectedItems)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No valid cart items found.');
        }

        /** ---------------------------------------------
         * 3️⃣ Calculate totals
         * --------------------------------------------- */
        $subtotal = 0;
        $discountAmount = 0;
        $couponDiscount = 0;
        $shippingAmount = 0;
        $taxAmount = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;

            $price = $product->discount > 0
                ? $product->price - ($product->price * $product->discount / 100)
                : $product->price;

            $subtotal += ($price * $item->quantity);
        }

        // COUPON CALCULATION
        if ($request->coupon_code === 'REFER50') {
            $couponDiscount = $subtotal * 0.50;
        }

        $taxAmount = ($subtotal - $couponDiscount) * 0.18;

        $total = ($subtotal - $couponDiscount) + $shippingAmount + $taxAmount;

        /** ---------------------------------------------
         * 4️⃣ CREATE ORDER IN DATABASE
         * --------------------------------------------- */
        DB::beginTransaction();

        try {

            // Razorpay order ID will be added ONLY for Online
            $razorpayOrderId = null;

            /** ---------------------------------------------
             * 5️⃣ Create Razorpay order if Online
             * --------------------------------------------- */
            if ($request->payment_method === 'Online') {
                $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));

                $razorpay = $api->order->create([
                    'receipt' => Str::uuid(),
                    'amount' => (int) ($total * 100),
                    'currency' => 'INR',
                ]);

                $razorpayOrderId = $razorpay['id'];
            }

            /** ---------------------------------------------
             * 6️⃣ Save Order in Database
             * --------------------------------------------- */
            $order = Order::create([
                'user_id' => $userId,
                'order_number' => $razorpayOrderId ?? ('ORD-'.Str::upper(Str::random(8))),
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'coupon_discount' => $couponDiscount,
                'coupon_code' => $request->coupon_code,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $total,
                'payment_status' => $request->payment_method === 'COD' ? 'pending' : 'pending',
                'order_status' => 'pending',
                'payment_method' => $request->payment_method,
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

            /** ---------------------------------------------
             * 7️⃣ Save Order Items Snapshot
             * --------------------------------------------- */
            foreach ($cartItems as $item) {
                $product = $item->product;

                $price = $product->discount > 0
                    ? $product->price - ($product->price * $product->discount / 100)
                    : $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'product_image' => $product->main_image,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'final_price' => $price * $item->quantity,
                    'tax_amount' => 0,
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            /** ---------------------------------------------
             * 8️⃣ If COD → Direct success page
             * --------------------------------------------- */
            if ($request->payment_method === 'COD') {
                Cart::where('user_id', $userId)->delete();

                return redirect()->route('thankyou')
                    ->with('success', 'Order placed successfully with Cash on Delivery!');
            }

            /** ---------------------------------------------
             * 9️⃣ If Online → Redirect to Razorpay screen
             * --------------------------------------------- */
            // return view('user.razorpay', [
            //     'order' => $razorpay,
            //     'total' => $total,
            // ]);
            return view('user.razorpay', [
                'order' => $razorpay,
                'dbOrder' => $order,   // 👍 send your own order
                'total' => $total,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('CHECKOUT ERROR:', ['message' => $e->getMessage()]);

            return back()->with('error', 'Something went wrong. Try again.');
        }
    }

    /* ---------------------------------------------------------
     * 🔥 PAYMENT SUCCESS (Online)
     * --------------------------------------------------------- */
    public function paymentSuccess(Request $request)
    {
        \Log::info('Razorpay Payment Success:', $request->all());

        $order = Order::where('order_number', $request->order_number)->first();

        \Log::info('ORDER: ', [$order]);

        if (! $order) {
            return redirect()->route('checkout')->with('error', 'Order not found.');
        }

        /** Validate Signature */
        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id.'|'.$request->razorpay_payment_id,
            env('RAZORPAY_SECRET')
        );

        if ($generatedSignature !== $request->razorpay_signature) {
            \Log::error('Signature mismatch!');

            return redirect()->route('checkout')->with('error', 'Payment verification failed.');
        }

        /** Update Order */
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'processing',
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_signature' => $request->razorpay_signature,
            'payment_date' => now(),
        ]);

        /** Clear Cart */
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('thankyou')->with('success', 'Payment Successful! Thank you for your order.');
    }

    // public function processPayment(Request $request)
    // {
    //     \Log::info('PROCESS PAYMENT: ', $request->all());

    //     $userId = Auth::id();

    //     // 1️⃣ Fetch all cart items
    //     $cartItems = Cart::where('user_id', $userId)
    //         ->with('product')
    //         ->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart')->with('error', 'Your cart is empty.');
    //     }

    //     // 2️⃣ Calculate totals
    //     $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->price);
    //     $discountAmount = 0;
    //     $couponDiscount = 0;
    //     $shippingAmount = 0;
    //     $taxAmount = 0;

    //     // Example coupon logic (customize as needed)
    //     if (! empty($request->coupon_code) && $request->coupon_code === 'REFER50') {
    //         $couponDiscount = $subtotal * 0.5; // 50% off example
    //     }

    //     $total = ($subtotal - $discountAmount - $couponDiscount) + $shippingAmount + $taxAmount;

    //     // 3️⃣ Create Razorpay Order via API
    //     $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));
    //     $razorpayOrder = $api->order->create([
    //         'receipt' => Str::uuid(),
    //         'amount' => (int) ($total * 100), // convert to paise
    //         'currency' => 'INR',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         // 4️⃣ Create order record in DB
    //         $order = Order::create([
    //             'user_id' => $userId,
    //             'order_number' => $razorpayOrder['id'],
    //             'subtotal' => $subtotal,
    //             'discount_amount' => $discountAmount,
    //             'coupon_discount' => $couponDiscount,
    //             'coupon_code' => $request->coupon_code ?? null,
    //             'tax_amount' => $taxAmount,
    //             'shipping_amount' => $shippingAmount,
    //             'total_amount' => $total,
    //             'payment_status' => 'pending',
    //             'order_status' => 'pending',
    //             'payment_method' => 'Razorpay',
    //             'currency' => 'INR',
    //             'shipping_first_name' => $request->first_name,
    //             'shipping_last_name' => $request->last_name,
    //             'shipping_email' => $request->email,
    //             'shipping_phone' => $request->phone,
    //             'shipping_address' => $request->address,
    //             'shipping_city' => $request->city,
    //             'shipping_state' => $request->state,
    //             'shipping_zip' => $request->zip,
    //             'shipping_country' => $request->country,
    //         ]);

    //         // 5️⃣ Store each item snapshot
    //         foreach ($cartItems as $item) {
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $item->product_id,
    //                 'product_name' => $item->product->name ?? 'Unknown Product',
    //                 'product_sku' => $item->product->sku ?? null,
    //                 'product_image' => $item->product->main_image ?? null,
    //                 'quantity' => $item->quantity,
    //                 'price' => $item->price,
    //                 'discount' => 0,
    //                 'final_price' => $item->quantity * $item->price,
    //                 'tax_amount' => 0,
    //                 'status' => 'pending',
    //             ]);
    //         }

    //         DB::commit();

    //         // 6️⃣ Redirect to Razorpay checkout page
    //         return view('user.razorpay', [
    //             'order' => $razorpayOrder,
    //             'total' => $total,
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Order creation failed', ['error' => $e->getMessage()]);

    //         return redirect()->route('checkout')->with('error', 'Order processing failed. Please try again.');
    //     }
    // }

    // public function paymentSuccess(Request $request)
    // {
    //     \Log::info('Razorpay Payment Success:', $request->all());

    //     $razorpayOrderId = $request->razorpay_order_id ?? null;

    //     $order = Order::where('order_number', $razorpayOrderId)->first();
    //     \Log::info('RAZORPAY ORDER:', [$order]);

    //     if (! $order) {
    //         return redirect()->route('checkout')->with('error', 'Order not found.');
    //     }

    //     $order->update([
    //         'payment_status' => 'paid',
    //         'razorpay_payment_id' => $request->razorpay_payment_id ?? null,
    //         'payment_date' => now(),
    //         'order_status' => 'processing',
    //     ]);

    //     // Empty cart
    //     Cart::where('user_id', Auth::id())->delete();

    //     return redirect()->route('thankyou')->with('success', 'Payment Successful! Thank you for your order.');
    // }

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
