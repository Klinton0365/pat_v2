@extends('admin.layout.app')

@section('content')
<div class="content">
    <div class="container-fluid pt-4 px-4">

        <div class="bg-secondary text-center rounded p-4">
            <h6 class="mb-4">Orders</h6>

            <div class="table-responsive">
                <table class="table text-white table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Order No</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->invoice_no }}</td>
                            <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                            <td>₹{{ number_format($order->total_amount, 2) }}</td>

                            <td>
                                <span class="badge 
                                    @if($order->payment_status=='paid') bg-success
                                    @elseif($order->payment_status=='pending') bg-warning
                                    @else bg-danger @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                            </td>

                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-primary">View</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $orders->links() }}

        </div>
    </div>
</div>
@endsection
