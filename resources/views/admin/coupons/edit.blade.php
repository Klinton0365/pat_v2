@extends('admin.layout.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Edit Coupon</h6>
                <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label>Coupon Code</label>
                        <input type="text" name="code" value="{{ $coupon->code }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Type</label>
                        <select name="type" class="form-select">
                            <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>
                                Percentage</option>
                            <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Value</label>
                        <input type="number" step="0.01" name="value" value="{{ $coupon->value }}" class="form-control"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start Date</label>
                            {{-- <input type="date" name="start_date" value="{{ $coupon->start_date }}"
                                class="form-control"> --}}
                            <input type="text" name="start_date" id="start_date" value="{{ $coupon->start_date }}"
                                class="form-control" placeholder="Select date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>End Date</label>
                            {{-- <input type="date" name="end_date" value="{{ $coupon->end_date }}" class="form-control">
                            --}}
                            <input type="text" name="end_date" id="end_date" value="{{ $coupon->end_date }}"
                                class="form-control" placeholder="Select date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Usage Limit</label>
                        <input type="number" name="usage_limit" value="{{ $coupon->usage_limit }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ $coupon->is_active ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Update Coupon</button>
                </form>
            </div>
        </div>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            allowInput: true
        });
    </script>
@endsection