@extends('user.layout.app')
@section('content')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 0 20px;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            color: #1a365d;
        }

        .logo-icon {
            background: #3182ce;
            color: white;
            padding: 8px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #3182ce;
        }

        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #3182ce;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #3182ce;
            font-weight: bold;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(49, 130, 206, 0.9), rgba(72, 187, 120, 0.8)),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f7fafc" width="1200" height="600"/><polygon fill="%23e2e8f0" points="0,600 300,400 600,450 900,300 1200,350 1200,600"/><polygon fill="%23cbd5e0" points="0,600 400,500 800,520 1200,400 1200,600"/></svg>');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="buildings" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse"><rect fill="none" stroke="%23ffffff10" stroke-width="0.5" width="50" height="50"/><rect fill="%23ffffff05" x="10" y="20" width="8" height="25"/><rect fill="%23ffffff08" x="20" y="15" width="6" height="30"/><rect fill="%23ffffff06" x="30" y="25" width="10" height="20"/></pattern></defs><rect width="100" height="100" fill="url(%23buildings)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            z-index: 2;
            position: relative;
        }

        .hero-text {
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Search Card */
        .search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 800px;
        }

        /* Search Input Row */
        .search-input-row {
            display: flex;
            gap: 0;
            margin-bottom: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .search-icon {
            display: flex;
            align-items: center;
            padding: 0 15px;
            background: white;
            color: #3182ce;
            font-size: 18px;
        }

        .keyword-input {
            flex: 1;
            border: none;
            padding: 16px 20px;
            font-size: 16px;
            outline: none;
            background: transparent;
        }

        .keyword-input::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        /* Category Tabs */
        .category-tabs {
            display: flex;
            background: #f7fafc;
            border-radius: 50px;
            padding: 4px;
            margin-left: auto;
            width: 200px;
            border: 2px solid #e2e8f0;
        }

        .category-tab {
            flex: 1;
            background: none;
            border: none;
            padding: 10px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #718096;
        }

        .category-tab.active {
            background: white;
            color: #3182ce;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .category-tab:hover:not(.active) {
            color: #4a5568;
            background: rgba(255, 255, 255, 0.5);
        }

        /* Filters Row */
        .filters-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .filter-select {
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            background: white;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 16px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 48px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .filter-select:hover {
            border-color: #cbd5e0;
        }

        /* Action Row */
        .action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .search-button {
            background: linear-gradient(135deg, #3182ce, #4299e1);
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(49, 130, 206, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(49, 130, 206, 0.4);
            background: linear-gradient(135deg, #2c5aa0, #3182ce);
        }

        .search-button:active {
            transform: translateY(0);
            box-shadow: 0 8px 25px rgba(49, 130, 206, 0.3);
        }

        /* Features Pill */
        .features-pill {
            background: rgba(49, 130, 206, 0.1);
            color: #3182ce;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            border: 2px solid rgba(49, 130, 206, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .features-pill:hover {
            background: rgba(49, 130, 206, 0.15);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.2);
        }

        .features-pill::before {
            content: "💡";
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .search-container {
                padding: 20px;
                margin: 10px;
            }

            .search-input-row {
                flex-direction: column;
                border-radius: 12px;
            }

            .category-tabs {
                width: 100%;
                margin: 15px 0 0 0;
                order: 1;
            }

            .filters-row {
                grid-template-columns: 1fr;
            }

            .action-row {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .search-button {
                width: 100%;
                padding: 18px;
            }

            .advance-search {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .search-container {
                padding: 15px;
                border-radius: 15px;
            }

            .keyword-input {
                padding: 14px 16px;
                font-size: 14px;
            }

            .filter-select {
                padding: 14px 16px;
                font-size: 14px;
                padding-right: 44px;
            }

            .category-tab {
                padding: 8px 12px;
                font-size: 13px;
            }
        }

        /* Loading animation */
        .search-button.loading {
            position: relative;
            color: transparent;
        }

        .search-button.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Focus indicators for accessibility */
        .search-input-row:focus-within {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }

        .category-tab:focus {
            outline: 2px solid #3182ce;
            outline-offset: 2px;
        }

        .advance-search:focus {
            outline: 2px solid #3182ce;
            outline-offset: 2px;
            border-radius: 4px;
        }


        /* Floating Elements */
        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s;
            }

            .nav-menu.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .contact-info {
                display: none;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .search-row {
                grid-template-columns: 1fr;
            }

            .search-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .search-button {
                width: 100%;
            }

            .language-selector {
                position: static;
                margin: 20px;
                transform: none;
                width: fit-content;
            }
        }

        @media (max-width: 480px) {
            .search-card {
                margin: 20px;
                padding: 20px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .search-header {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
    {{-- <header class="header">
        <nav class="nav-container">
            <div class="logo">
                <div class="logo-icon">CB</div>
                <div>
                    <div style="font-size: 1.2rem;">COLDWELL</div>
                    <div style="font-size: 1.2rem;">BANKER</div>
                    <div style="font-size: 0.8rem; color: #666;">VALUE ADD REALTY</div>
                </div>
            </div>

            <ul class="nav-menu">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">Property</a></li>
                <li><a href="#">Blogs</a></li>
                <li><a href="#">Franchise</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <div class="contact-info">
                📞 +91-99020 66670
            </div>

            <button class="mobile-menu-toggle" onclick="toggleMenu()">☰</button>
        </nav>
    </header> --}}

    <!-- Hero Section -->
    {{-- <main class="hero">
        <!-- Floating Elements -->
        <div class="floating-element">🏢</div>
        <div class="floating-element">🏠</div>
        <div class="floating-element">🏘️</div>

        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">World Class Real Estate Service, Delivered.</h1>
                <p class="hero-subtitle">Find your dream property with our comprehensive real estate solutions. Professional
                    service, exceptional results.</p>
            </div>

            <div class="search-container">
                <!-- Search Input with Category Tabs -->
                <div class="search-input-row">
                    <div class="search-icon">🔍</div>
                    <input type="text" class="keyword-input" placeholder="Keyword" id="searchKeyword">
                    <div class="category-tabs">
                        <button class="category-tab active">
                            Category
                        </button>
                    </div>
                </div>

                <!-- Action Row -->
                <div class="action-row">
                    <button class="search-button">
                        Search
                    </button>
                </div>
            </div>

        </div>
    </main> --}}


    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid px-5 d-none border-bottom d-lg-block">
        <div class="row gx-0 align-items-center">
            <div class="col-lg-4 text-center text-lg-start mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#" class="text-muted me-2"> Help</a><small> / </small>
                    <a href="#" class="text-muted mx-2"> Support</a><small> / </small>
                    <a href="#" class="text-muted ms-2"> Contact</a>

                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
                <small class="text-dark">Call Us:</small>
                <a href="#" class="text-muted">(+012) 1234 567890</a>
            </div>

            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-muted me-2" data-bs-toggle="dropdown"><small>
                                USD</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"> Euro</a>
                            <a href="#" class="dropdown-item"> Dolar</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-muted mx-2" data-bs-toggle="dropdown"><small>
                                English</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"> English</a>
                            <a href="#" class="dropdown-item"> Turkish</a>
                            <a href="#" class="dropdown-item"> Spanol</a>
                            <a href="#" class="dropdown-item"> Italiano</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-muted ms-2" data-bs-toggle="dropdown"><small><i
                                    class="fa fa-home me-2"></i> My Dashboard</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="#" class="dropdown-item"> Login</a>
                            <a href="#" class="dropdown-item"> Wishlist</a>
                            <a href="#" class="dropdown-item"> My Card</a>
                            <a href="#" class="dropdown-item"> Notifications</a>
                            <a href="#" class="dropdown-item"> Account Settings</a>
                            <a href="#" class="dropdown-item"> My Account</a>
                            <a href="#" class="dropdown-item"> Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-5 py-4 d-none d-lg-block">
        <div class="row gx-0 align-items-center text-center">
            <div class="col-md-4 col-lg-3 text-center text-lg-start">
                <div class="d-inline-flex align-items-center">
                    <a href="" class="navbar-brand p-0">
                        <h1 class="display-5 text-primary m-0"><i
                                class="fas fa-shopping-bag text-secondary me-2"></i>Electro</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-6 text-center">
                <div class="position-relative ps-4">
                    <div class="d-flex border rounded-pill">
                        <input class="form-control border-0 rounded-pill w-100 py-3" type="text"
                            data-bs-target="#dropdownToggle123" placeholder="Search Looking For?">
                        <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                            <option value="All Category">All Category</option>
                            <option value="Pest Control-2">Category 1</option>
                            <option value="Pest Control-3">Category 2</option>
                            <option value="Pest Control-4">Category 3</option>
                            <option value="Pest Control-5">Category 4</option>
                        </select>
                        <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">
                    <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-random"></i></i></a>
                    <a href="#" class="text-muted d-flex align-items-center justify-content-center me-3"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-heart"></i></a>
                    <a href="#" class="text-muted d-flex align-items-center justify-content-center"><span
                            class="rounded-circle btn-md-square border"><i class="fas fa-shopping-cart"></i></span>
                        <span class="text-dark ms-2">$0.00</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar p-0">
        <div class="row gx-0 bg-primary px-5 align-items-center">
            <div class="col-lg-3 d-none d-lg-block">
                <nav class="navbar navbar-light position-relative" style="width: 250px;">
                    <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button"
                        data-bs-toggle="collapse" data-bs-target="#allCat">
                        <h4 class="m-0"><i class="fa fa-bars me-2"></i>All Categories</h4>
                    </button>
                    <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                        <div class="navbar-nav ms-auto py-0">
                            <ul class="list-unstyled categories-bars">
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">Accessories</a>
                                        <span>(3)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">Electronics & Computer</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">Laptops & Desktops</a>
                                        <span>(2)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">Mobiles & Tablets</a>
                                        <span>(8)</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">SmartPhone & Smart TV</a>
                                        <span>(5)</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-12 col-lg-9">
                <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                    <a href="" class="navbar-brand d-block d-lg-none">
                        <h1 class="display-5 text-secondary m-0"><i
                                class="fas fa-shopping-bag text-white me-2"></i>Electro</h1>
                        <!-- <img src="img/logo.png" alt="Logo"> -->
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars fa-1x"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                            <a href="single.html" class="nav-item nav-link">Single Page</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0">
                                    <a href="bestseller.html" class="dropdown-item">Bestseller</a>
                                    <a href="cart.html" class="dropdown-item">Cart Page</a>
                                    <a href="cheackout.html" class="dropdown-item">Cheackout</a>
                                    <a href="404.html" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <a href="contact.html" class="nav-item nav-link me-2">Contact</a>
                            <div class="nav-item dropdown d-block d-lg-none mb-3">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">All
                                    Category</a>
                                <div class="dropdown-menu m-0">
                                    <ul class="list-unstyled categories-bars">
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#">Accessories</a>
                                                <span>(3)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#">Electronics & Computer</a>
                                                <span>(5)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#">Laptops & Desktops</a>
                                                <span>(2)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#">Mobiles & Tablets</a>
                                                <span>(8)</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="categories-bars-item">
                                                <a href="#">SmartPhone & Smart TV</a>
                                                <span>(5)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0"><i
                                class="fa fa-mobile-alt me-2"></i> +0123 456 7890</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="header-carousel owl-carousel bg-light py-5">
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="img/carousel-1.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A $400</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#">Shop Now</a>
                        </div>
                    </div>
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="img/carousel-2.png" class="img-fluid w-100" alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Save Up To A $200</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">On Selected
                                Laptops & Desktop Or Smartphone</h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner h-100">
                    <img src="img/header-img.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;"
                        alt="Image">
                    <div class="carousel-banner-offer">
                        <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Save $48.00</p>
                        <p class="text-primary fs-5 fw-bold mb-0">Special Offer</p>
                    </div>
                    <div class="carousel-banner">
                        <div class="carousel-banner-content text-center p-4">
                            <a href="#" class="d-block mb-2">SmartPhone</a>
                            <a href="#" class="d-block text-white fs-3">Apple iPad Mini <br> G2356</a>
                            <del class="me-2 text-white fs-5">$1,250.00</del>
                            <span class="text-primary fs-5">$1,050.00</span>
                        </div>
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Return</h6>
                            <p class="mb-0">30 days money back guarantee!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Free Shipping</h6>
                            <p class="mb-0">Free shipping on all order</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Support 24/7</h6>
                            <p class="mb-0">We support online 24 hrs a day</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Receive Gift Card</h6>
                            <p class="mb-0">Recieve gift all over oder $50</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Secure Payment</h6>
                            <p class="mb-0">We Value Your Security</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Online Service</h6>
                            <p class="mb-0">Free return products in 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->

    <!-- Products Offer Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <a href="#"
                        class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Camera for You!</p>
                            <h3 class="text-primary">Smart Camera</h3>
                            <h1 class="display-3 text-secondary mb-0">40% <span class="text-primary fw-normal">Off</span>
                            </h1>
                        </div>
                        <img src="img/product-1.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <a href="#"
                        class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                        <div>
                            <p class="text-muted mb-3">Find The Best Whatches for You!</p>
                            <h3 class="text-primary">Smart Whatch</h3>
                            <h1 class="display-3 text-secondary mb-0">20% <span class="text-primary fw-normal">Off</span>
                            </h1>
                        </div>
                        <img src="img/product-2.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Offer End -->


    <!-- Our Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">New Arrivals</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Featured</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Top Selling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top"
                                                alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-4.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-sale">sale</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-5.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-6.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-7.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-sale">Sale</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-8.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-9.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-10.png" class="img-fluid w-100 rounded-top"
                                                alt="">
                                            <div class="product-sale">Sale</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-3.png" class="img-fluid rounded-top" alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-4.png" class="img-fluid w-100 rounded-top"
                                                alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-5.png" class="img-fluid w-100 rounded-top"
                                                alt="">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-6.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-new">New</div>
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-9.png" class="img-fluid w-100 rounded-top"
                                                alt="">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-10.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-11.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-12.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-14.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-15.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-17.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="product-item rounded wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="product-item-inner border rounded">
                                        <div class="product-item-inner-item">
                                            <img src="img/product-16.png" class="img-fluid w-100 rounded-top"
                                                alt="Image">
                                            <div class="product-details">
                                                <a href="#"><i class="fa fa-eye fa-1x"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center rounded-bottom p-4">
                                            <a href="#" class="d-block mb-2">SmartPhone</a>
                                            <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                            <del class="me-2 fs-5">$1,250.00</del>
                                            <span class="text-primary fs-5">$1,050.00</span>
                                        </div>
                                    </div>
                                    <div
                                        class="product-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                                        <a href="#"
                                            class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star text-primary"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-random"></i></i></a>
                                                <a href="#"
                                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                        class="rounded-circle btn-sm-square border"><i
                                                            class="fas fa-heart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Products End -->

    <!-- Product Banner Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <a href="#">
                        <div class="bg-primary rounded position-relative">
                            <img src="img/product-banner.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(255, 255, 255, 0.5);">
                                <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                                <p class="fs-4 text-muted">$899.99</p>
                                <a href="#" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop
                                    Now</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <a href="#">
                        <div class="text-center bg-primary rounded position-relative">
                            <img src="img/product-banner-2.jpg" class="img-fluid w-100" alt="">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                style="background: rgba(242, 139, 0, 0.5);">
                                <h2 class="display-2 text-secondary">SALE</h2>
                                <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                                <a href="#"
                                    class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop
                                    Now</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Banner End -->

    <!-- Product List Satrt -->
    <div class="container-fluid products productList overflow-hidden">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Products</h4>
                <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">All Product Items</h1>
            </div>
            <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="productImg-carousel owl-carousel productList-item">
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-4.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-4.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-6.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-7.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="productImg-carousel owl-carousel productList-item">
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-8.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-9.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-10.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-11.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="productImg-carousel owl-carousel productList-item">
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-12.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-13.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-14.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-15.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="productImg-carousel owl-carousel productList-item">
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-16.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-17.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="productImg-item products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-3.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->

    <!-- Bestseller Products Start -->
    <div class="container-fluid products pb-5">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 700px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Bestseller Products</h4>
                <p class="mb-0 wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Modi, asperiores ducimus sint quos tempore officia similique quia? Libero, pariatur
                    consectetur?</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-3.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-4.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-5.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-6.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-7.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <img src="img/product-11.png" class="img-fluid w-100 h-100" alt="Image">
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="#"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="#" class="d-block mb-2">SmartPhone</a>
                                    <a href="#" class="d-block h4">Apple iPad Mini <br> G2356</a>
                                    <del class="me-2 fs-5">$1,250.00</del>
                                    <span class="text-primary fs-5">$1,050.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i
                                            class="fas fa-random"></i></i></a>
                                <a href="#"
                                    class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bestseller Products End -->


    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Address</h4>
                            <p class="mb-2">123 Street New York.USA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Mail Us</h4>
                            <p class="mb-2">info@example.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Telephone</h4>
                            <p class="mb-2">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Yoursite@ex.com</h4>
                            <p class="mb-2">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <h4 class="text-primary mb-4">Newsletter</h4>
                            <p class="mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit
                                amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
                            <div class="position-relative mx-auto rounded-pill">
                                <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                    placeholder="Enter your email">
                                <button type="button"
                                    class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-primary mb-4">Customer Service</h4>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Returns</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Order History</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Site Map</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Testimonials</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> My Account</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Unsubscribe
                            Notification</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-primary mb-4">Information</h4>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> About Us</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Delivery
                            infomation</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Terms &
                            Conditions</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Warranty</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> FAQ</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Seller Login</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-primary mb-4">Extras</h4>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Brands</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Gift Vouchers</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Affiliates</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Wishlist</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Order History</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                        <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white">

                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a>.
                    Distributed By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
@endsection
