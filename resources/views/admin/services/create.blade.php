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
                                        {{ $c->user->last_name }}
                                    </option>
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
                            <select name="issue_type" class="form-control" required>
                                <option value="">-- Select Issue Type --</option>

                                <option value="Installation">Installation</option>
                                <option value="Uninstallation">Uninstallation</option>
                                <option value="Re-installation">Re-installation</option>

                                <option value="General Service">General Service</option>
                                <option value="AMC Service">AMC Service</option>

                                <option value="Filter Replacement">Filter Replacement</option>
                                <option value="RO Membrane Replacement">RO Membrane Replacement</option>
                                <option value="UV Lamp Replacement">UV Lamp Replacement</option>

                                <option value="Tank Cleaning">Tank Cleaning</option>
                                <option value="Tap/Faucet Replacement">Tap/Faucet Replacement</option>

                                <option value="Water Leakage">Water Leakage</option>

                                <option value="Noise Issue (Pump/Motor)">Noise Issue (Pump/Motor)</option>
                                <option value="Pump Failure">Pump Failure</option>
                                <option value="Solenoid Valve Issue">Solenoid Valve Issue</option>

                                <option value="TDS Issue">TDS Issue</option>

                                <option value="Electrical/Socket Issue">Electrical/Socket Issue</option>

                                <option value="Other">Other</option>
                            </select>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="text-light">Scheduled Date</label>
                            {{-- <input type="date" name="scheduled_date" class="form-control"> --}}
                            <input type="text" name="scheduled_date" id="scheduled_date" class="form-control"
                                placeholder="Select date">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-light">Next Service Date</label>
                            {{-- <input type="date" name="next_service_date" class="form-control"> --}}
                            <input type="text" name="next_service_date" id="next_service_date" class="form-control"
                                placeholder="Select date">
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