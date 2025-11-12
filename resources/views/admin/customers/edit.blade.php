@extends('admin.layout.app')
@section('content')
    {{--
    <div class="container mt-4">
        <h4>Edit Customer</h4> --}}

        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h6 class="mb-4">Edit Customer</h6>

                    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name *</label>
                                <input type="text" name="first_name" value="{{ $customer->user->first_name }}"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="{{ $customer->user->last_name }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email *</label>
                                <input type="email" name="email" value="{{ $customer->user->email }}" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $customer->user->phone }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Customer Type *</label>
                                <select name="customer_type" class="form-control" required>
                                    <option value="individual" {{ $customer->customer_type == 'individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="business" {{ $customer->customer_type == 'business' ? 'selected' : '' }}>
                                        Business</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Company Name</label>
                                <input type="text" name="company_name" value="{{ $customer->company_name }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>GST Number</label>
                                <input type="text" name="gst_number" value="{{ $customer->gst_number }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Credit Limit</label>
                                <input type="number" name="credit_limit" value="{{ $customer->credit_limit }}" step="0.01"
                                    class="form-control">
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3">Update</button>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-3">Back</a>
                    </form>

                </div>
            </div>
        </div>

@endsection