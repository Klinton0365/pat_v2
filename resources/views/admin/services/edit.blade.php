@extends('admin.layout.app')

@section('content')

    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Edit Services</h6>
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Customer</label>
                            <select name="customer_id" class="form-control">
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" {{ $service->customer_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->customer_code }} - {{ $c->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Order -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Order (Optional)</label>
                            <select name="order_id" class="form-control">
                                <option value="">--Select--</option>
                                @foreach($orders as $o)
                                    <option value="{{ $o->id }}" {{ $service->order_id == $o->id ? 'selected' : '' }}>
                                        {{ $o->order_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Product</label>
                            <select name="product_id" class="form-control">
                                <option value="">--Select--</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" {{ $service->product_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Source Type -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Source Type</label>
                            <select name="source_type" class="form-control">
                                <option value="internal" {{ $service->source_type == 'internal' ? 'selected' : '' }}>
                                    Internal</option>
                                <option value="external" {{ $service->source_type == 'external' ? 'selected' : '' }}>
                                    External</option>
                            </select>
                        </div>

                        <!-- External Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">External Product Name (if external)</label>
                            <input type="text" name="external_product_name" class="form-control"
                                value="{{ $service->external_product_name }}">
                        </div>

                        <!-- Issue Type -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Issue Type</label>
                            <input type="text" name="issue_type" class="form-control" value="{{ $service->issue_type }}">
                        </div>

                        <!-- Scheduled Date -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Scheduled Date</label>
                            <input type="date" name="scheduled_date" class="form-control"
                                value="{{ $service->scheduled_date ? $service->scheduled_date->format('Y-m-d') : '' }}">
                        </div>

                        <!-- Next Service Date -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Next Service Date</label>
                            <input type="date" name="next_service_date" class="form-control"
                                value="{{ $service->next_service_date ? $service->next_service_date->format('Y-m-d') : '' }}">
                        </div>

                        <!-- Technician -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Technician</label>
                            <select name="technician_id" class="form-control">
                                <option value="">Not Assigned</option>
                                @foreach($technicians as $t)
                                    <option value="{{ $t->id }}" {{ $service->technician_id == $t->id ? 'selected' : '' }}>
                                        {{ $t->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="text-light">Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $service->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="in_progress" {{ $service->status == 'in_progress' ? 'selected' : '' }}>
                                    In Progress</option>
                                <option value="completed" {{ $service->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $service->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>

                        <!-- Problem Description -->
                        <div class="col-12 mb-3">
                            <label class="text-light">Problem Description</label>
                            <textarea name="problem_description" class="form-control"
                                rows="4">{{ $service->problem_description }}</textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary mt-3">Update Service</button>

                </form>

            </div>
        </div>
    </div>
@endsection