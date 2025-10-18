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

    <!-- Carousel Start -->
    {{-- <div class="container-fluid carousel bg-light px-0">
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
                    <img src="img/header-img.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Image">
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
                        <a href="#" class="btn btn-primary rounded-pill py-2 px-4"><i class="fas fa-shopping-cart me-2"></i>
                            Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Carousel End -->
    <style>
        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .hero {
            position: relative;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 5;
        }

        .hero__content {
            position: relative;
            z-index: 10;
            padding: 5vw;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .hero__pretitle {
            font-size: clamp(0.9rem, 1.2vw, 1.2rem);
            font-weight: 500;
            color: rgba(255, 240, 179, 0.8);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            filter: url(#water-distortion);
            will-change: filter;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .hero__title {
            font-size: clamp(3.5rem, 12vw, 10rem);
            font-weight: 900;
            color: #fff0b3;
            line-height: 0.95;
            letter-spacing: -0.03em;
            text-shadow: 0 0 30px rgba(255, 240, 179, 0.4);
            filter: url(#water-distortion);
            will-change: filter;
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .hero__title span {
            display: block;
            background: linear-gradient(135deg, #fff0b3 0%, #a8d8ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero__subtitle {
            font-size: clamp(1.2rem, 2.5vw, 2.2rem);
            font-weight: 300;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.4;
            max-width: 800px;
            margin-bottom: 3rem;
            filter: url(#water-distortion);
            will-change: filter;
            animation: fadeInUp 1s ease-out 0.7s both;
        }

        .hero__cta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .cta-button {
            padding: 1.2rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .cta-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .cta-button span {
            position: relative;
            z-index: 1;
        }

        .cta-button--primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #000;
            box-shadow: 0 10px 40px rgba(79, 172, 254, 0.4);
        }

        .cta-button--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(79, 172, 254, 0.6);
        }

        .cta-button--secondary {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .cta-button--secondary:hover {
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
        }

        .hero__features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 5rem;
            animation: fadeInUp 1s ease-out 1.1s both;
        }

        .feature {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(79, 172, 254, 0.3);
            transform: translateY(-5px);
        }

        .feature__icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px rgba(79, 172, 254, 0.5));
        }

        .feature__title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff0b3;
            margin-bottom: 0.5rem;
        }

        .feature__text {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        #svg-filters {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .progress-container {
            width: 300px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #4facfe, #00f2fe);
            border-radius: 2px;
            transition: width 0.1s ease-out;
        }

        .progress-percentage {
            font-size: 2rem;
            font-weight: 600;
            color: #fff0b3;
            margin-bottom: 10px;
        }

        .loading-text {
            font-size: 1rem;
            color: rgba(255, 240, 179, 0.7);
            font-weight: 300;
            text-align: center;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .hero__content {
                padding: 8vh 6vw;
            }

            .hero__pretitle {
                font-size: 0.8rem;
                margin-bottom: 1rem;
            }

            .hero__title {
                font-size: clamp(2.5rem, 10vw, 5rem);
                margin-bottom: 1.5rem;
            }

            .hero__subtitle {
                font-size: clamp(1rem, 4vw, 1.5rem);
                margin-bottom: 2rem;
            }

            .hero__cta {
                flex-direction: column;
                gap: 1rem;
            }

            .cta-button {
                width: 100%;
                text-align: center;
                padding: 1rem 2rem;
            }

            .hero__features {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 3rem;
            }

            .progress-container {
                width: 250px;
            }
        }
    </style>
    <svg id="svg-filters">
        <defs>
            <filter id="water-distortion" x="-20%" y="-20%" width="140%" height="140%">
                <feTurbulence id="turbulence" baseFrequency="0.015 0.01" numOctaves="2" result="noise" />
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="8" />
            </filter>
        </defs>
    </svg>

    <div class="loader" id="loader">
        <div class="progress-percentage" id="progress-percentage">0%</div>
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
        <div class="loading-text">Loading a beautiful experience for you</div>
    </div>

    <main class="hero" id="hero">
        <div class="hero__content">
            <div class="hero__pretitle">Pure Water Technology</div>
            <h1 class="hero__title">
                Pure Aqua
                <span>Tech</span>
            </h1>
            <p class="hero__subtitle">
                Advanced water purification solutions for a healthier tomorrow.
                Experience crystal-clear purity with cutting-edge filtration technology.
            </p>
            <div class="hero__cta">
                <a href="#products" class="cta-button cta-button--primary">
                    <span>Explore Solutions</span>
                </a>
                <a href="#contact" class="cta-button cta-button--secondary">
                    <span>Get a Quote</span>
                </a>
            </div>

            <div class="hero__features">
                <div class="feature">
                    <div class="feature__icon">💧</div>
                    <div class="feature__title">99.9% Purity</div>
                    <div class="feature__text">Advanced filtration removes all impurities</div>
                </div>
                <div class="feature">
                    <div class="feature__icon">🌊</div>
                    <div class="feature__title">Eco-Friendly</div>
                    <div class="feature__text">Sustainable water treatment systems</div>
                </div>
                <div class="feature">
                    <div class="feature__icon">⚡</div>
                    <div class="feature__title">Smart Tech</div>
                    <div class="feature__text">IoT-enabled monitoring & control</div>
                </div>
                <div class="feature">
                    <div class="feature__icon">🛡️</div>
                    <div class="feature__title">Certified Safe</div>
                    <div class="feature__text">ISO & NSF certified products</div>
                </div>
            </div>
        </div>
    </main>

    <script type="module">
        import * as THREE from "https://esm.sh/three@0.175.0";

        class App {
            constructor() {
                this.settings = {
                    damping: 0.98,
                    tension: 0.02,
                    resolution: 512,
                    rippleStrength: 1.0,
                    mouseIntensity: 0.3,
                    clickIntensity: 2.0,
                    rippleRadius: 20,
                    autoDrops: true,
                    autoDropInterval: 3000,
                    autoDropIntensity: 1.0,
                    performanceMode: true
                };

                this.gradientColors = {
                    colorA1: [0.2, 0.5, 0.8],
                    colorA2: [0.1, 0.3, 0.6],
                    colorB1: [0.3, 0.7, 0.9],
                    colorB2: [0.2, 0.4, 0.7]
                };

                this.lastMousePosition = { x: 0, y: 0 };
                this.mouseThrottleTime = 0;
                this.loadingProgress = 0;
                this.isLoaded = false;

                this.startLoading();
            }

            init() {
                this.renderer = new THREE.WebGLRenderer({
                    antialias: true,
                    powerPreference: "high-performance"
                });
                this.renderer.setSize(window.innerWidth, window.innerHeight);
                this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                document.body.appendChild(this.renderer.domElement);

                this.scene = new THREE.Scene();
                this.camera = new THREE.OrthographicCamera(
                    -window.innerWidth / 2,
                    window.innerWidth / 2,
                    window.innerHeight / 2,
                    -window.innerHeight / 2,
                    0.1,
                    1000
                );
                this.camera.position.z = 10;

                this.clock = new THREE.Clock();

                this.initWaterRipple();
                this.createBackground();
                this.bindEvents();
                this.setupAutoDrops();
                this.tick();
            }

            startLoading() {
                const progressBar = document.getElementById("progress-bar");
                const progressPercentage = document.getElementById("progress-percentage");
                const loader = document.getElementById("loader");

                const loadingInterval = setInterval(() => {
                    this.loadingProgress += Math.random() * 3 + 1;

                    if (this.loadingProgress >= 100) {
                        this.loadingProgress = 100;
                        clearInterval(loadingInterval);

                        progressBar.style.width = "100%";
                        progressPercentage.textContent = "100%";

                        setTimeout(() => {
                            this.init();

                            setTimeout(() => {
                                loader.classList.add("hidden");
                                this.isLoaded = true;

                                setTimeout(() => {
                                    const centerX = window.innerWidth / 2;
                                    const centerY = window.innerHeight / 2;
                                    this.addRipple(centerX, centerY, 1.5);
                                }, 300);
                            }, 500);
                        }, 300);
                    } else {
                        progressBar.style.width = this.loadingProgress + "%";
                        progressPercentage.textContent = Math.floor(this.loadingProgress) + "%";
                    }
                }, 50);
            }

            initWaterRipple() {
                const resolution = this.settings.resolution;

                this.waterBuffers = {
                    current: new Float32Array(resolution * resolution),
                    previous: new Float32Array(resolution * resolution)
                };

                this.waterTexture = new THREE.DataTexture(
                    this.waterBuffers.current,
                    resolution,
                    resolution,
                    THREE.RedFormat,
                    THREE.FloatType
                );
                this.waterTexture.minFilter = THREE.LinearFilter;
                this.waterTexture.magFilter = THREE.LinearFilter;
                this.waterTexture.needsUpdate = true;
            }

            createBackground() {
                const backgroundShader = {
                    uniforms: {
                        waterTexture: { value: this.waterTexture },
                        rippleStrength: { value: this.settings.rippleStrength },
                        resolution: {
                            value: new THREE.Vector2(window.innerWidth, window.innerHeight)
                        },
                        time: { value: 0 },
                        colorA1: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorA1[0],
                                this.gradientColors.colorA1[1],
                                this.gradientColors.colorA1[2]
                            )
                        },
                        colorA2: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorA2[0],
                                this.gradientColors.colorA2[1],
                                this.gradientColors.colorA2[2]
                            )
                        },
                        colorB1: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorB1[0],
                                this.gradientColors.colorB1[1],
                                this.gradientColors.colorB1[2]
                            )
                        },
                        colorB2: {
                            value: new THREE.Vector3(
                                this.gradientColors.colorB2[0],
                                this.gradientColors.colorB2[1],
                                this.gradientColors.colorB2[2]
                            )
                        }
                    },
                    vertexShader: `
                            varying vec2 vUv;

                            void main() {
                                vUv = uv;
                                gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                            }
                        `,
                    fragmentShader: `
                            uniform sampler2D waterTexture;
                            uniform float rippleStrength;
                            uniform vec2 resolution;
                            uniform float time;
                            uniform vec3 colorA1;
                            uniform vec3 colorA2;
                            uniform vec3 colorB1;
                            uniform vec3 colorB2;
                            varying vec2 vUv;

                            float S(float a, float b, float t) {
                                return smoothstep(a, b, t);
                            }

                            mat2 Rot(float a) {
                                float s = sin(a);
                                float c = cos(a);
                                return mat2(c, -s, s, c);
                            }

                            float noise(vec2 p) {
                                vec2 ip = floor(p);
                                vec2 fp = fract(p);
                                float a = fract(sin(dot(ip, vec2(12.9898, 78.233))) * 43758.5453);
                                float b = fract(sin(dot(ip + vec2(1.0, 0.0), vec2(12.9898, 78.233))) * 43758.5453);
                                float c = fract(sin(dot(ip + vec2(0.0, 1.0), vec2(12.9898, 78.233))) * 43758.5453);
                                float d = fract(sin(dot(ip + vec2(1.0, 1.0), vec2(12.9898, 78.233))) * 43758.5453);

                                fp = fp * fp * (3.0 - 2.0 * fp);

                                return mix(mix(a, b, fp.x), mix(c, d, fp.x), fp.y);
                            }

                            void main() {
                                float waterHeight = texture2D(waterTexture, vUv).r;

                                float step = 1.0 / resolution.x;
                                vec2 distortion = vec2(
                                    texture2D(waterTexture, vec2(vUv.x + step, vUv.y)).r - texture2D(waterTexture, vec2(vUv.x - step, vUv.y)).r,
                                    texture2D(waterTexture, vec2(vUv.x, vUv.y + step)).r - texture2D(waterTexture, vec2(vUv.x, vUv.y - step)).r
                                ) * rippleStrength * 5.0;

                                vec2 tuv = vUv + distortion;
                                tuv -= 0.5;

                                float ratio = resolution.x / resolution.y;
                                tuv.y *= 1.0/ratio;

                                vec3 layer1 = mix(colorA1, colorA2, S(-0.3, 0.2, (tuv*Rot(radians(-5.0))).x));
                                vec3 layer2 = mix(colorB1, colorB2, S(-0.3, 0.2, (tuv*Rot(radians(-5.0))).x));
                                vec3 finalComp = mix(layer1, layer2, S(0.5, -0.3, tuv.y));

                                float noiseValue = noise(tuv * 20.0 + time * 0.1) * 0.03;
                                finalComp += vec3(noiseValue);

                                float vignette = 1.0 - smoothstep(0.5, 1.5, length(tuv * 1.5));
                                finalComp *= mix(0.95, 1.0, vignette);

                                gl_FragColor = vec4(finalComp, 1.0);
                            }
                        `
                };

                const geometry = new THREE.PlaneGeometry(
                    window.innerWidth,
                    window.innerHeight
                );
                this.backgroundMaterial = new THREE.ShaderMaterial({
                    uniforms: backgroundShader.uniforms,
                    vertexShader: backgroundShader.vertexShader,
                    fragmentShader: backgroundShader.fragmentShader
                });

                const mesh = new THREE.Mesh(geometry, this.backgroundMaterial);
                this.scene.add(mesh);
            }

            updateWaterSimulation() {
                const { current, previous } = this.waterBuffers;
                const { damping, tension, resolution } = this.settings;

                const safeTension = Math.min(tension, 0.05);

                for (let i = 1; i < resolution - 1; i++) {
                    for (let j = 1; j < resolution - 1; j++) {
                        const index = i * resolution + j;

                        const top = previous[index - resolution];
                        const bottom = previous[index + resolution];
                        const left = previous[index - 1];
                        const right = previous[index + 1];

                        current[index] = (top + bottom + left + right) / 2 - current[index];
                        current[index] =
                            current[index] * damping + previous[index] * (1 - damping);
                        current[index] += (0 - previous[index]) * safeTension;
                        current[index] = Math.max(-1.0, Math.min(1.0, current[index]));
                    }
                }

                [this.waterBuffers.current, this.waterBuffers.previous] = [
                    this.waterBuffers.previous,
                    this.waterBuffers.current
                ];

                this.waterTexture.image.data = this.waterBuffers.current;
                this.waterTexture.needsUpdate = true;
            }

            addRipple(x, y, strength = 1.0) {
                const { resolution, rippleRadius } = this.settings;

                const normalizedX = x / window.innerWidth;
                const normalizedY = 1.0 - y / window.innerHeight;

                const texX = Math.floor(normalizedX * resolution);
                const texY = Math.floor(normalizedY * resolution);

                const radius = rippleRadius;
                const rippleStrength = strength;
                const radiusSquared = radius * radius;

                for (let i = -radius; i <= radius; i++) {
                    for (let j = -radius; j <= radius; j++) {
                        const distanceSquared = i * i + j * j;

                        if (distanceSquared <= radiusSquared) {
                            const posX = texX + i;
                            const posY = texY + j;

                            if (
                                posX >= 0 &&
                                posX < resolution &&
                                posY >= 0 &&
                                posY < resolution
                            ) {
                                const index = posY * resolution + posX;
                                const distance = Math.sqrt(distanceSquared);
                                const rippleValue =
                                    Math.cos(((distance / radius) * Math.PI) / 2) * rippleStrength;
                                this.waterBuffers.previous[index] += rippleValue;
                            }
                        }
                    }
                }
            }

            bindEvents() {
                window.addEventListener("mousemove", (ev) => {
                    const rect = this.renderer.domElement.getBoundingClientRect();
                    const x = ev.clientX - rect.left;
                    const y = ev.clientY - rect.top;

                    const now = performance.now();
                    if (now - this.mouseThrottleTime < 16) return;
                    this.mouseThrottleTime = now;

                    const dx = x - this.lastMousePosition.x;
                    const dy = y - this.lastMousePosition.y;
                    const distSquared = dx * dx + dy * dy;

                    if (distSquared > 5) {
                        this.addRipple(x, y, this.settings.mouseIntensity);
                        this.lastMousePosition.x = x;
                        this.lastMousePosition.y = y;
                    }
                });

                window.addEventListener("click", (e) => {
                    const rect = this.renderer.domElement.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    this.addRipple(x, y, this.settings.clickIntensity);
                });

                window.addEventListener("resize", () => {
                    const width = window.innerWidth;
                    const height = window.innerHeight;

                    this.camera.left = -width / 2;
                    this.camera.right = width / 2;
                    this.camera.top = height / 2;
                    this.camera.bottom = -height / 2;
                    this.camera.updateProjectionMatrix();

                    this.renderer.setSize(width, height);

                    if (this.backgroundMaterial) {
                        this.backgroundMaterial.uniforms.resolution.value.set(width, height);
                    }

                    if (this.scene.children[0] && this.scene.children[0].geometry) {
                        this.scene.children[0].geometry.dispose();
                        this.scene.children[0].geometry = new THREE.PlaneGeometry(
                            width,
                            height
                        );
                    }
                });
            }

            setupAutoDrops() {
                if (this.autoDropsInterval) {
                    clearInterval(this.autoDropsInterval);
                }

                if (this.settings.autoDrops) {
                    this.autoDropsInterval = setInterval(() => {
                        if (!this.settings.autoDrops) return;

                        const x = Math.random() * window.innerWidth;
                        const y = Math.random() * window.innerHeight;
                        this.addRipple(x, y, this.settings.autoDropIntensity);
                    }, this.settings.autoDropInterval);
                }
            }

            updateTextDistortion() {
                const turbulence = document.getElementById("turbulence");
                if (turbulence) {
                    const time = this.clock.getElapsedTime();
                    const frequency1 = 0.015 + Math.sin(time * 0.5) * 0.005;
                    const frequency2 = 0.01 + Math.cos(time * 0.3) * 0.003;
                    turbulence.setAttribute("baseFrequency", `${frequency1} ${frequency2}`);
                }
            }

            tick() {
                this.updateWaterSimulation();
                this.updateTextDistortion();

                if (this.backgroundMaterial) {
                    this.backgroundMaterial.uniforms.rippleStrength.value = this.settings.rippleStrength;
                    this.backgroundMaterial.uniforms.time.value += this.clock.getDelta();
                }

                this.renderer.render(this.scene, this.camera);
                requestAnimationFrame(() => this.tick());
            }
        }

        window.addEventListener("DOMContentLoaded", () => {
            new App();
        });
    </script>
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
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
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
                    <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
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

    <!-- <div class="container-fluid product py-5">
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
        </div>-->

    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <!-- All Products Tab -->
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-all" data-category="all">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>

                            <!-- Dynamic Category Tabs -->
                            @foreach($categories as $index => $category)
                                <li class="nav-item mb-4">
                                    <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-{{ $category->id }}" data-category="{{ $category->id }}">
                                        <span class="text-dark" style="width: 130px;">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- All Products Tab -->
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div class="row g-4" id="products-container">
                            @foreach($products as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3 product-item-wrapper"
                                    data-category="{{ $product->category_id }}">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                                    class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">

                                                @if($product->featured)
                                                    <div class="product-new">Featured</div>
                                                @endif

                                                @if($product->discount > 0)
                                                    <div class="product-sale">Sale</div>
                                                @endif

                                                <div class="product-details">
                                                    {{-- - <a href="{{ route('product.show', $product->id) }}">
                                                        <i class="fa fa-eye fa-1x"></i>
                                                    </a>--}}
                                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}">
                                                        <i class="fa fa-eye fa-1x"></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                {{-- - <a href="#" class="d-block mb-2">{{ $product->category->name }}</a>--}}
                                                {{-- -<a href="{{ route('product.show', $product->id) }}" class="d-block h4">
                                                    {{ $product->name }}
                                                </a> --}}
                                                <style>
                                                    .product-name {
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 2;
                                                        /* limit to 2 lines */
                                                        -webkit-box-orient: vertical;
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        line-height: 1.4em;
                                                        max-height: 2.8em;
                                                        /* 2 lines * line height */
                                                        white-space: normal;
                                                    }
                                                </style>
                                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="d-block h4 product-name">
                                                    {{ $product->name }}
                                                </a>

                                                {{--<a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="d-block h4">
                                                    {{ $product->name }}
                                                </a>--}}

                                                @if($product->discount > 0)
                                                    <del class="me-2 fs-5">${{ number_format($product->price, 2) }}</del>
                                                    <span
                                                        class="text-primary fs-5">${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</span>
                                                @else
                                                    <span class="text-primary fs-5">${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="#"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart"
                                                data-product-id="{{ $product->id }}">
                                                <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= ($product->rating ?? 4))
                                                            <i class="fas fa-star text-primary"></i>
                                                        @else
                                                            <i class="fas fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        class="text-primary d-flex align-items-center justify-content-center me-3">
                                                        <span class="rounded-circle btn-sm-square border">
                                                            <i class="fas fa-random"></i>
                                                        </span>
                                                    </a>
                                                    <a href="#"
                                                        class="text-primary d-flex align-items-center justify-content-center me-0 wishlist-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <span class="rounded-circle btn-sm-square border">
                                                            <i class="fas fa-heart"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Individual Category Tabs -->
                    @foreach($categories as $category)
                        <div id="tab-{{ $category->id }}" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <!-- Products will be filtered and shown here via JavaScript -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categoryTabs = document.querySelectorAll('[data-category]');
            const allProducts = document.querySelectorAll('.product-item-wrapper');

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();

                    const categoryId = this.getAttribute('data-category');
                    const targetTabId = this.getAttribute('href');
                    const targetTab = document.querySelector(targetTabId);

                    // Remove active class from all tabs
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });

                    // Add active class to clicked tab
                    this.classList.add('active');
                    targetTab.classList.add('show', 'active');

                    // Filter and display products
                    if (categoryId === 'all') {
                        // Show all products in the main container
                        const mainContainer = document.querySelector('#tab-all .row');
                        mainContainer.innerHTML = '';

                        allProducts.forEach(product => {
                            mainContainer.appendChild(product.cloneNode(true));
                        });
                    } else {
                        // Filter products for specific category
                        const categoryContainer = targetTab.querySelector('.row');
                        categoryContainer.innerHTML = '';

                        allProducts.forEach(product => {
                            if (product.getAttribute('data-category') === categoryId) {
                                categoryContainer.appendChild(product.cloneNode(true));
                            }
                        });
                    }

                    // Re-initialize any animations or effects
                    if (typeof WOW !== 'undefined') {
                        new WOW().init();
                    }
                });
            });

            // Add to cart functionality
            document.addEventListener('click', function (e) {
                if (e.target.closest('.add-to-cart')) {
                    e.preventDefault();
                    const productId = e.target.closest('.add-to-cart').getAttribute('data-product-id');
                    // Add your cart logic here
                    console.log('Adding product to cart:', productId);
                }

                if (e.target.closest('.wishlist-btn')) {
                    e.preventDefault();
                    const productId = e.target.closest('.wishlist-btn').getAttribute('data-product-id');
                    // Add your wishlist logic here
                    console.log('Adding product to wishlist:', productId);
                }
            });
        });
    </script>

    <style>
        .product-item-wrapper {
            transition: all 0.3s ease;
        }

        .product-new {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 12px;
            z-index: 1;
        }

        .product-sale {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 12px;
            z-index: 1;
        }

        .nav-pills .nav-link.active {
            background-color: #007bff !important;
        }

        .nav-pills .nav-link.active span {
            color: white !important;
        }
    </style>
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
                                <a href="#" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
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
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></i></a>
                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bestseller Products End -->
@endsection