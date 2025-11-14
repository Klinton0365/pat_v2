@extends('admin.layout.app')

@section('content')

<div class="content">
    <div class="container-fluid pt-4 px-4">

        <div class="bg-secondary text-light rounded p-4">

            <h4>Order Details</h4>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h5>Order Info</h5>
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Invoice No:</strong> {{ $order->invoice_no }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                </div>

                <div class="col-md-6">
                    <h5>Payment Details</h5>
                    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                    <p><strong>Razorpay Order ID:</strong> {{ $order->razorpay_order_id }}</p>
                    <p><strong>Payment ID:</strong> {{ $order->razorpay_payment_id }}</p>
                </div>
            </div>

            <hr>

            <h5>Shipping Address</h5>
            <p>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
            <p>{{ $order->shipping_phone }}</p>
            <p>{{ $order->shipping_address }}</p>
            <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} - {{ $order->shipping_zip }}</p>
            <p>{{ $order->shipping_country }}</p>

            <hr>

            <h5>Items</h5>
            <table class="table table-bordered text-white">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Final Price</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item->product_image) }}"
                                 width="50"
                                 class="me-2">
                            {{ $item->product_name }}
                        </td>
                        <td>{{ $item->product_sku ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->final_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            <hr>

            <h5>Total Summary</h5>
            <p><strong>Subtotal:</strong> ₹{{ $order->subtotal }}</p>
            <p><strong>Product Discount:</strong> ₹{{ $order->discount_amount }}</p>
            <p><strong>Coupon Discount:</strong> ₹{{ $order->coupon_discount }}</p>
            <p><strong>Tax:</strong> ₹{{ $order->tax_amount }}</p>
            <p><strong>Shipping:</strong> ₹{{ $order->shipping_amount }}</p>

            <h4 class="text-primary">
                <strong>Grand Total: ₹{{ number_format($order->total_amount, 2) }}</strong>
            </h4>

            <hr>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label><strong>Update Order Status</strong></label>
                <select name="order_status" class="form-control mb-3">
                    <option value="pending" {{ $order->order_status=='pending'?'selected':'' }}>Pending</option>
                    <option value="processing" {{ $order->order_status=='processing'?'selected':'' }}>Processing</option>
                    <option value="shipped" {{ $order->order_status=='shipped'?'selected':'' }}>Shipped</option>
                    <option value="delivered" {{ $order->order_status=='delivered'?'selected':'' }}>Delivered</option>
                    <option value="cancelled" {{ $order->order_status=='cancelled'?'selected':'' }}>Cancelled</option>
                    <option value="returned" {{ $order->order_status=='returned'?'selected':'' }}>Returned</option>
                </select>

                <button class="btn btn-primary">Update</button>
            </form>

        </div>

    </div>
</div>

@endsection
