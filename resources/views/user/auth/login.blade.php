@extends('user.layout.app')

@section('content')
    <!-- ============================= -->
    <!-- 🌐 Modern Login Page Start -->
    <!-- ============================= -->
    <div class="container-fluid bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-sm-5 bg-white">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h3 class="fw-bold text-primary">
                            <i class="fa fa-sign-in-alt me-2"></i> Welcome Back
                        </h3>
                    </a>
                    <p class="text-muted mt-2">Login to continue to your account</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email address</label>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="small text-primary">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary py-3 w-100 fw-semibold">
                        <i class="fa fa-sign-in-alt me-2"></i> Login
                    </button>

                    <div class="text-center my-3">
                        <span class="text-muted">or</span>
                    </div>

                    <a href="{{ route('google.login') }}"
                        class="btn btn-outline-dark py-3 w-100 d-flex align-items-center justify-content-center rounded-3 fw-semibold">
                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="22"
                            class="me-2">
                        Continue with Google
                    </a>


                    <p class="text-center text-muted mt-3 mb-0">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-primary fw-semibold">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================= -->
    <!-- 🌐 Modern Login Page End -->
    <!-- ============================= -->
@endsection