@extends('user.dashboard.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">My Orders</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Order #</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Total</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td><span class="badge bg-info">{{ $order->order_status }}</span></td>
                <td><span class="badge bg-success">{{ $order->payment_status }}</span></td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td><a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
