@extends('admin.layout.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="content">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-4">Add Services</h6>
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Customer</label>
                            <select name="customer_id" class="form-control">
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->customer_code }} - {{ $c->user->first_name }}
                                        {{ $c->user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Product</label>
                            <select name="product_id" class="form-control">
                                <option value="">--Select--</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Issue Type</label>
                            <input type="text" name="issue_type" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Scheduled Date</label>
                            {{-- <input type="date" name="scheduled_date" class="form-control"> --}}
                            <input type="text" name="scheduled_date" id="scheduled_date" class="form-control" placeholder="Select date">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Next Service Date</label>
                            {{-- <input type="date" name="next_service_date" class="form-control"> --}}
                            <input type="text" name="next_service_date" id="next_service_date" class="form-control" placeholder="Select date">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="text-light">Problem Description</label>
                            <textarea name="problem_description" class="form-control" rows="3"></textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#scheduled_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });

    flatpickr("#next_service_date", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
</script>

@endsection