@extends('admin.layout.app')

@section('content')

    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Add New Customer</h6>
                <form action="{{ route('admin.customers.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>First Name *</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email </label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>City</label>
                            <input type="text" name="city" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>State</label>
                            <input type="text" name="state" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Zip</label>
                            <input type="text" name="zip" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" value="India">
                        </div>

                        <!-- Customer Meta -->
                        <div class="col-md-6 mb-3">
                            <label>Customer Type *</label>
                            <select name="customer_type" class="form-control" required>
                                <option value="individual">Individual</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>GST Number</label>
                            <input type="text" name="gst_number" class="form-control">
                        </div>

                    </div>

                    <button class="btn btn-success mt-3">Save</button>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection