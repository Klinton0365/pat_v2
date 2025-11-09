@extends('admin.layout.app')

@section('content')
    {{-- <div class="container-fluid pt-4 px-4">
        <h3 class="mb-4">Coupons</h3>
        <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary mb-3">Add Coupon</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}

        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Customers List</h3>
                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">+ Add Coupon</a>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ ucfirst($coupon->type) }}</td>
                                        <td>{{ $coupon->type == 'percentage' ? $coupon->value . '%' : '₹' . $coupon->value }}</td>
                                        <td>{{ $coupon->start_date }}</td>
                                        <td>{{ $coupon->end_date }}</td>
                                        <td>
                                            <span class="badge bg-{{ $coupon->is_active ? 'success' : 'secondary' }}">
                                                {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection