<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Panel - PureAquaTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 230px;
            height: 100vh;
            background: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px 0;
            color: white;
        }

        .sidebar a {
            padding: 12px 20px;
            display: block;
            color: #dcdcdc;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar i {
            width: 20px;
        }

        .content-area {
            margin-left: 230px;
            padding: 20px;
        }

        .navbar {
            margin-left: 230px;
        }

        .user-name {
            font-weight: 600;
        }
    </style>

    @yield('styles')
</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="text-center text-white mb-4">My Account</h4>

        <a href="{{ route('user.dashboard') }}"
            class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="fa fa-home"></i> Dashboard
        </a>

        <a href="{{ route('user.orders.index') }}"
            class="{{ request()->routeIs('user.orders.*') ? 'active' : '' }}">
            <i class="fa fa-shopping-bag"></i> My Orders
        </a>

        <a href="{{ route('user.services.index') }}"
            class="{{ request()->routeIs('user.services.*') ? 'active' : '' }}">
            <i class="fa fa-tools"></i> My Services
        </a>

        <a href="{{ route('user.profile') }}"
            class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <i class="fa fa-user"></i> Profile
        </a>

        <a href="{{ route('user.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
        <div class="container-fluid">
            <h5 class="mb-0 fw-bold">User Panel</h5>

            <div class="dropdown ms-auto">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                   id="dropdownUser"
                   data-bs-toggle="dropdown">
                    <img src="{{ Auth::user()->google_avatar ?? asset('user.png') }}"
                         alt="User"
                         width="40" height="40"
                         class="rounded-circle me-2">
                    <span class="user-name">{{ Auth::user()->first_name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" 
                           href="{{ route('user.logout') }}" 
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="content-area">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
