@extends('user.dashboard.layout.app')

@section('content')
<div class="container py-4">

    <h3>Service #{{ $service->service_code }}</h3>

    <div class="row mt-4">

        <!-- Summary -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Summary</h5>
                <p><strong>Status:</strong> {{ $service->status }}</p>
                <p><strong>Product:</strong> {{ $service->product->name ?? $service->external_product_name }}</p>
                <p><strong>Scheduled:</strong> {{ optional($service->scheduled_date)->format('d M Y') }}</p>
                <p><strong>Next service:</strong> {{ optional($service->next_service_date)->format('d M Y') }}</p>
                <p><strong>Technician:</strong> {{ $service->technician->name ?? 'Not Assigned' }}</p>
            </div>
        </div>

        <!-- Description -->
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Description</h5>
                <p>{{ $service->problem_description }}</p>
            </div>
        </div>

    </div>

</div>
@endsection
