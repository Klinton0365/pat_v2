@extends('user.dashboard.layout.app')

@section('content')
<div class="container py-4">

    <h3>Order Details #{{ $order->order_number }}</h3>

    <div class="row mt-4">

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Order Summary</h5>
                <p><strong>Status:</strong> {{ $order->order_status }}</p>
                <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>
                <p><strong>Payment:</strong> {{ $order->payment_status }}</p>
                <p><strong>Method:</strong> {{ $order->payment_method }}</p>
            </div>
        </div>

        <!-- Items -->
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Items</h5>

                @foreach($order->items as $item)
                    <div class="d-flex mb-3">
                        <img src="{{ asset('uploads/products/' . $item->product_image) }}" 
                             width="70" height="70" class="rounded">

                        <div class="ms-3">
                            <h6>{{ $item->product_name }}</h6>
                            <p>Qty: {{ $item->quantity }}</p>
                            <p>Price: ₹{{ $item->final_price }}</p>
                        </div>
                    </div>
                    <hr>
                @endforeach

            </div>
        </div>

    </div>
</div>
@endsection
