<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>PAT Panel</h3>
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">

                @if(auth('admin')->user()->profile_image)
                    <img class="rounded-circle" src="{{ asset('uploads/admin/' . auth('admin')->user()->profile_image) }}"
                        alt="Admin Photo" style="width: 40px; height: 40px;">
                @else
                    <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt="Admin Photo"
                        style="width: 40px; height: 40px;">
                @endif

                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>

            <div class="ms-3">
                <h6 class="mb-0">{{ auth('admin')->user()->name ?? 'Admin' }}</h6>
                <span>{{ auth('admin')->user()->role ?? 'Admin' }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            {{-- <div class="nav-item dropdown">
                @php
                $productActive =
                request()->routeIs('categories.*') ||
                request()->routeIs('products.*') ||
                request()->routeIs('admin.festival-offers.*');
                @endphp

                <a href="#" class="nav-link dropdown-toggle {{ $productActive ? 'active' : '' }}"
                    data-bs-toggle="dropdown" aria-expanded="{{ $productActive ? 'true' : 'false' }}">
                    <i class="fa fa-laptop me-2"></i>Products
                </a>

                <div class="dropdown-menu bg-transparent border-0 {{ $productActive ? 'show' : '' }}">

                    <a href="{{ route('categories.index') }}"
                        class="dropdown-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        Category
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="dropdown-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        Product
                    </a>

                    <a href="{{ route('admin.festival-offers.index') }}"
                        class="dropdown-item {{ request()->routeIs('admin.festival-offers.*') ? 'active' : '' }}">
                        Festival Offers
                    </a>

                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa fa-th me-2"></i>Orders
            </a>

            <a href="{{ route('admin.coupon.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.coupon.*') ? 'active' : '' }}">
                <i class="fa fa-th me-2"></i>Coupon
            </a>
            <a href="{{ route('admin.customers.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <i class="fa fa-th me-2"></i>Customers
            </a>
            <a href="{{ route('admin.services.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa fa-th me-2"></i>Services
            </a>
            <a href="{{ route('admin.technicians.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.technicians.*') ? 'active' : '' }}">
                <i class="fa fa-th me-2"></i>Technician
            </a>

            <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Inventory</a> --}}
            <div class="nav-item dropdown">

                @php
                    $productActive =
                        request()->routeIs('categories.*') ||
                        request()->routeIs('products.*') ||
                        request()->routeIs('admin.festival-offers.*');
                @endphp

                <a href="#" class="nav-link dropdown-toggle {{ $productActive ? 'active' : '' }}"
                    data-bs-toggle="dropdown" aria-expanded="{{ $productActive ? 'true' : 'false' }}">
                    <i class="fa fa-boxes me-2"></i>Products
                </a>

                <div class="dropdown-menu bg-transparent border-0 {{ $productActive ? 'show' : '' }}">

                    <a href="{{ route('categories.index') }}"
                        class="dropdown-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="fa fa-tags me-2"></i>Category
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="dropdown-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="fa fa-box me-2"></i>Product
                    </a>

                    <a href="{{ route('admin.festival-offers.index') }}"
                        class="dropdown-item {{ request()->routeIs('admin.festival-offers.*') ? 'active' : '' }}">
                        <i class="fa fa-gift me-2"></i>Festival Offers
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.orders.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa fa-receipt me-2"></i>Orders
            </a>

            <a href="{{ route('admin.coupon.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.coupon.*') ? 'active' : '' }}">
                <i class="fa fa-tag me-2"></i>
                Coupon
            </a>

            <a href="{{ route('admin.customers.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <i class="fa fa-users me-2"></i>Customers
            </a>

            <a href="{{ route('admin.services.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa fa-tools me-2"></i>Services
            </a>

            <a href="{{ route('admin.technicians.index') }}"
                class="nav-item nav-link {{ request()->routeIs('admin.technicians.*') ? 'active' : '' }}">
                <i class="fa fa-user-cog me-2"></i>Technician
            </a>

            <a href="{{ route('inventories.index') }}" class="nav-item nav-link">
                <i class="fa fa-warehouse me-2"></i>Inventory
            </a>

            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Elements</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Buttons</a>
                    <a href="typography.html" class="dropdown-item">Typography</a>
                    <a href="element.html" class="dropdown-item">Other Elements</a>
                </div>
            </div> --}}
            {{-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a> --}}
            {{-- <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a> --}}
            {{-- <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a> --}}
            {{-- <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> --}}
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.html" class="dropdown-item">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div> --}}
        </div>
    </nav>
</div>
<!-- Sidebar End -->