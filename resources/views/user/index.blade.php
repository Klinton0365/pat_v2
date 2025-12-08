@extends('user.layout.app')
@section('content')
    <style>
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
        /* .hero {
                background: linear-gradient(135deg, rgba(49, 130, 206, 0.9), rgba(72, 187, 120, 0.8)),
                    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f7fafc" width="1200" height="600"/><polygon fill="%23e2e8f0" points="0,600 300,400 600,450 900,300 1200,350 1200,600"/><polygon fill="%23cbd5e0" points="0,600 400,500 800,520 1200,400 1200,600"/></svg>');
                background-size: cover;
                background-position: center;
                min-height: 100vh;
                display: flex;
                align-items: center;
                position: relative;
                overflow: hidden;
            } */

        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 5;

            background:
                linear-gradient(135deg, rgba(49, 130, 206, 0.55), rgba(72, 187, 120, 0.55)),
                url("{{ asset('/img/HAppy family.png') }}");
            /* ← your image */

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            /* width: 100vw; */
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 5;
        }

        .hero__content {
            position: relative;
            z-index: 10;
            padding: 2vw 5vw;
            /* max-width: 1400px; */
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

    <main class="hero" id="hero">
        <div class="hero__content">
            <div class="hero__pretitle">Pure Water Technology</div>
            <h1 class="hero__title">
                Pure H²O
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

                this.init();
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

                setTimeout(() => {
                    const centerX = window.innerWidth / 2;
                    const centerY = window.innerHeight / 2;
                    this.addRipple(centerX, centerY, 1.5);
                }, 500);

                this.tick();
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
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        .feature-item {
            background: rgba(255, 255, 255, 0.05);
            border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(79, 172, 254, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .feature-item:hover::before {
            left: 100%;
        }

        .feature-content {
            padding: 2rem 1.5rem;
        }

        .feature-icon-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(79, 172, 254, 0.15);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .feature-item:hover .feature-icon-wrapper {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            transform: scale(1.1) rotate(-5deg);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        }

        .feature-icon-wrapper i {
            font-size: 1.8rem;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.4s ease;
        }

        .feature-item:hover .feature-icon-wrapper i {
            color: #000;
            transform: scale(1.05);
        }

        .feature-text h6 {
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .feature-item:hover .feature-text h6 {
            color: #4facfe;
        }

        .feature-text p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .feature-item {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }
        }

        @media (max-width: 767px) {
            .feature-content {
                padding: 1.5rem 1rem;
            }

            .feature-icon-wrapper {
                width: 50px;
                height: 50px;
            }

            .feature-icon-wrapper i {
                font-size: 1.5rem;
            }

            .feature-text h6 {
                font-size: 0.85rem;
            }

            .feature-text p {
                font-size: 0.8rem;
            }
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

        .fadeInUp:nth-child(1) {
            animation-delay: 0.1s;
        }

        .fadeInUp:nth-child(2) {
            animation-delay: 0.2s;
        }

        .fadeInUp:nth-child(3) {
            animation-delay: 0.3s;
        }

        .fadeInUp:nth-child(4) {
            animation-delay: 0.4s;
        }

        .fadeInUp:nth-child(5) {
            animation-delay: 0.5s;
        }

        .fadeInUp:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
    <div class="features-section">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Quality Guarantee</h6>
                                <p class="mb-0">30 days satisfaction guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Free Installation</h6>
                                <p class="mb-0">Professional setup included</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Support 24/7</h6>
                                <p class="mb-0">Round-the-clock assistance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Certified Products</h6>
                                <p class="mb-0">ISO & NSF certified systems</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-droplet"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Pure Water Tech</h6>
                                <p class="mb-0">96.9% filtration efficiency</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2 feature-item fadeInUp">
                    <div class="feature-content">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-wrapper">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="feature-text ms-3">
                                <h6 class="text-uppercase mb-2">Free Maintenance</h6>
                                <p class="mb-0">Annual service included</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->

    {{-- About Us --}}
    <style>
        .history-area {
            background: #f7f9fb;
            padding: 100px 0;
            position: relative;
            min-height: 100vh;
        }

        .title-bg-small {
            font-size: 14px;
            font-weight: 700;
            line-height: 24px;
            margin-bottom: 15px;
            color: #fff;
            background: #4facfe;
            display: inline-block;
            padding: 3px 18px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 36px;
            font-weight: 300;
            color: #101010;
            margin-bottom: 70px;
        }

        .section-title span {
            font-weight: 700;
        }

        .primary-bg {
            background: #4facfe;
        }

        .column-title {
            font-size: 36px;
            font-weight: 300;
            color: #101010;
            margin-bottom: 30px;
        }

        .column-title span {
            font-weight: 700;
        }

        #history-slid .history-content {
            background: #fff;
            padding: 35px;
            padding-left: 14px;
        }

        #history-slid .carousel-inner {
            margin-bottom: 45px;
        }

        #history-slid .carousel-item {
            background: #fff;
        }

        #history-slid .carousel-indicators {
            position: relative;
            left: 0%;
            z-index: 5;
            width: 100%;
            padding-left: 0;
            margin-left: 0%;
            text-align: center;
            list-style: none;
        }

        #history-slid .carousel-indicators:before {
            content: "";
            width: 100%;
            height: 2px;
            position: absolute;
            left: 0;
            top: 15px;
            background-color: #ddd;
            z-index: -1;
        }

        #history-slid .carousel-indicators li {
            display: inline-block;
            width: 70px;
            height: 35px;
            line-height: 35px;
            margin: 0 35px;
            text-indent: 0px;
            cursor: pointer;
            color: #101010;
            border: 0px solid #fff;
            border-radius: 0px;
            margin-top: 40px;
            font-weight: 700;
            font-size: 16px;
            position: relative;
            background: transparent;
            transition: all 0.3s ease;
        }

        #history-slid .carousel-indicators li:hover {
            transform: translateY(-3px);
        }

        #history-slid .carousel-indicators li:before {
            position: absolute;
            top: -30px;
            left: 50%;
            display: inline-block;
            width: 12px;
            height: 12px;
            content: "";
            border-radius: 50%;
            background: #101010;
            margin-left: -7px;
            transition: all 0.3s ease;
        }

        #history-slid .carousel-indicators li.active {
            line-height: 35px;
            box-shadow: 0px 20px 30px 0px rgba(0, 0, 0, 0.15);
            color: #4facfe;
            background: #fff;
        }

        #history-slid .carousel-indicators li.active::before {
            background: #4facfe;
        }

        #history-slid .carousel-indicators li.active:after {
            position: absolute;
            top: -34px;
            left: 44%;
            display: inline-block;
            width: 20px;
            height: 20px;
            content: "";
            border-radius: 50%;
            margin-left: -7px;
            border: 1px solid #4facfe;
        }

        #history-slid .carousel-item-next,
        #history-slid .carousel-item-prev,
        #history-slid .carousel-item.active {
            display: flex;
        }

        .history-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Scroll Animation Styles */
        .fade-in-up {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .fade-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .scale-in {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .scale-in.visible {
            opacity: 1;
            transform: scale(1);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
        }

        .delay-3 {
            transition-delay: 0.3s;
        }

        .delay-4 {
            transition-delay: 0.4s;
        }

        @media (max-width: 991px) {
            #history-slid .carousel-item {
                flex-direction: column;
            }

            #history-slid .carousel-indicators li {
                margin: 0 15px;
                width: 60px;
            }
        }
    </style>

    <section class="history-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="title-bg-small fade-in-up">About us</p>
                    <h3 class="section-title fade-in-up delay-1">Our <span>History</span></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="history-slid" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner scale-in delay-2">
                            <!-- 2010 -->
                            <div class="carousel-item row">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/view-fantasy-tap.jpg') }}"
                                            alt="2010 Foundation" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Foundation Year</p>
                                        <h2 class="column-title">The <span>Beginning</span></h2>
                                        <p>Pure Aqua Tech was established with a vision to provide clean, safe drinking
                                            water solutions to communities across the region.</p>
                                        <p>Starting with a small team of dedicated engineers, we began our journey to
                                            revolutionize water purification technology and make clean water accessible to
                                            all.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2015 -->
                            <div class="carousel-item row">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/rm373batch10-207.jpg') }}"
                                            alt="2015 Innovation" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Innovation Milestone</p>
                                        <h2 class="column-title">Advanced <span>RO Technology</span></h2>
                                        <p>Launched our first advanced Reverse Osmosis system with multi-stage filtration,
                                            achieving 99.9% purification efficiency.</p>
                                        <p>This breakthrough technology set new industry standards and earned us ISO
                                            certification for quality excellence and customer satisfaction.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2018 -->
                            <div class="carousel-item row">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/2212.i121.024.jpg') }}"
                                            alt="2018 Expansion" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Market Expansion</p>
                                        <h2 class="column-title">Regional <span>Growth</span></h2>
                                        <p>Expanded operations to serve over 50 cities, installing water purification
                                            systems in thousands of homes and businesses nationwide.</p>
                                        <p>Established dedicated service centers to provide 24/7 customer support and
                                            maintenance services across all regions we operate in.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2020 - Active -->
                            <div class="carousel-item row active">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/online-shopping-concept.jpg') }}"
                                            alt="2020 Smart Technology" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Digital Revolution</p>
                                        <h2 class="column-title">Smart <span>IoT Systems</span></h2>
                                        <p>Introduced IoT-enabled water purifiers with real-time monitoring, automatic
                                            filter alerts, and mobile app connectivity for enhanced user experience.</p>
                                        <p>Our smart systems allow users to track water quality, consumption patterns, and
                                            schedule maintenance through their smartphones seamlessly.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2022 -->
                            <div class="carousel-item row">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/view-fantasy.jpg') }}"
                                            alt="2022 Sustainability" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Green Initiative</p>
                                        <h2 class="column-title">Eco-Friendly <span>Solutions</span></h2>
                                        <p>Launched our sustainable water purification line with zero-waste technology and
                                            energy-efficient operations to protect the environment.</p>
                                        <p>Committed to reducing plastic waste by promoting reusable filter systems and
                                            eco-conscious manufacturing processes throughout production.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2024 -->
                            <div class="carousel-item row">
                                <div class="col-lg-6 col-md-12 pl-0">
                                    <div class="history-img">
                                        <img class="img-fluid" src="{{ asset('img/about/18375.jpg') }}"
                                            alt="2024 Recognition" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 pr-0">
                                    <div class="history-content">
                                        <p class="title-bg-small primary-bg">Industry Leader</p>
                                        <h2 class="column-title">Award <span>Winning</span></h2>
                                        <p>Recognized as the leading water purification company with multiple industry
                                            awards for innovation and exceptional customer satisfaction.</p>
                                        <p>Achieved NSF International certification and became the trusted choice for over
                                            100,000 satisfied customers nationwide and growing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Indicators -->
                        <ol class="carousel-indicators text-center fade-in-up delay-3">
                            <li data-target="#history-slid" data-slide-to="0">2010</li>
                            <li data-target="#history-slid" data-slide-to="1">2015</li>
                            <li data-target="#history-slid" data-slide-to="2">2018</li>
                            <li data-target="#history-slid" data-slide-to="3" class="active">2020</li>
                            <li data-target="#history-slid" data-slide-to="4">2022</li>
                            <li data-target="#history-slid" data-slide-to="5">2025</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Scroll Animation Observer
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right, .scale-in');
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>


    {{-- Add this CSS to your main stylesheet --}}

    <style>
        .product-card-minimal {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card-minimal:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .product-card-minimal .image-wrapper {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
            aspect-ratio: 1;
        }

        .product-card-minimal .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card-minimal:hover .product-img {
            transform: scale(1.05);
        }

        .product-card-minimal .badges {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .product-card-minimal .badge {
            background: white;
            color: #333;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* .product-card-minimal .badge.featured {
                            background: #000;
                            color: white;
                        } */
        .product-card-minimal .badge.featured {
            background: linear-gradient(135deg, #3dcbffff 0%, #75c4ebff 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .product-card-minimal .badge.sale {
            background: #ff3b30;
            color: white;
        }

        .product-card-minimal .quick-view {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .product-card-minimal:hover .quick-view {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .product-card-minimal .quick-view-btn {
            background: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            text-decoration: none;
            color: #333;
        }

        .product-card-minimal .quick-view-btn:hover {
            transform: scale(1.1);
            background: #000;
            color: white;
        }

        .product-card-minimal .product-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-minimal .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #1d1d1f;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            min-height: 44px;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .product-card-minimal .product-name:hover {
            color: #0066cc;
        }

        .product-card-minimal .price-section {
            margin-bottom: 5px;
        }

        .product-card-minimal .price-current {
            font-size: 20px;
            font-weight: 700;
            color: #1d1d1f;
        }

        .product-card-minimal .price-original {
            font-size: 16px;
            color: #86868b;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .product-card-minimal .actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .product-card-minimal .btn-add-cart {
            flex: 1;
            background: #1d1d1f;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .product-card-minimal .btn-add-cart:hover {
            background: #000;
            transform: translateY(-2px);
            color: white;
        }

        .product-card-minimal .btn-wishlist {
            width: 44px;
            height: 44px;
            background: #f5f5f7;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #1d1d1f;
        }

        .product-card-minimal .btn-wishlist:hover {
            background: #ff3b30;
            color: white;
            transform: scale(1.05);
        }

        .product-card-minimal .rating-stars {
            display: flex;
            gap: 2px;
            margin: 8px;
        }

        .product-card-minimal .rating-stars i {
            font-size: 14px;
        }

        .product-card-minimal .rating-stars .text-primary {
            color: #ffd700 !important;
        }
    </style>

    <div class="container-fluid product py-5" style="background: white;">
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

                                    {{-- Minimal/Clean Product Card --}}
                                    <div class="product-card-minimal">
                                        <div class="image-wrapper">
                                            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                                class="product-img" alt="{{ $product->name }}">

                                            {{-- Badges --}}
                                            <div class="badges">
                                                @if($product->featured)
                                                    <span class="badge featured">Featured</span>
                                                @endif
                                                {{-- @if($product->discount > 0)
                                                <span class="badge sale">Sale</span>
                                                @endif --}}
                                            </div>

                                            {{-- Quick View Button --}}
                                            <div class="quick-view">
                                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="quick-view-btn">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="product-info">
                                            {{-- Product Name --}}
                                            <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                class="product-name">
                                                {{ $product->name }}
                                            </a>

                                            {{-- Price Section --}}
                                            <div class="price-section">
                                                @if($product->discount > 0)
                                                    <span class="price-current">
                                                        ₹{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                                                    </span>
                                                    <span class="price-original">
                                                        ₹{{ number_format($product->price, 2) }}
                                                    </span>
                                                @else
                                                    <span class="price-current">
                                                        ₹{{ number_format($product->price, 2) }}
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Rating Stars --}}
                                            <div class="rating-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($product->rating ?? 4))
                                                        <i class="fas fa-star text-primary"></i>
                                                    @else
                                                        <i class="fas fa-star" style="color: #d1d5db;"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            {{-- Actions --}}
                                            <div class="actions">
                                                <a href="{{ route('cart.add', $product->id) }}"
                                                    class="btn-add-cart add-to-cart">
                                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                </a>
                                                {{-- <a href="{{ route('cart.add', $product->id) }}"
                                                    class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart
                                                </a> --}}
                                                <a href="" class="btn-wishlist wishlist-btn"
                                                    data-product-id="{{ $product->id }}">
                                                    <i class="fas fa-heart"></i>
                                                </a>
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
            // Only select the actual navigation tab links, not product wrappers
            const categoryTabs = document.querySelectorAll('.nav-pills [data-category]');
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
                        const mainContainer = document.querySelector('#tab-all .row');
                        mainContainer.innerHTML = '';
                        allProducts.forEach(product => {
                            mainContainer.appendChild(product.cloneNode(true));
                        });
                    } else {
                        const categoryContainer = targetTab.querySelector('.row');
                        categoryContainer.innerHTML = '';
                        allProducts.forEach(product => {
                            if (product.getAttribute('data-category') === categoryId) {
                                categoryContainer.appendChild(product.cloneNode(true));
                            }
                        });
                    }

                    if (typeof WOW !== 'undefined') {
                        new WOW().init();
                    }
                });
            });

            // Add to cart functionality
            document.addEventListener('click', function (e) {
                const addToCartBtn = e.target.closest('.add-to-cart');
                const wishlistBtn = e.target.closest('.wishlist-btn');

                if (addToCartBtn) {
                    e.preventDefault();
                    const productId = addToCartBtn.getAttribute('data-product-id');
                    console.log('Adding product to cart:', productId);
                    // Add your cart logic here
                } else if (wishlistBtn) {
                    e.preventDefault();
                    const productId = wishlistBtn.getAttribute('data-product-id');
                    console.log('Adding product to wishlist:', productId);
                    // Add your wishlist logic here
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


    {{-- Service --}}
    <style>
        .services-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .services-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: start;
        }

        /* Left Content Section */
        .content-section {
            position: sticky;
            top: 100px;
        }

        .services-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #9ca3af;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .services-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .services-title .highlight {
            color: #6366f1;
        }

        .services-description {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .services-description-extra {
            font-size: 1rem;
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 35px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 35px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: #e0e7ff;
            color: #6366f1;
        }

        .btn-secondary:hover {
            background: #c7d2fe;
            transform: translateY(-2px);
        }

        /* Right Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .services-wrapper {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .content-section {
                position: static;
            }

            .services-title {
                font-size: 2.8rem;
            }
        }

        @media (max-width: 768px) {
            .services-section {
                padding: 60px 0;
            }

            .services-title {
                font-size: 2.2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .services-title {
                font-size: 1.8rem;
            }

            .service-card {
                padding: 30px 20px;
            }

            .service-icon {
                width: 60px;
                height: 60px;
            }

            .service-icon svg {
                width: 28px;
                height: 28px;
            }
        }
    </style>

    <style>
        .holderCircle {
            width: 500px;
            height: 500px;
            border-radius: 100%;
            margin: 60px auto;
            position: relative;
        }


        .dotCircle {
            width: 100%;
            height: 100%;
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 100%;
            z-index: 20;
        }

        .dotCircle .itemDot {
            display: block;
            width: 80px;
            height: 80px;
            position: absolute;
            background: #ffffff;
            color: #7d4ac7;
            border-radius: 20px;
            text-align: center;
            line-height: 80px;
            font-size: 30px;
            z-index: 3;
            cursor: pointer;
            border: 2px solid #e6e6e6;
        }

        .dotCircle .itemDot .forActive {
            width: 56px;
            height: 56px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: none;
        }

        .dotCircle .itemDot .forActive::after {
            content: '';
            width: 5px;
            height: 5px;
            border: 3px solid #7d4ac7;
            bottom: -31px;
            left: -14px;
            filter: blur(1px);
            position: absolute;
            border-radius: 100%;
        }

        .dotCircle .itemDot .forActive::before {
            content: '';
            width: 6px;
            height: 6px;
            filter: blur(5px);
            top: -15px;
            position: absolute;
            transform: rotate(-45deg);
            border: 6px solid #a733bb;
            right: -39px;
        }

        .dotCircle .itemDot.active .forActive {
            display: block;
        }

        .round {
            position: absolute;
            left: 40px;
            top: 45px;
            width: 410px;
            height: 410px;
            border: 2px dotted #a733bb;
            border-radius: 100%;
            -webkit-animation: rotation 100s infinite linear;
        }

        .dotCircle .itemDot:hover,
        .dotCircle .itemDot.active {
            color: #ffffff;
            transition: 0.5s;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d4ac7+0,a733bb+100 */
            background: #7d4ac7;
            /* Old browsers */
            background: -moz-linear-gradient(left, #7d4ac7 0%, #a733bb 100%);
            /* FF3.6-15 */
            background: -webkit-linear-gradient(left, #7d4ac7 0%, #a733bb 100%);
            /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to right, #7d4ac7 0%, #a733bb 100%);
            /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7d4ac7', endColorstr='#a733bb', GradientType=1);
            /* IE6-9 */
            border: 2px solid #ffffff;
            -webkit-box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13);
            -moz-box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13);
            box-shadow: 0 30px 30px 0 rgba(0, 0, 0, .13);
        }

        .dotCircle .itemDot {
            font-size: 40px;
        }

        .contentCircle {
            width: 250px;
            border-radius: 100%;
            color: #222222;
            position: relative;
            top: 150px;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .contentCircle .CirItem {
            border-radius: 100%;
            color: #222222;
            position: absolute;
            text-align: center;
            bottom: 0;
            left: 0;
            opacity: 0;
            transform: scale(0);
            transition: 0.5s;
            font-size: 15px;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            margin: auto;
            line-height: 250px;
        }

        .CirItem.active {
            z-index: 1;
            opacity: 1;
            transform: scale(1);
            transition: 0.5s;
        }

        .contentCircle .CirItem i {
            font-size: 180px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -90px;
            color: #000000;
            opacity: 0.1;
        }

        @media only screen and (min-width:300px) and (max-width:599px) {
            .holderCircle {
                /* width: 300px; height: 300px;*/
                margin: 110px auto;
            }

            .holderCircle::after {
                width: 100%;
                height: 100%;
            }

            .dotCircle {
                width: 100%;
                height: 100%;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                margin: auto;
            }
        }

        @media only screen and (min-width:600px) and (max-width:767px) {}

        @media only screen and (min-width:768px) and (max-width:991px) {}

        @media only screen and (min-width:992px) and (max-width:1199px) {}

        @media only screen and (min-width:1200px) and (max-width:1499px) {}

        .title-box .title {
            font-weight: 600;
            letter-spacing: 2px;
            position: relative;
            z-index: -1;
        }

        .title-box span {
            text-shadow: 0 10px 10px rgba(0, 0, 0, .15);
            font-weight: 800;
            color: #640178;
        }

        .title-box p {
            font-size: 17px;
            line-height: 2em;
        }
    </style>

    {{--
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <section class="services-section">
        <div class="container">
            <div class="services-wrapper">
                <!-- Left -->
                <div class="content-section">
                    <div class="services-label-wrapper">
                        <span class="services-label-icon">💧</span>
                        <p class="services-label">OUR SERVICES</p>
                    </div>

                    <h2 class="services-title">
                        Pure <span class="highlight">Aqua Tech</span><br>
                        <span class="highlight-underline">Services</span>
                    </h2>

                    <p class="services-description">
                        We provide <strong>end-to-end water purifier solutions</strong> for your home and office —
                        installation, repair, filter replacement, and more.
                    </p>

                    <p class="services-description-extra">
                        Ensure pure water and peace of mind with our certified technicians and fast response service.
                    </p>
                    <style>
                        /* Button Enhancements */
                        .button-group {
                            display: flex;
                            gap: 15px;
                            flex-wrap: wrap;
                            margin-bottom: 35px;
                        }

                        .btn {
                            padding: 16px 32px;
                            font-size: 1rem;
                            font-weight: 600;
                            border-radius: 12px;
                            text-decoration: none;
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                            display: inline-flex;
                            align-items: center;
                            gap: 10px;
                            border: none;
                            cursor: pointer;
                            position: relative;
                            overflow: hidden;
                        }

                        .btn::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: -100%;
                            width: 100%;
                            height: 100%;
                            background: rgba(255, 255, 255, 0.2);
                            transition: left 0.5s ease;
                        }

                        .btn:hover::before {
                            left: 100%;
                        }

                        .btn-icon {
                            width: 20px;
                            height: 20px;
                            flex-shrink: 0;
                        }

                        .btn-primary {
                            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                            color: white;
                            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
                        }

                        .btn-primary:hover {
                            transform: translateY(-3px);
                            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
                        }

                        .btn-secondary {
                            background: white;
                            color: #6366f1;
                            border: 2px solid #6366f1;
                        }

                        .btn-secondary:hover {
                            background: #6366f1;
                            color: white;
                            transform: translateY(-3px);
                            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
                        }

                        /* Trust Indicators */
                        .trust-indicators {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            padding: 25px 0;
                            border-top: 2px solid #e5e7eb;
                        }

                        .trust-item {
                            text-align: center;
                            flex: 1;
                        }

                        .trust-number {
                            font-size: 1.8rem;
                            font-weight: 800;
                            color: #6366f1;
                            margin-bottom: 5px;
                            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                        }

                        .trust-label {
                            font-size: 0.85rem;
                            color: #6b7280;
                            font-weight: 500;
                        }

                        .trust-divider {
                            width: 1px;
                            height: 40px;
                            background: linear-gradient(180deg, transparent 0%, #d1d5db 50%, transparent 100%);
                        }

                        /* Responsive Design */
                        @media (max-width: 1024px) {
                            .content-section {
                                position: static;
                                padding: 30px;
                            }

                            .services-title {
                                font-size: 2.8rem;
                            }
                        }

                        @media (max-width: 768px) {
                            .content-section {
                                padding: 25px;
                            }

                            .services-title {
                                font-size: 2.2rem;
                            }

                            .button-group {
                                flex-direction: column;
                            }

                            .btn {
                                width: 100%;
                                justify-content: center;
                            }

                            .trust-indicators {
                                flex-wrap: wrap;
                                gap: 20px;
                            }

                            .trust-divider {
                                display: none;
                            }

                            .trust-item {
                                flex: 0 0 calc(50% - 10px);
                            }
                        }

                        @media (max-width: 480px) {
                            .services-title {
                                font-size: 1.9rem;
                            }

                            .services-label-wrapper {
                                justify-content: center;
                            }

                            .features-quick-list {
                                padding: 15px;
                            }

                            .trust-item {
                                flex: 0 0 100%;
                            }
                        }
                    </style>

                    <div class="button-group">
                        <a href="#bookNow" class="btn btn-primary" onclick="openBookingModal()">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Book Service Now
                        </a>
                        <a href="#contact" class="btn btn-secondary">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            Call Us
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="trust-indicators">
                        <div class="trust-item">
                            <div class="trust-number">500+</div>
                            <div class="trust-label">Happy Customers</div>
                        </div>
                        <div class="trust-divider"></div>
                        <div class="trust-item">
                            <div class="trust-number">4.8★</div>
                            <div class="trust-label">Avg Rating</div>
                        </div>
                        <div class="trust-divider"></div>
                        <div class="trust-item">
                            <div class="trust-number">24/7</div>
                            <div class="trust-label">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Right Circular Section -->

                <!------ Include the above in your HEAD tag ---------->
                <section class="iq-features">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-12"></div>
                            <div class="col-lg-6 col-md-12">
                                <div class="holderCircle">
                                    <div class="round"></div>
                                    <div class="dotCircle">
                                        <span class="itemDot active itemDot1" data-tab="1">
                                            <i class="fa fa-wrench"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot2" data-tab="2">
                                            <i class="fa fa-tint"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot3" data-tab="3">
                                            <i class="fa fa-refresh"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot4" data-tab="4">
                                            <i class="fa fa-shield"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot5" data-tab="5">
                                            <i class="fa fa-cogs"></i>
                                            <span class="forActive"></span>
                                        </span>
                                        <span class="itemDot itemDot6" data-tab="6">
                                            <i class="fa fa-headset"></i>
                                            <span class="forActive"></span>
                                        </span>
                                    </div>
                                    <div class="contentCircle">
                                        <div class="CirItem title-box active CirItem1">
                                            <h2 class="title"><span>Installation</span></h2>
                                            <p>Get expert installation of all types of water purifiers for your home or
                                                office with quick, reliable service.</p>
                                            <i class="fa fa-wrench"></i>
                                        </div>
                                        <div class="CirItem title-box CirItem2">
                                            <h2 class="title"><span>Filter Replacement</span></h2>
                                            <p>Keep your water pure with regular filter and membrane replacements by
                                                certified technicians.</p>
                                            <i class="fa fa-tint"></i>
                                        </div>
                                        <div class="CirItem title-box CirItem3">
                                            <h2 class="title"><span>Maintenance</span></h2>
                                            <p>Scheduled maintenance ensures your purifier performs efficiently and extends
                                                its lifespan.</p>
                                            <i class="fa fa-refresh"></i>
                                        </div>
                                        <div class="CirItem title-box CirItem4">
                                            <h2 class="title"><span>Repairs</span></h2>
                                            <p>We fix all major RO, UV, and UF purifier brands — fast diagnosis and genuine
                                                parts guaranteed.</p>
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="CirItem title-box CirItem5">
                                            <h2 class="title"><span>AMC Plans</span></h2>
                                            <p>Enjoy year-round worry-free service with our affordable Annual Maintenance
                                                Contracts.</p>
                                            <i class="fa fa-cogs"></i>
                                        </div>
                                        <div class="CirItem title-box CirItem6">
                                            <h2 class="title"><span>24/7 Support</span></h2>
                                            <p>Our customer care team is available anytime for quick service bookings and
                                                troubleshooting.</p>
                                            <i class="fa fa-headset"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <script>

        let i = 2;


        $(document).ready(function () {
            var radius = 200;
            var fields = $('.itemDot');
            var container = $('.dotCircle');
            var width = container.width();
            radius = width / 2.5;

            var height = container.height();
            var angle = 0, step = (2 * Math.PI) / fields.length;
            fields.each(function () {
                var x = Math.round(width / 2 + radius * Math.cos(angle) - $(this).width() / 2);
                var y = Math.round(height / 2 + radius * Math.sin(angle) - $(this).height() / 2);
                if (window.console) {
                    console.log($(this).text(), x, y);
                }

                $(this).css({
                    left: x + 'px',
                    top: y + 'px'
                });
                angle += step;
            });


            $('.itemDot').click(function () {

                var dataTab = $(this).data("tab");
                $('.itemDot').removeClass('active');
                $(this).addClass('active');
                $('.CirItem').removeClass('active');
                $('.CirItem' + dataTab).addClass('active');
                i = dataTab;

                $('.dotCircle').css({
                    "transform": "rotate(" + (360 - (i - 1) * 36) + "deg)",
                    "transition": "2s"
                });
                $('.itemDot').css({
                    "transform": "rotate(" + ((i - 1) * 36) + "deg)",
                    "transition": "1s"
                });


            });

            setInterval(function () {
                var dataTab = $('.itemDot.active').data("tab");
                if (dataTab > 6 || i > 6) {
                    dataTab = 1;
                    i = 1;
                }
                $('.itemDot').removeClass('active');
                $('[data-tab="' + i + '"]').addClass('active');
                $('.CirItem').removeClass('active');
                $('.CirItem' + i).addClass('active');
                i++;


                $('.dotCircle').css({
                    "transform": "rotate(" + (360 - (i - 2) * 36) + "deg)",
                    "transition": "2s"
                });
                $('.itemDot').css({
                    "transform": "rotate(" + ((i - 2) * 36) + "deg)",
                    "transition": "1s"
                });

            }, 5000);

        });



    </script>

    <!-- Booking Modal -->
    <div id="bookingModal"
        style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.6); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:30px; border-radius:15px; width:90%; max-width:600px; position:relative;">
            <h3 class="text-center mb-3">Book Your Service</h3>
            <form id="serviceBookingForm">
                @csrf
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <label>Service Type</label>
                    <select name="service_type" class="form-control" required>
                        <option value="">Select Service</option>
                        <option>Installation</option>
                        <option>Maintenance</option>
                        <option>Filter Change</option>
                        <option>Repair</option>
                        <option>Water Testing</option>
                        <option>Customer Support</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label>Preferred Date</label>
                    <input type="date" name="preferred_date" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                    <label>Preferred Time</label>
                    <input type="time" name="preferred_time" class="form-control" required />
                </div>
                <input type="hidden" name="latitude" id="latitude" />
                <input type="hidden" name="longitude" id="longitude" />
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    <button type="button" class="btn btn-secondary" onclick="closeBookingModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBookingModal() {
            document.getElementById('bookingModal').style.display = 'flex';
            getLocation();
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').style.display = 'none';
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                });
            } else {
                alert("Geolocation is not supported by your browser.");
            }
        }

        $('#serviceBookingForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('service.book') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    alert(response.message);
                    $('#serviceBookingForm')[0].reset();
                    closeBookingModal();
                },
                error: function (xhr) {
                    alert("Please fill all required fields correctly.");
                }
            });
        });
    </script>

    <!-- Product Banner Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">

                @if($amountOffer)
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}">
                            <div class="bg-primary rounded position-relative">
                                <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}"
                                    class="img-fluid w-100 rounded" alt="{{ $amountOffer->title }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(255, 255, 255, 0.5);">

                                    <h3 class="display-5 text-primary">
                                        {{ $amountOffer->title }}
                                    </h3>

                                    <p class="fs-4 text-muted">
                                        ₹{{ number_format($amountOffer->offer_price, 2) }}
                                    </p>

                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                        class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif


                @if($percentageOffer)
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <a href="{{ route('product.show', [$product->id, $product->slug]) }}">
                            <div class="text-center bg-primary rounded position-relative">
                                <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}"
                                    class="img-fluid w-100 rounded" alt="{{ $percentageOffer->title }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(242, 139, 0, 0.5);">

                                    <h2 class="display-2 text-secondary">SALE</h2>
                                    <h4 class="display-5 text-white mb-4">
                                        Get UP To {{ $percentageOffer->offer_price }}% Off
                                    </h4>

                                    <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                        class="btn btn-secondary rounded-pill align-self-center py-2 px-4">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

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
                <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">All Category Products</h1>
            </div>
            <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
                @foreach($categories as $category)
                    <div class="productImg-carousel owl-carousel productList-item">

                        @foreach($category->products as $categoryProduct)
                            <div class="productImg-item products-mini-item border">
                                <div class="row g-0">
                                    <div class="col-5">
                                        <div class="products-mini-img border-end h-100">
                                            <img src="{{ asset('storage/' . $categoryProduct->main_image) }}"
                                                class="img-fluid w-100 h-100" alt="{{ $categoryProduct->name }}">
                                            <div class="products-mini-icon rounded-circle bg-primary">
                                                <a
                                                    href="{{ route('product.show', [$categoryProduct->id, $categoryProduct->slug]) }}">
                                                    <i class="fa fa-eye fa-1x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="products-mini-content p-3">
                                            <a href="#" class="d-block mb-2">{{ $category->name }}</a>

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
                                            <a href="{{ route('product.show', [$categoryProduct->id, $categoryProduct->slug]) }}"
                                                class="d-block h4 product-name">
                                                {{ $categoryProduct->name }}
                                            </a>
                                            @if($categoryProduct->discount > 0)
                                                <del class="me-2 fs-5">₹{{ number_format($categoryProduct->price, 2) }}</del>
                                                <span class="text-primary fs-5">
                                                    ₹{{ number_format($categoryProduct->price - ($categoryProduct->price * $categoryProduct->discount / 100), 2) }}
                                                </span>
                                            @else
                                                <span class="text-primary fs-5">₹{{ number_format($categoryProduct->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="products-mini-add border p-3">
                                    <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4">
                                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                    </a>
                                    <div class="d-flex">
                                        <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                                            <span class="rounded-circle btn-sm-square border">
                                                <i class="fas fa-random"></i>
                                            </span>
                                        </a>
                                        <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0">
                                            <span class="rounded-circle btn-sm-square border">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Product List End -->

    <!-- Bestseller Products Start -->
    {{-- <div class="container-fluid products pb-5">
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
    </div> --}}
    <!-- Bestseller Products End -->
@endsection