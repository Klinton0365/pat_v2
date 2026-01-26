@extends('user.dashboard.layout.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">My Orders</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Order #</th>
                <th>Invoice</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>
                    @if($order->invoice_no)
                        <span class="text-muted small">{{ $order->invoice_no }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'shipped' => 'primary',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                            'returned' => 'secondary',
                        ];
                        $color = $statusColors[$order->order_status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $color }}">{{ ucfirst($order->order_status) }}</span>
                </td>
                <td>
                    @php
                        $paymentColors = [
                            'paid' => 'success',
                            'pending' => 'warning',
                            'failed' => 'danger',
                            'refunded' => 'info',
                        ];
                        $pColor = $paymentColors[$order->payment_status] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $pColor }}">{{ ucfirst($order->payment_status) }}</span>
                </td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        {{-- <a href="{{ route('user.orders.show', $order->id) }}" 
                           class="btn btn-sm btn-primary" 
                           title="View Order">
                            <i class="bi bi-eye"></i>
                        </a> --}}
                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                        
                        {{-- ✅ Invoice Download Button --}}
                        @if($order->payment_status === 'paid' && $order->invoice_no)
                            {{-- <a href="{{ route('invoice.download', $order->id) }}" 
                               class="btn btn-sm btn-outline-danger" 
                               title="Download Invoice">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </a> --}}
                            <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-sm btn-outline-danger" >Invoice</a>
                        @else
                            <button class="btn btn-sm btn-outline-secondary" disabled title="Invoice not available">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>

<style>
    .table td {
        vertical-align: middle;
    }
    .gap-2 {
        gap: 0.5rem;
    }
</style>
@endsection
{{-- @extends('user.dashboard.layout.app')

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
@endsection --}}
