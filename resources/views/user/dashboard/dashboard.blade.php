@extends('user.dashboard.layout.app')

@section('content')

<div class="container-fluid">
    <h3 class="mb-4">Welcome, {{ Auth::user()->first_name }} 👋</h3>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <i class="fa fa-shopping-bag fa-2x text-primary mb-2"></i>
                <h4>{{ $totalOrders }}</h4>
                <p class="text-muted">Total Orders</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <i class="fa fa-box-open fa-2x text-warning mb-2"></i>
                <h4>{{ $pendingOrders }}</h4>
                <p class="text-muted">Pending Orders</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <i class="fa fa-tools fa-2x text-danger mb-2"></i>
                <h4>{{ $activeServices }}</h4>
                <p class="text-muted">Active Services</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 text-center shadow-sm">
                <i class="fa fa-calendar-check fa-2x text-success mb-2"></i>
                <h4>{{ $upcomingServices }}</h4>
                <p class="text-muted">Upcoming Services</p>
            </div>
        </div>

    </div>

</div>
@endsection
