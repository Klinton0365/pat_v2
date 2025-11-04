@extends('user.layout.app')

@section('content')
    <!-- ============================= -->
    <!-- 🌐 Modern Register Page Start -->
    <!-- ============================= -->
    <style>
        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container-fluid bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-sm-5 bg-white">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h3 class="fw-bold text-primary">
                            <i class="fa fa-user-plus me-2"></i> Create Account
                        </h3>
                    </a>
                    <p class="text-muted mt-2">Join us and explore exclusive features!</p>
                </div>

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                            name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                        <label for="first_name">First Name</label>
                        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                        <label for="last_name">Last Name</label>
                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email address</label>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="terms" required>
                        <label class="form-check-label text-muted small" for="terms">
                            I agree to the <a href="#" class="text-primary">Terms & Conditions</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary py-3 w-100 fw-semibold">
                        <i class="fa fa-user-plus me-2"></i> Register
                    </button>

                    <a href="{{ route('google.login') }}" class="btn btn-outline-dark w-100 mt-3">
                        <img src="https://developers.google.com/identity/images/g-logo.png" width="22" class="me-2">
                        Sign up with Google
                    </a>

                    <p class="text-center text-muted mt-3 mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary fw-semibold">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================= -->
    <!-- 🌐 Modern Register Page End -->
    <!-- ============================= -->
@endsection