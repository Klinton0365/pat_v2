@extends('admin.layout.app')

@section('content')
{{-- <div class="container-fluid pt-4 px-4">
    <h3 class="mb-4">Add Coupon</h3> --}}
    <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 class="mb-4">Add Coupon</h6>

    <form action="{{ route('admin.coupon.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Coupon Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-select">
                <option value="percentage">Percentage</option>
                <option value="fixed">Fixed Amount</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Value</label>
            <input type="number" step="0.01" name="value" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Usage Limit</label>
            <input type="number" name="usage_limit" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Coupon</button>
    </form>
 </div>
        </div>
    </div>
@endsection
