@extends('user.layout.app')

@section('content')
<div class="container">

    <h3 class="mb-4">My Profile</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label>First Name *</label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ Auth::user()->first_name }}" required>
            </div>

            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ Auth::user()->last_name }}">
            </div>

            <div class="col-md-6">
                <label>Email (Read Only)</label>
                <input type="email" class="form-control"
                       value="{{ Auth::user()->email }}" readonly>
            </div>

            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ Auth::user()->phone }}">
            </div>

            <div class="col-md-12">
                <label>Address</label>
                <input type="text" name="address" class="form-control"
                       value="{{ Auth::user()->address }}">
            </div>

            <div class="col-md-4">
                <label>City</label>
                <input type="text" name="city" class="form-control"
                       value="{{ Auth::user()->city }}">
            </div>

            <div class="col-md-4">
                <label>State</label>
                <input type="text" name="state" class="form-control"
                       value="{{ Auth::user()->state }}">
            </div>

            <div class="col-md-4">
                <label>ZIP</label>
                <input type="text" name="zip" class="form-control"
                       value="{{ Auth::user()->zip }}">
            </div>

            <div class="col-md-6">
                <label>Country</label>
                <input type="text" name="country" class="form-control"
                       value="{{ Auth::user()->country }}">
            </div>

        </div>

        <button class="btn btn-primary mt-4">Update Profile</button>

    </form>

</div>
@endsection
