@extends('user.layout.app')
@section('content')
<div class="container py-5">
    <h3 class="mb-4">Your Cart</h3>
    @if($cartItems->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td>₹{{ number_format($item->quantity * $item->price, 2) }}</td>
                <td><a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger btn-sm">Remove</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection
