@extends('admin.layout.app')
@section('content')

    {{-- <div class="container mt-4">
        <h4>Add New Customer</h4> --}}
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
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

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
                    {{--
                </div> --}}
            </div>
        </div>
    </div>

@endsection