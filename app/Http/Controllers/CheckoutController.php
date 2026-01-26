<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

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

        Log::info('PROCESS PAYMENT:', $request->all());

        $userId = Auth::id();

        /** ---------------------------------------------
         * 1️⃣ VALIDATE REQUEST
         * --------------------------------------------- */
        // $request->validate([...]);

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
                'order_number' => $razorpayOrderId ?? ('ORD-' . Str::upper(Str::random(8))),
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'coupon_discount' => $couponDiscount,
                'coupon_code' => $request->coupon_code,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $total,
                'payment_status' => 'pending',
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
             * 8️⃣ If COD → Direct success page with ORDER ID
             * --------------------------------------------- */

            if ($request->payment_method === 'COD') {
                // Generate Invoice Number for COD
                $order->update([
                    'invoice_no' => 'INV-' . date('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                ]);

                Cart::where('user_id', $userId)->delete();

                // ✅ PASS ORDER ID TO SUCCESS PAGE
                // dd('before thatnks');
                return redirect()->route('thankyou', ['order' => $order->id])
                    ->with('success', 'Order placed successfully with Cash on Delivery!');
            }

            /** ---------------------------------------------
             * 9️⃣ If Online → Redirect to Razorpay screen
             * --------------------------------------------- */
            return view('user.razorpay', [
                'order' => $razorpay,
                'dbOrder' => $order,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('CHECKOUT ERROR:', ['message' => $e->getMessage()]);

            return back()->with('error', 'Something went wrong. Try again.');
        }
    }

    /* ---------------------------------------------------------
     * 🔥 PAYMENT SUCCESS (Online)
     * --------------------------------------------------------- */
    public function paymentSuccess(Request $request)
    {
        Log::info('Razorpay Payment Success:', $request->all());

        $order = Order::where('order_number', $request->order_number)->first();

        Log::info('ORDER: ', [$order]);

        if (!$order) {
            return redirect()->route('checkout')->with('error', 'Order not found.');
        }

        /** Validate Signature */
        $generatedSignature = hash_hmac(
            'sha256',
            $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
            env('RAZORPAY_SECRET')
        );

        if ($generatedSignature !== $request->razorpay_signature) {
            Log::error('Signature mismatch!');
            return redirect()->route('checkout')->with('error', 'Payment verification failed.');
        }

        /** Update Order with Payment Details & Generate Invoice Number */
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'processing',
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_signature' => $request->razorpay_signature,
            'transaction_id' => $request->razorpay_payment_id,
            'payment_date' => now(),
            // ✅ Generate Invoice Number
            'invoice_no' => 'INV-' . date('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
        ]);

        /** Create Customer if not exists */
        $userId = $order->user_id;

        if (!Customer::where('user_id', $userId)->exists()) {
            Customer::create([
                'user_id' => $userId,
                'customer_code' => 'CUST-' . strtoupper(Str::random(8)),
                'customer_type' => 'individual',
                'company_name' => null,
                'gst_number' => null,
                'status' => 'active',
                'referral_code' => strtoupper(Str::random(6)),
                'credit_limit' => 0,
                'joined_at' => now(),
            ]);

            Log::info('Customer Created For User: ' . $userId);
        }

        $customer = Customer::where('user_id', $order->user_id)->first();

        foreach ($order->items as $item) {
            Service::create([
                'customer_id' => $customer->id,
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'service_code' => 'SRV-' . strtoupper(Str::random(8)),
                'source_type' => 'internal',
                'issue_type' => 'installation',
                'status' => 'pending',
                'scheduled_date' => now()->addDays(2),
                'next_service_date' => now()->addDays(90),
            ]);
        }

        /** Clear Cart */
        Cart::where('user_id', $userId)->delete();
        // dd('before thatnks');
        // ✅ PASS ORDER ID TO SUCCESS PAGE
        return redirect()->route('thankyou', ['order' => $order->id])
            ->with('success', 'Payment Successful! Thank you for your order.');
    }

    /* ---------------------------------------------------------
     * 🎉 THANK YOU PAGE - Receives Order ID
     * --------------------------------------------------------- */
    public function thankyou(Order $order)
    {
        // Security: Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        // Load order with relationships
        $order->load(['items.product', 'user']);

        return view('user.order.thank-you', compact('order'));
    }

    /* ---------------------------------------------------------
 * 🛒 BUY NOW - Direct Purchase (Skip Cart)
 * --------------------------------------------------------- */
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }

        $quantity = $request->quantity;
        $color = $request->color ?? null;

        // Calculate price
        $price = $product->discount > 0
            ? $product->price - ($product->price * $product->discount / 100)
            : $product->price;

        $subtotal = $price * $quantity;
        $tax = $subtotal * 0.18;
        $total = $subtotal + $tax;

        return view('user.buy-now', compact('product', 'quantity', 'color', 'subtotal', 'tax', 'total'));
    }

    /* ---------------------------------------------------------
 * 💳 PROCESS BUY NOW PAYMENT
 * --------------------------------------------------------- */
    public function processBuyNow(Request $request)
    {
        Log::info('PROCESS BUY NOW:', $request->all());

        $userId = Auth::id();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:COD,Online',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock available.');
        }

        /** Calculate totals */
        $quantity = $request->quantity;
        $originalPrice = $product->price;
        $discountPercent = $product->discount ?? 0;

        $price = $discountPercent > 0
            ? $originalPrice - ($originalPrice * $discountPercent / 100)
            : $originalPrice;

        $subtotal = $price * $quantity;
        $discountAmount = ($originalPrice * $discountPercent / 100) * $quantity;
        $couponDiscount = 0;
        $shippingAmount = 0;

        // Coupon calculation
        if ($request->coupon_code === 'REFER50') {
            $couponDiscount = $subtotal * 0.50;
        }

        $taxAmount = ($subtotal - $couponDiscount) * 0.18;
        $total = ($subtotal - $couponDiscount) + $shippingAmount + $taxAmount;

        DB::beginTransaction();

        try {
            $razorpayOrderId = null;

            /** Create Razorpay order if Online */
            if ($request->payment_method === 'Online') {
                $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));

                $razorpay = $api->order->create([
                    'receipt' => Str::uuid(),
                    'amount' => (int) ($total * 100),
                    'currency' => 'INR',
                ]);

                $razorpayOrderId = $razorpay['id'];
            }

            /** Save Order */
            $order = Order::create([
                'user_id' => $userId,
                'order_number' => $razorpayOrderId ?? ('ORD-' . Str::upper(Str::random(8))),
                'subtotal' => $subtotal,
                'discount_amount' => $discountAmount,
                'coupon_discount' => $couponDiscount,
                'coupon_code' => $request->coupon_code,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $total,
                'payment_status' => 'pending',
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

            /** Save Order Item */
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'product_image' => $product->main_image,
                'quantity' => $quantity,
                'price' => $originalPrice,
                'discount' => $discountPercent,
                'final_price' => $price * $quantity,
                'tax_amount' => 0,
                'status' => 'pending',
            ]);

            /** Reduce Stock */
            $product->decrement('stock', $quantity);

            DB::commit();

            /** COD → Success Page */
            if ($request->payment_method === 'COD') {
                $order->update([
                    'invoice_no' => 'INV-' . date('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                ]);

                return redirect()->route('thankyou', ['order' => $order->id])
                    ->with('success', 'Order placed successfully with Cash on Delivery!');
            }

            /** Online → Razorpay */
            return view('user.razorpay', [
                'order' => $razorpay,
                'dbOrder' => $order,
                'total' => $total,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('BUY NOW ERROR:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong. Try again.');
        }
    }

    // public function index()
    // {
    //     $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    //     $total = $cartItems->sum(fn ($item) => $item->quantity * $item->price);

    //     return view('user.checkout', compact('cartItems', 'total'));
    // }

    // public function processPayment(Request $request)
    // {
    //     \Log::info('PROCESS PAYMENT:', $request->all());

    //     $userId = Auth::id();

    //     /** ---------------------------------------------
    //      * 1️⃣ VALIDATE REQUEST
    //      * --------------------------------------------- */
    //     // $request->validate([
    //     //     'first_name' => 'required',
    //     //     'last_name' => 'required',
    //     //     'email' => 'required|email',
    //     //     'phone' => 'required',
    //     //     'address' => 'required',
    //     //     'city' => 'required',
    //     //     'state' => 'required',
    //     //     'zip' => 'required',
    //     //     'country' => 'required',
    //     //     'payment_method' => 'required|in:COD,Online',
    //     // ]);

    //     /** ---------------------------------------------
    //      * 2️⃣ Get Only Selected Cart Items
    //      * --------------------------------------------- */
    //     $selectedItems = json_decode($request->selected_items, true);

    //     if (empty($selectedItems)) {
    //         return back()->with('error', 'Please select at least one item.');
    //     }

    //     $cartItems = Cart::where('user_id', $userId)
    //         ->whereIn('id', $selectedItems)
    //         ->with('product')
    //         ->get();

    //     if ($cartItems->isEmpty()) {
    //         return back()->with('error', 'No valid cart items found.');
    //     }

    //     /** ---------------------------------------------
    //      * 3️⃣ Calculate totals
    //      * --------------------------------------------- */
    //     $subtotal = 0;
    //     $discountAmount = 0;
    //     $couponDiscount = 0;
    //     $shippingAmount = 0;
    //     $taxAmount = 0;

    //     foreach ($cartItems as $item) {
    //         $product = $item->product;

    //         $price = $product->discount > 0
    //             ? $product->price - ($product->price * $product->discount / 100)
    //             : $product->price;

    //         $subtotal += ($price * $item->quantity);
    //     }

    //     // COUPON CALCULATION
    //     if ($request->coupon_code === 'REFER50') {
    //         $couponDiscount = $subtotal * 0.50;
    //     }

    //     $taxAmount = ($subtotal - $couponDiscount) * 0.18;

    //     $total = ($subtotal - $couponDiscount) + $shippingAmount + $taxAmount;

    //     /** ---------------------------------------------
    //      * 4️⃣ CREATE ORDER IN DATABASE
    //      * --------------------------------------------- */
    //     DB::beginTransaction();

    //     try {

    //         // Razorpay order ID will be added ONLY for Online
    //         $razorpayOrderId = null;

    //         /** ---------------------------------------------
    //          * 5️⃣ Create Razorpay order if Online
    //          * --------------------------------------------- */
    //         if ($request->payment_method === 'Online') {
    //             $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_SECRET'));

    //             $razorpay = $api->order->create([
    //                 'receipt' => Str::uuid(),
    //                 'amount' => (int) ($total * 100),
    //                 'currency' => 'INR',
    //             ]);

    //             $razorpayOrderId = $razorpay['id'];
    //         }

    //         /** ---------------------------------------------
    //          * 6️⃣ Save Order in Database
    //          * --------------------------------------------- */
    //         $order = Order::create([
    //             'user_id' => $userId,
    //             'order_number' => $razorpayOrderId ?? ('ORD-'.Str::upper(Str::random(8))),
    //             'subtotal' => $subtotal,
    //             'discount_amount' => $discountAmount,
    //             'coupon_discount' => $couponDiscount,
    //             'coupon_code' => $request->coupon_code,
    //             'tax_amount' => $taxAmount,
    //             'shipping_amount' => $shippingAmount,
    //             'total_amount' => $total,
    //             'payment_status' => $request->payment_method === 'COD' ? 'pending' : 'pending',
    //             'order_status' => 'pending',
    //             'payment_method' => $request->payment_method,
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

    //         /** ---------------------------------------------
    //          * 7️⃣ Save Order Items Snapshot
    //          * --------------------------------------------- */
    //         foreach ($cartItems as $item) {
    //             $product = $item->product;

    //             $price = $product->discount > 0
    //                 ? $product->price - ($product->price * $product->discount / 100)
    //                 : $product->price;

    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $product->id,
    //                 'product_name' => $product->name,
    //                 'product_sku' => $product->sku,
    //                 'product_image' => $product->main_image,
    //                 'quantity' => $item->quantity,
    //                 'price' => $product->price,
    //                 'discount' => $product->discount,
    //                 'final_price' => $price * $item->quantity,
    //                 'tax_amount' => 0,
    //                 'status' => 'pending',
    //             ]);
    //         }

    //         DB::commit();

    //         /** ---------------------------------------------
    //          * 8️⃣ If COD → Direct success page
    //          * --------------------------------------------- */
    //         if ($request->payment_method === 'COD') {
    //             Cart::where('user_id', $userId)->delete();

    //             return redirect()->route('thankyou')
    //                 ->with('success', 'Order placed successfully with Cash on Delivery!');
    //         }

    //         /** ---------------------------------------------
    //          * 9️⃣ If Online → Redirect to Razorpay screen
    //          * --------------------------------------------- */
    //         // return view('user.razorpay', [
    //         //     'order' => $razorpay,
    //         //     'total' => $total,
    //         // ]);
    //         return view('user.razorpay', [
    //             'order' => $razorpay,
    //             'dbOrder' => $order,   // 👍 send your own order
    //             'total' => $total,
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('CHECKOUT ERROR:', ['message' => $e->getMessage()]);

    //         return back()->with('error', 'Something went wrong. Try again.');
    //     }
    // }

    // /* ---------------------------------------------------------
    //  * 🔥 PAYMENT SUCCESS (Online)
    //  * --------------------------------------------------------- */

    // public function paymentSuccess(Request $request)
    // {
    //     \Log::info('Razorpay Payment Success:', $request->all());

    //     $order = Order::where('order_number', $request->order_number)->first();

    //     \Log::info('ORDER: ', [$order]);

    //     if (! $order) {
    //         return redirect()->route('checkout')->with('error', 'Order not found.');
    //     }

    //     /** Validate Signature */
    //     $generatedSignature = hash_hmac(
    //         'sha256',
    //         $request->razorpay_order_id.'|'.$request->razorpay_payment_id,
    //         env('RAZORPAY_SECRET')
    //     );

    //     if ($generatedSignature !== $request->razorpay_signature) {
    //         \Log::error('Signature mismatch!');

    //         return redirect()->route('checkout')->with('error', 'Payment verification failed.');
    //     }

    //     /** Update Order */
    //     $order->update([
    //         'payment_status' => 'paid',
    //         'order_status' => 'processing',
    //         'razorpay_payment_id' => $request->razorpay_payment_id,
    //         'razorpay_order_id' => $request->razorpay_order_id,
    //         'razorpay_signature' => $request->razorpay_signature,
    //         'payment_date' => now(),
    //     ]);

    //     /** ------------------------------------
    //      *  CREATE CUSTOMER IF NOT EXISTS
    //      * ------------------------------------*/
    //     $userId = $order->user_id;

    //     // Only create if customer does NOT exist
    //     if (! Customer::where('user_id', $userId)->exists()) {

    //         Customer::create([
    //             'user_id' => $userId,
    //             'customer_code' => 'CUST-'.strtoupper(Str::random(8)),
    //             'customer_type' => 'individual',
    //             'company_name' => null,
    //             'gst_number' => null,
    //             'status' => 'active',
    //             'referral_code' => strtoupper(Str::random(6)),
    //             'credit_limit' => 0,
    //             'joined_at' => now(),
    //         ]);

    //         \Log::info('Customer Created For User: '.$userId);
    //     }

    //     $customer = Customer::where('user_id', $order->user_id)->first();

    //     foreach ($order->items as $item) {
    //         Service::create([
    //             'customer_id' => $customer->id,
    //             'order_id' => $order->id,
    //             'product_id' => $item->product_id,
    //             'service_code' => 'SRV-'.strtoupper(Str::random(8)),
    //             'source_type' => 'internal',
    //             'issue_type' => 'installation',
    //             'status' => 'pending',

    //             // Scheduled after 2 days
    //             'scheduled_date' => now()->addDays(2),

    //             // Next service (AMC) after 90 days
    //             'next_service_date' => now()->addDays(90),
    //         ]);
    //     }

    //     /** Clear Cart */
    //     Cart::where('user_id', $userId)->delete();

    //     return redirect()->route('thankyou')
    //         ->with('success', 'Payment Successful! Thank you for your order.');
    // }

}
