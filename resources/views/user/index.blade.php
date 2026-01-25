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

                this.lastMousePosition = {
                    x: 0,
                    y: 0
                };
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
                        waterTexture: {
                            value: this.waterTexture
                        },
                        rippleStrength: {
                            value: this.settings.rippleStrength
                        },
                        resolution: {
                            value: new THREE.Vector2(window.innerWidth, window.innerHeight)
                        },
                        time: {
                            value: 0
                        },
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
                const {
                    current,
                    previous
                } = this.waterBuffers;
                const {
                    damping,
                    tension,
                    resolution
                } = this.settings;

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
                const {
                    resolution,
                    rippleRadius
                } = this.settings;

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



    {{-- Professional About Us / History Section with Horizontal Timeline
    
    Features:
    - Horizontal scrollable timeline
    - Interactive year markers
    - Smooth animations on scroll
    - Mobile-responsive vertical fallback
    
    Color Psychology:
    - Primary Blue (#1e40af): Trust, professionalism
    - Success Green (#059669): Growth, progress
    - Clean design: Modern, premium feel
    --}}

    {{-- <style>
        :root {
            --timeline-primary: #1e40af;
            --timeline-primary-light: #3b82f6;
            --timeline-primary-dark: #1e3a8a;
            --timeline-accent: #4f46e5;
            --timeline-success: #059669;
            --timeline-warning: #f59e0b;
            --timeline-text-primary: #111827;
            --timeline-text-secondary: #4b5563;
            --timeline-text-muted: #9ca3af;
            --timeline-border: #e5e7eb;
            --timeline-bg-light: #f8fafc;
            --timeline-bg-card: #ffffff;
            --timeline-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --timeline-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --timeline-shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --timeline-radius: 12px;
            --timeline-radius-lg: 16px;
            --timeline-radius-xl: 24px;
        }

        /* ==================== ABOUT SECTION ==================== */
        .about-section {
            padding: 100px 0;
            background: linear-gradient(180deg, var(--timeline-bg-light) 0%, #ffffff 50%, var(--timeline-bg-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(79, 70, 229, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .about-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        /* Section Header */
        .about-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--timeline-primary) 0%, var(--timeline-accent) 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .about-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--timeline-text-primary);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .about-title .highlight {
            background: linear-gradient(135deg, var(--timeline-primary) 0%, var(--timeline-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-subtitle {
            font-size: 1.15rem;
            color: var(--timeline-text-secondary);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ==================== HORIZONTAL TIMELINE ==================== */
        .timeline-wrapper {
            position: relative;
            padding: 40px 0;
        }

        /* Timeline Container - Holds line and year markers together */
        .timeline-container {
            position: relative;
            padding: 60px 40px 80px;
        }

        /* Timeline Line - The horizontal bar */
        .timeline-line {
            position: absolute;
            top: 60px;
            left: 20px;
            right: 20px;
            height: 3px;
            background: linear-gradient(90deg, var(--timeline-primary) 0%, var(--timeline-primary-light) 50%, #cbd5e1 100%);
            border-radius: 2px;
        }

        /* Start dot */
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            background: var(--timeline-primary);
            border-radius: 50%;
        }

        /* End arrow */
        .timeline-line::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 14px solid #cbd5e1;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
        }

        /* Year Markers Container */
        .timeline-years {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        /* Individual Year Marker */
        .timeline-year {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        /* The dot that sits ON the line */
        .timeline-year-dot {
            width: 24px;
            height: 24px;
            background: var(--timeline-bg-card);
            border: 3px solid #cbd5e1;
            border-radius: 50%;
            position: relative;
            z-index: 2;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Inner dot */
        .timeline-year-dot::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #cbd5e1;
            border-radius: 50%;
            transition: all 0.3s;
        }

        /* Connecting line from dot to label */
        .timeline-year-connector {
            width: 2px;
            height: 30px;
            background: #e5e7eb;
            transition: all 0.3s;
        }

        /* Year label box */
        .timeline-year-label {
            margin-top: 8px;
            padding: 10px 20px;
            background: var(--timeline-bg-card);
            border: 2px solid var(--timeline-border);
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--timeline-text-secondary);
            transition: all 0.3s;
            box-shadow: var(--timeline-shadow);
        }

        /* Hover States */
        .timeline-year:hover .timeline-year-dot {
            border-color: var(--timeline-primary-light);
            transform: scale(1.15);
        }

        .timeline-year:hover .timeline-year-dot::before {
            background: var(--timeline-primary-light);
        }

        .timeline-year:hover .timeline-year-connector {
            background: var(--timeline-primary-light);
        }

        .timeline-year:hover .timeline-year-label {
            border-color: var(--timeline-primary-light);
            color: var(--timeline-primary);
        }

        /* Active State */
        .timeline-year.active .timeline-year-dot {
            border-color: var(--timeline-primary);
            background: var(--timeline-bg-card);
            transform: scale(1.2);
            box-shadow: 0 0 0 8px rgba(30, 64, 175, 0.15);
        }

        .timeline-year.active .timeline-year-dot::before {
            background: var(--timeline-primary);
            width: 10px;
            height: 10px;
        }

        .timeline-year.active .timeline-year-connector {
            background: var(--timeline-primary);
            width: 3px;
        }

        .timeline-year.active .timeline-year-label {
            background: var(--timeline-primary);
            border-color: var(--timeline-primary);
            color: white;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.35);
        }

        /* Timeline Content Cards */
        .timeline-content-wrapper {
            margin-top: 60px;
            position: relative;
            min-height: 500px;
        }

        .timeline-card {
            display: none;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .timeline-card.active {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            opacity: 1;
            transform: translateY(0);
        }

        .timeline-card-image {
            position: relative;
            border-radius: var(--timeline-radius-xl);
            overflow: hidden;
            box-shadow: var(--timeline-shadow-xl);
        }

        .timeline-card-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        .timeline-card-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s;
        }

        .timeline-card:hover .timeline-card-image img {
            transform: scale(1.05);
        }

        .timeline-card-image-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--timeline-primary);
            z-index: 2;
            box-shadow: var(--timeline-shadow);
        }

        .timeline-card-content {
            padding: 20px 0;
        }

        .timeline-card-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            color: var(--timeline-primary);
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .timeline-card-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--timeline-text-primary);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .timeline-card-title .highlight {
            background: linear-gradient(135deg, var(--timeline-primary) 0%, var(--timeline-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .timeline-card-text {
            font-size: 1rem;
            color: var(--timeline-text-secondary);
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .timeline-card-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .timeline-feature {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--timeline-bg-card);
            border: 1px solid var(--timeline-border);
            border-radius: var(--timeline-radius);
            font-size: 0.85rem;
            color: var(--timeline-text-secondary);
            transition: all 0.2s;
        }

        .timeline-feature:hover {
            border-color: var(--timeline-primary-light);
            color: var(--timeline-primary);
            background: #eff6ff;
        }

        .timeline-feature i {
            color: var(--timeline-success);
        }

        /* Stats Row */
        .timeline-stats {
            display: flex;
            gap: 32px;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid var(--timeline-border);
        }

        .timeline-stat {
            text-align: left;
        }

        .timeline-stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--timeline-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .timeline-stat-label {
            font-size: 0.85rem;
            color: var(--timeline-text-muted);
        }

        /* Progress Indicator */
        .timeline-progress {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }

        .timeline-progress-dot {
            width: 10px;
            height: 10px;
            background: var(--timeline-border);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .timeline-progress-dot:hover {
            background: var(--timeline-primary-light);
        }

        .timeline-progress-dot.active {
            width: 32px;
            border-radius: 5px;
            background: var(--timeline-primary);
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1200px) {
            .timeline-container {
                padding: 60px 30px 80px;
            }
        }

        @media (max-width: 992px) {
            .about-section {
                padding: 80px 0;
            }

            .about-title {
                font-size: 2.5rem;
            }

            .timeline-card.active {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .timeline-card-image img {
                height: 300px;
            }

            .timeline-card-title {
                font-size: 1.75rem;
            }

            .timeline-container {
                padding: 50px 20px 70px;
            }

            .timeline-year-label {
                padding: 8px 14px;
                font-size: 0.85rem;
            }

            .timeline-year-connector {
                height: 24px;
            }
        }

        @media (max-width: 768px) {
            .about-header {
                margin-bottom: 50px;
            }

            .about-title {
                font-size: 2rem;
            }

            .about-subtitle {
                font-size: 1rem;
            }

            .timeline-container {
                padding: 40px 15px 60px;
                overflow-x: auto;
            }

            .timeline-years {
                min-width: 700px;
                padding: 0 10px;
            }

            .timeline-line {
                left: 10px;
                right: 10px;
            }

            .timeline-year-dot {
                width: 20px;
                height: 20px;
            }

            .timeline-year-dot::before {
                width: 6px;
                height: 6px;
            }

            .timeline-year-connector {
                height: 20px;
            }

            .timeline-year-label {
                padding: 6px 12px;
                font-size: 0.8rem;
            }

            .timeline-card-content {
                padding: 0;
            }

            .timeline-stats {
                flex-wrap: wrap;
                gap: 20px;
            }

            .timeline-stat {
                flex: 0 0 calc(50% - 10px);
            }
        }

        @media (max-width: 576px) {
            .about-section {
                padding: 60px 0;
            }

            .about-title {
                font-size: 1.75rem;
            }

            .about-badge {
                font-size: 0.75rem;
                padding: 8px 16px;
            }

            .timeline-card-image img {
                height: 250px;
            }

            .timeline-card-title {
                font-size: 1.5rem;
            }

            .timeline-card-features {
                flex-direction: column;
            }

            .timeline-feature {
                width: 100%;
            }

            .timeline-container {
                padding: 35px 10px 50px;
            }

            .timeline-years {
                min-width: 600px;
            }
        }

        /* Animation Classes */
        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- ==================== ABOUT / HISTORY SECTION ==================== -->
    <section class="about-section" id="about">
        <div class="about-container">
            <!-- Section Header -->
            <div class="about-header">
                <span class="about-badge">
                    <i class="bi bi-building"></i> About Us
                </span>
                <h2 class="about-title">
                    Our <span class="highlight">Journey</span> Through Time
                </h2>
                <p class="about-subtitle">
                    From humble beginnings to industry leadership, discover how Pure Aqua Tech has been
                    revolutionizing water purification technology for over a decade.
                </p>
            </div>

            <!-- Timeline -->
            <div class="timeline-wrapper">
                <!-- Timeline Container with Line and Years -->
                <div class="timeline-container">
                    <!-- Timeline Line -->
                    <div class="timeline-line"></div>

                    <!-- Year Markers -->
                    <div class="timeline-years" id="timelineYears">
                        <div class="timeline-year" data-year="0">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2010</span>
                        </div>
                        <div class="timeline-year" data-year="1">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2015</span>
                        </div>
                        <div class="timeline-year" data-year="2">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2018</span>
                        </div>
                        <div class="timeline-year active" data-year="3">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2020</span>
                        </div>
                        <div class="timeline-year" data-year="4">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2022</span>
                        </div>
                        <div class="timeline-year" data-year="5">
                            <div class="timeline-year-dot"></div>
                            <div class="timeline-year-connector"></div>
                            <span class="timeline-year-label">2025</span>
                        </div>
                    </div>
                </div>

                <!-- Content Cards -->
                <div class="timeline-content-wrapper">
                    <!-- 2010 -->
                    <div class="timeline-card" data-card="0">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2010
                            </span>
                            <img src="{{ asset('img/about/view-fantasy-tap.jpg') }}" alt="Foundation Year">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-flag-fill"></i> Foundation Year
                            </span>
                            <h3 class="timeline-card-title">
                                The <span class="highlight">Beginning</span>
                            </h3>
                            <p class="timeline-card-text">
                                Pure Aqua Tech was established with a vision to provide clean, safe drinking
                                water solutions to communities across the region.
                            </p>
                            <p class="timeline-card-text">
                                Starting with a small team of dedicated engineers, we began our journey to
                                revolutionize water purification technology and make clean water accessible to all.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Founded
                                    Company</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> First Product
                                    Line</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> 5 Team
                                    Members</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">5</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">1</div>
                                    <div class="timeline-stat-label">City Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">100+</div>
                                    <div class="timeline-stat-label">First Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2015 -->
                    <div class="timeline-card" data-card="1">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2015
                            </span>
                            <img src="{{ asset('img/about/rm373batch10-207.jpg') }}" alt="Innovation Milestone">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-lightbulb-fill"></i> Innovation Milestone
                            </span>
                            <h3 class="timeline-card-title">
                                Advanced <span class="highlight">RO Technology</span>
                            </h3>
                            <p class="timeline-card-text">
                                Launched our first advanced Reverse Osmosis system with multi-stage filtration,
                                achieving 99.9% purification efficiency.
                            </p>
                            <p class="timeline-card-text">
                                This breakthrough technology set new industry standards and earned us ISO
                                certification for quality excellence and customer satisfaction.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> ISO
                                    Certified</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> 99.9% Purity</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Multi-Stage
                                    RO</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">25</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">10</div>
                                    <div class="timeline-stat-label">Cities Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">5K+</div>
                                    <div class="timeline-stat-label">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2018 -->
                    <div class="timeline-card" data-card="2">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2018
                            </span>
                            <img src="{{ asset('img/about/2212.i121.024.jpg') }}" alt="Market Expansion">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-graph-up-arrow"></i> Market Expansion
                            </span>
                            <h3 class="timeline-card-title">
                                Regional <span class="highlight">Growth</span>
                            </h3>
                            <p class="timeline-card-text">
                                Expanded operations to serve over 50 cities, installing water purification
                                systems in thousands of homes and businesses nationwide.
                            </p>
                            <p class="timeline-card-text">
                                Established dedicated service centers to provide 24/7 customer support and
                                maintenance services across all regions we operate in.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> 50+ Cities</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Service
                                    Centers</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> 24/7 Support</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">75</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">50+</div>
                                    <div class="timeline-stat-label">Cities Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">25K+</div>
                                    <div class="timeline-stat-label">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2020 (Active by default) -->
                    <div class="timeline-card active" data-card="3">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2020
                            </span>
                            <img src="{{ asset('img/about/online-shopping-concept.jpg') }}" alt="Smart Technology">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-cpu-fill"></i> Digital Revolution
                            </span>
                            <h3 class="timeline-card-title">
                                Smart <span class="highlight">IoT Systems</span>
                            </h3>
                            <p class="timeline-card-text">
                                Introduced IoT-enabled water purifiers with real-time monitoring, automatic
                                filter alerts, and mobile app connectivity for enhanced user experience.
                            </p>
                            <p class="timeline-card-text">
                                Our smart systems allow users to track water quality, consumption patterns,
                                and schedule maintenance through their smartphones seamlessly.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> IoT Enabled</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Mobile App</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Real-time
                                    Monitoring</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">150</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">75+</div>
                                    <div class="timeline-stat-label">Cities Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">50K+</div>
                                    <div class="timeline-stat-label">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2022 -->
                    <div class="timeline-card" data-card="4">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2022
                            </span>
                            <img src="{{ asset('img/about/view-fantasy.jpg') }}" alt="Green Initiative">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-leaf-fill"></i> Green Initiative
                            </span>
                            <h3 class="timeline-card-title">
                                Eco-Friendly <span class="highlight">Solutions</span>
                            </h3>
                            <p class="timeline-card-text">
                                Launched our sustainable water purification line with zero-waste technology
                                and energy-efficient operations to protect the environment.
                            </p>
                            <p class="timeline-card-text">
                                Committed to reducing plastic waste by promoting reusable filter systems and
                                eco-conscious manufacturing processes throughout production.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Zero Waste</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Energy
                                    Efficient</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Eco
                                    Manufacturing</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">200</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">100+</div>
                                    <div class="timeline-stat-label">Cities Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">75K+</div>
                                    <div class="timeline-stat-label">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2025 -->
                    <div class="timeline-card" data-card="5">
                        <div class="timeline-card-image">
                            <span class="timeline-card-image-badge">
                                <i class="bi bi-calendar-event"></i> 2025
                            </span>
                            <img src="{{ asset('img/about/18375.jpg') }}" alt="Industry Leader">
                        </div>
                        <div class="timeline-card-content">
                            <span class="timeline-card-badge">
                                <i class="bi bi-trophy-fill"></i> Industry Leader
                            </span>
                            <h3 class="timeline-card-title">
                                Award <span class="highlight">Winning</span>
                            </h3>
                            <p class="timeline-card-text">
                                Recognized as the leading water purification company with multiple industry
                                awards for innovation and exceptional customer satisfaction.
                            </p>
                            <p class="timeline-card-text">
                                Achieved NSF International certification and became the trusted choice for
                                over 100,000 satisfied customers nationwide and growing.
                            </p>
                            <div class="timeline-card-features">
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> NSF
                                    Certified</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Award
                                    Winning</span>
                                <span class="timeline-feature"><i class="bi bi-check-circle-fill"></i> Market
                                    Leader</span>
                            </div>
                            <div class="timeline-stats">
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">300+</div>
                                    <div class="timeline-stat-label">Team Members</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">150+</div>
                                    <div class="timeline-stat-label">Cities Covered</div>
                                </div>
                                <div class="timeline-stat">
                                    <div class="timeline-stat-value">100K+</div>
                                    <div class="timeline-stat-label">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Dots -->
                <div class="timeline-progress" id="timelineProgress">
                    <span class="timeline-progress-dot" data-year="0"></span>
                    <span class="timeline-progress-dot" data-year="1"></span>
                    <span class="timeline-progress-dot" data-year="2"></span>
                    <span class="timeline-progress-dot active" data-year="3"></span>
                    <span class="timeline-progress-dot" data-year="4"></span>
                    <span class="timeline-progress-dot" data-year="5"></span>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timelineYears = document.querySelectorAll('.timeline-year');
            const timelineCards = document.querySelectorAll('.timeline-card');
            const progressDots = document.querySelectorAll('.timeline-progress-dot');
            let currentIndex = 3; // Start at 2020

            function setActiveYear(index) {
                // Update year markers
                timelineYears.forEach((year, i) => {
                    year.classList.toggle('active', i === index);
                });

                // Update cards with animation
                timelineCards.forEach((card, i) => {
                    if (i === index) {
                        card.classList.add('active');
                    } else {
                        card.classList.remove('active');
                    }
                });

                // Update progress dots
                progressDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });

                currentIndex = index;
            }

            // Click on year markers
            timelineYears.forEach((year, index) => {
                year.addEventListener('click', () => {
                    setActiveYear(index);
                });
            });

            // Click on progress dots
            progressDots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    setActiveYear(index);
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight' && currentIndex < timelineYears.length - 1) {
                    setActiveYear(currentIndex + 1);
                } else if (e.key === 'ArrowLeft' && currentIndex > 0) {
                    setActiveYear(currentIndex - 1);
                }
            });

            // Touch swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;
            const contentWrapper = document.querySelector('.timeline-content-wrapper');

            contentWrapper.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, false);

            contentWrapper.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, false);

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0 && currentIndex < timelineYears.length - 1) {
                        // Swipe left - next
                        setActiveYear(currentIndex + 1);
                    } else if (diff < 0 && currentIndex > 0) {
                        // Swipe right - previous
                        setActiveYear(currentIndex - 1);
                    }
                }
            }

            // Auto-rotate (optional - uncomment to enable)
            /*
            let autoRotateInterval = setInterval(() => {
                let nextIndex = (currentIndex + 1) % timelineYears.length;
                setActiveYear(nextIndex);
            }, 5000);

            // Stop auto-rotate on user interaction
            document.querySelector('.timeline-wrapper').addEventListener('click', () => {
                clearInterval(autoRotateInterval);
            });
            */

            // Intersection Observer for scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-slide-up');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.about-header, .timeline-container, .timeline-years').forEach(el => {
                observer.observe(el);
            });
        });
    </script> --}}

    <!-- ==================== PRODUCT BANNER SECTION ==================== -->
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --accent: #4f46e5;
            --success: #059669;
            --warning: #f59e0b;
            --danger: #dc2626;
            --text-primary: #111827;
            --text-secondary: #4b5563;
            --text-muted: #9ca3af;
            --border: #e5e7eb;
            --bg-light: #f8fafc;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        /* ==================== PRODUCT BANNER SECTION ==================== */
        .promo-banner-section {
            padding: 60px 0;
            background: var(--bg-card);
        }

        .promo-banner-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .promo-banner-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 992px) {
            .promo-banner-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Banner Card */
        .promo-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            min-height: 320px;
            display: flex;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .promo-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
        }

        .promo-card-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .promo-card:hover .promo-card-bg {
            transform: scale(1.05);
        }

        /* Amount Offer Card - Style 1 */
        .promo-card.style-amount {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .promo-card.style-amount .promo-card-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            align-items: center;
            padding: 40px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 60%, transparent 100%);
        }

        .promo-card.style-amount .promo-content {
            max-width: 60%;
        }

        .promo-card.style-amount .promo-badge {
            display: inline-block;
            padding: 6px 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .promo-card.style-amount .promo-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .promo-card.style-amount .promo-price {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 20px;
        }

        .promo-card.style-amount .promo-price .current {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
        }

        .promo-card.style-amount .promo-price .label {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .promo-card.style-amount .promo-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .promo-card.style-amount .promo-btn:hover {
            background: var(--primary-dark);
            transform: translateX(4px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
        }

        .promo-card.style-amount .promo-btn i {
            transition: transform 0.3s;
        }

        .promo-card.style-amount .promo-btn:hover i {
            transform: translateX(4px);
        }

        /* Percentage Offer Card - Style 2 */
        .promo-card.style-percent {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .promo-card.style-percent .promo-card-overlay {
            position: relative;
            z-index: 2;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.92) 0%, rgba(217, 119, 6, 0.88) 100%);
        }

        .promo-card.style-percent .sale-badge {
            display: inline-block;
            padding: 8px 24px;
            background: white;
            color: var(--warning);
            font-size: 1rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-radius: 50px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .promo-card.style-percent .promo-discount {
            font-size: 3.5rem;
            font-weight: 900;
            color: white;
            line-height: 1;
            margin-bottom: 8px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .promo-card.style-percent .promo-discount-text {
            font-size: 1.25rem;
            color: white;
            opacity: 0.95;
            margin-bottom: 24px;
        }

        .promo-card.style-percent .promo-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: white;
            color: var(--warning);
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .promo-card.style-percent .promo-btn:hover {
            background: var(--text-primary);
            color: white;
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .promo-card {
                min-height: 280px;
            }

            .promo-card.style-amount .promo-card-overlay {
                padding: 24px;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            }

            .promo-card.style-amount .promo-content {
                max-width: 100%;
            }

            .promo-card.style-amount .promo-title {
                font-size: 1.4rem;
            }

            .promo-card.style-amount .promo-price .current {
                font-size: 1.5rem;
            }

            .promo-card.style-percent .promo-discount {
                font-size: 2.5rem;
            }

            .promo-card.style-percent .promo-discount-text {
                font-size: 1rem;
            }
        }

        /* ==================== PRODUCT LIST SECTION ==================== */
        .category-products-section {
            padding: 80px 0;
            background: var(--bg-light);
            overflow: hidden;
        }

        .category-products-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0;
            line-height: 1.2;
        }

        .section-title .highlight {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Owl Carousel Custom Styling */
        .category-carousel.owl-carousel .owl-stage-outer {
            overflow: visible;
        }

        .category-carousel.owl-carousel .owl-nav {
            position: absolute;
            top: -70px;
            right: 0;
            display: flex;
            gap: 10px;
        }

        .category-carousel.owl-carousel .owl-nav button {
            width: 44px;
            height: 44px;
            background: var(--bg-card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary) !important;
            font-size: 1.25rem !important;
            transition: all 0.3s;
            box-shadow: var(--shadow);
        }

        .category-carousel.owl-carousel .owl-nav button:hover {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
            transform: scale(1.05);
        }

        .category-carousel.owl-carousel .owl-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
        }

        .category-carousel.owl-carousel .owl-dot {
            width: 10px;
            height: 10px;
            background: var(--border);
            border-radius: 50%;
            transition: all 0.3s;
        }

        .category-carousel.owl-carousel .owl-dot.active {
            background: var(--primary);
            width: 28px;
            border-radius: 5px;
        }

        /* Product Card - Mini Style */
        .product-mini-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .product-mini-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .product-mini-inner {
            display: flex;
        }

        /* Product Image Side */
        .product-mini-image {
            position: relative;
            width: 40%;
            min-height: 180px;
            background: var(--bg-light);
            overflow: hidden;
        }

        .product-mini-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-mini-card:hover .product-mini-image img {
            transform: scale(1.08);
        }

        .product-mini-view {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .product-mini-card:hover .product-mini-view {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        .product-mini-view a {
            width: 44px;
            height: 44px;
            background: var(--bg-card);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            text-decoration: none;
            box-shadow: var(--shadow-md);
            transition: all 0.2s;
        }

        .product-mini-view a:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        /* Product Info Side */
        .product-mini-info {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .product-mini-category {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .product-mini-category:hover {
            color: var(--primary-dark);
        }

        .product-mini-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.4;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.2s;
            min-height: 2.8em;
        }

        .product-mini-name:hover {
            color: var(--primary);
        }

        .product-mini-price {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-top: auto;
        }

        .product-mini-price .current {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .product-mini-price .original {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-decoration: line-through;
        }

        /* Product Actions */
        .product-mini-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-top: 1px solid var(--border);
            background: var(--bg-light);
        }

        .product-mini-cart-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .product-mini-cart-btn:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .product-mini-quick-actions {
            display: flex;
            gap: 8px;
        }

        .product-mini-quick-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s;
        }

        .product-mini-quick-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #eff6ff;
        }

        .product-mini-quick-btn.wishlist:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: #fef2f2;
        }

        /* Inner Carousel (Products within category) */
        .products-inner-carousel.owl-carousel .owl-nav {
            display: none;
        }

        .products-inner-carousel.owl-carousel .owl-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 16px;
        }

        .products-inner-carousel.owl-carousel .owl-dot {
            width: 8px;
            height: 8px;
            background: var(--border);
            border-radius: 50%;
            transition: all 0.3s;
        }

        .products-inner-carousel.owl-carousel .owl-dot.active {
            background: var(--primary);
            width: 20px;
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .section-title {
                font-size: 2rem;
            }

            .category-carousel.owl-carousel .owl-nav {
                position: static;
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .category-products-section {
                padding: 50px 0;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .product-mini-inner {
                flex-direction: column;
            }

            .product-mini-image {
                width: 100%;
                min-height: 200px;
            }

            .product-mini-info {
                padding: 16px;
            }

            .product-mini-actions {
                flex-direction: column;
                gap: 12px;
            }

            .product-mini-cart-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .section-header {
                margin-bottom: 30px;
            }

            .section-badge {
                font-size: 0.75rem;
                padding: 6px 14px;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
    <section class="promo-banner-section">
        <div class="promo-banner-container">
            <div class="promo-banner-grid">

                @if ($amountOffer)
                    <a href="{{ route('product.show', [$amountOffer->product->id, $amountOffer->product->slug]) }}"
                        class="promo-card style-amount wow fadeInLeft" data-wow-delay="0.1s">
                        <img src="{{ asset('storage/' . $amountOffer->product->main_image) }}" class="promo-card-bg"
                            alt="{{ $amountOffer->title }}">
                        <div class="promo-card-overlay">
                            <div class="promo-content">
                                <span class="promo-badge">
                                    <i class="bi bi-lightning-charge-fill"></i> Special Offer
                                </span>
                                <h3 class="promo-title">{{ $amountOffer->title }}</h3>
                                <div class="promo-price">
                                    <span class="current">₹{{ number_format($amountOffer->offer_price, 2) }}</span>
                                    <span class="label">Special Price</span>
                                </div>
                                <span class="promo-btn">
                                    Shop Now <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endif

                @if ($percentageOffer)
                    <a href="{{ route('product.show', [$percentageOffer->product->id, $percentageOffer->product->slug]) }}"
                        class="promo-card style-percent wow fadeInRight" data-wow-delay="0.2s">
                        <img src="{{ asset('storage/' . $percentageOffer->product->main_image) }}" class="promo-card-bg"
                            alt="{{ $percentageOffer->title }}">
                        <div class="promo-card-overlay">
                            <span class="sale-badge">🔥 Hot Sale</span>
                            <div class="promo-discount">
                                {{ $percentageOffer->offer_price }}% OFF
                            </div>
                            <p class="promo-discount-text">Get Up To {{ $percentageOffer->offer_price }}% Discount</p>
                            <span class="promo-btn">
                                <i class="bi bi-bag-check"></i> Shop Now
                            </span>
                        </div>
                    </a>
                @endif

            </div>
        </div>
    </section>


    {{-- Add this CSS to your main stylesheet --}}


    {{-- 
    Product Section - Category-wise Carousel Layout
    
    Features:
    - Each category displayed in its own section
    - Horizontal carousel for products exceeding screen width
    - Smooth scroll/swipe navigation
    - Navigation arrows for desktop
    
    Design: Professional, clean, consistent with other sections
--}}

    <style>
        :root {
            --product-primary: #1e40af;
            --product-primary-light: #3b82f6;
            --product-primary-dark: #1e3a8a;
            --product-accent: #4f46e5;
            --product-success: #059669;
            --product-danger: #dc2626;
            --product-warning: #f59e0b;
            --product-text-primary: #111827;
            --product-text-secondary: #4b5563;
            --product-text-muted: #9ca3af;
            --product-border: #e5e7eb;
            --product-bg-light: #f8fafc;
            --product-bg-card: #ffffff;
            --product-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --product-shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --product-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --product-shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --product-radius: 12px;
            --product-radius-lg: 16px;
        }

        /* ==================== PRODUCTS SECTION ==================== */
        .products-section {
            padding: 80px 0;
            background: var(--product-bg-card);
        }

        .products-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Section Header */
        .products-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .products-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--product-primary) 0%, var(--product-accent) 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .products-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--product-text-primary);
            margin-bottom: 16px;
        }

        .products-title .highlight {
            background: linear-gradient(135deg, var(--product-primary) 0%, var(--product-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .products-subtitle {
            font-size: 1.1rem;
            color: var(--product-text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }

        /* ==================== CATEGORY ROW ==================== */
        .category-row {
            margin-bottom: 60px;
        }

        .category-row:last-child {
            margin-bottom: 0;
        }

        /* Category Header */
        .category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding: 0 4px;
        }

        .category-title-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .category-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--product-primary);
            font-size: 1.25rem;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--product-text-primary);
            margin: 0;
        }

        .category-count {
            font-size: 0.9rem;
            color: var(--product-text-muted);
            font-weight: 400;
            margin-left: 8px;
        }

        .category-view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: var(--product-bg-light);
            border: 1px solid var(--product-border);
            border-radius: 50px;
            color: var(--product-text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .category-view-all:hover {
            background: var(--product-primary);
            border-color: var(--product-primary);
            color: white;
            transform: translateX(4px);
        }

        .category-view-all i {
            font-size: 0.8rem;
            transition: transform 0.3s;
        }

        .category-view-all:hover i {
            transform: translateX(4px);
        }

        /* ==================== CAROUSEL CONTAINER ==================== */
        .carousel-container {
            position: relative;
            overflow: hidden;
        }

        /* Navigation Arrows */
        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: var(--product-bg-card);
            border: 1px solid var(--product-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            box-shadow: var(--product-shadow-lg);
            opacity: 0;
        }

        .carousel-container:hover .carousel-nav {
            opacity: 1;
        }

        .carousel-nav:hover {
            background: var(--product-primary);
            border-color: var(--product-primary);
            color: white;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        .carousel-nav i {
            font-size: 1.1rem;
            color: var(--product-text-secondary);
            transition: color 0.3s;
        }

        .carousel-nav:hover i {
            color: white;
        }

        .carousel-nav.disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        /* Carousel Track */
        .carousel-track {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 10px 4px 20px;
        }

        .carousel-track::-webkit-scrollbar {
            display: none;
        }

        /* ==================== PRODUCT CARD ==================== */
        .product-card {
            flex: 0 0 280px;
            background: var(--product-bg-card);
            border-radius: var(--product-radius-lg);
            overflow: hidden;
            border: 1px solid var(--product-border);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--product-shadow-xl);
            border-color: transparent;
        }

        /* Product Image */
        .product-card-image {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            background: var(--product-bg-light);
        }

        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-card-image img {
            transform: scale(1.08);
        }

        /* Badges */
        .product-badges {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .product-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-badge.featured {
            background: linear-gradient(135deg, var(--product-primary) 0%, var(--product-accent) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .product-badge.sale {
            background: var(--product-danger);
            color: white;
        }

        .product-badge.new {
            background: var(--product-success);
            color: white;
        }

        /* Quick Actions */
        .product-quick-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s;
        }

        .product-card:hover .product-quick-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .quick-action-btn {
            width: 40px;
            height: 40px;
            background: var(--product-bg-card);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--product-shadow-md);
            transition: all 0.2s;
            text-decoration: none;
            color: var(--product-text-secondary);
        }

        .quick-action-btn:hover {
            background: var(--product-primary);
            color: white;
            transform: scale(1.1);
        }

        .quick-action-btn.wishlist:hover {
            background: var(--product-danger);
        }

        /* Quick View Overlay */
        .product-quick-view {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            transform: translateY(100%);
            transition: transform 0.3s;
        }

        .product-card:hover .product-quick-view {
            transform: translateY(0);
        }

        .quick-view-btn {
            width: 100%;
            padding: 12px;
            background: var(--product-bg-card);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--product-text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .quick-view-btn:hover {
            background: var(--product-primary);
            color: white;
        }

        /* Product Info */
        .product-card-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--product-text-primary);
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
            min-height: 2.8em;
            text-decoration: none;
            transition: color 0.2s;
        }

        .product-card-name:hover {
            color: var(--product-primary);
        }

        /* Rating */
        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .product-stars {
            display: flex;
            gap: 2px;
        }

        .product-stars i {
            font-size: 0.85rem;
            color: #fbbf24;
        }

        .product-stars i.empty {
            color: #e5e7eb;
        }

        .product-reviews {
            font-size: 0.8rem;
            color: var(--product-text-muted);
        }

        /* Price */
        .product-price {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 16px;
        }

        .product-price-current {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--product-text-primary);
        }

        .product-price-original {
            font-size: 0.95rem;
            color: var(--product-text-muted);
            text-decoration: line-through;
        }

        .product-price-discount {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--product-success);
            background: #d1fae5;
            padding: 2px 8px;
            border-radius: 4px;
        }

        /* Actions */
        .product-card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn-add-cart {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            background: var(--product-primary);
            color: white;
            border: none;
            border-radius: var(--product-radius);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-add-cart:hover {
            background: var(--product-primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-add-cart.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-add-cart.success {
            background: var(--product-success);
        }

        .btn-wishlist {
            width: 48px;
            height: 48px;
            background: var(--product-bg-light);
            border: 1px solid var(--product-border);
            border-radius: var(--product-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--product-text-secondary);
        }

        .btn-wishlist:hover {
            background: #fef2f2;
            border-color: var(--product-danger);
            color: var(--product-danger);
        }

        .btn-wishlist.active {
            background: var(--product-danger);
            border-color: var(--product-danger);
            color: white;
        }

        /* ==================== SCROLL INDICATOR ==================== */
        .scroll-indicator {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 16px;
        }

        .scroll-dot {
            width: 8px;
            height: 8px;
            background: var(--product-border);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
        }

        .scroll-dot.active {
            width: 24px;
            border-radius: 4px;
            background: var(--product-primary);
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1200px) {
            .product-card {
                flex: 0 0 260px;
            }
        }

        @media (max-width: 992px) {
            .products-section {
                padding: 60px 0;
            }

            .products-title {
                font-size: 2.25rem;
            }

            .category-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .product-card {
                flex: 0 0 240px;
            }

            .carousel-nav {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .products-header {
                margin-bottom: 40px;
            }

            .products-title {
                font-size: 1.75rem;
            }

            .category-row {
                margin-bottom: 40px;
            }

            .category-title {
                font-size: 1.25rem;
            }

            .category-title-wrapper {
                gap: 12px;
            }

            .carousel-track {
                gap: 16px;
                padding: 8px 4px 16px;
            }

            /* Show 2.5 cards on tablet for peek effect */
            .product-card {
                flex: 0 0 calc(40% - 8px);
                min-width: calc(40% - 8px);
            }
        }

        @media (max-width: 576px) {
            .products-section {
                padding: 50px 0;
            }

            .products-container {
                padding: 0 12px;
            }

            .products-title {
                font-size: 1.5rem;
            }

            .products-badge {
                font-size: 0.75rem;
                padding: 8px 16px;
            }

            .category-header {
                padding: 0;
            }

            .category-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .category-title {
                font-size: 1.1rem;
            }

            .category-count {
                display: block;
                margin-left: 0;
                font-size: 0.8rem;
            }

            .category-view-all {
                padding: 8px 14px;
                font-size: 0.8rem;
            }

            /* Show exactly 2 products in mobile view */
            .carousel-track {
                gap: 12px;
                padding: 8px 2px 16px;
            }

            .product-card {
                /* Calculate width: 50% minus half the gap */
                flex: 0 0 calc(50% - 6px);
                min-width: calc(50% - 6px);
            }

            .product-card-image {
                aspect-ratio: 1;
            }

            .product-badges {
                top: 8px;
                left: 8px;
                gap: 4px;
            }

            .product-badge {
                padding: 4px 8px;
                font-size: 0.65rem;
            }

            .product-quick-actions {
                top: 8px;
                right: 8px;
                gap: 6px;
            }

            .quick-action-btn {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .product-card-info {
                padding: 12px;
            }

            .product-card-name {
                font-size: 0.85rem;
                min-height: 2.4em;
                margin-bottom: 6px;
                -webkit-line-clamp: 2;
            }

            .product-rating {
                margin-bottom: 8px;
            }

            .product-stars i {
                font-size: 0.7rem;
            }

            .product-reviews {
                font-size: 0.7rem;
            }

            .product-price {
                flex-wrap: wrap;
                gap: 4px;
                margin-bottom: 12px;
            }

            .product-price-current {
                font-size: 1rem;
            }

            .product-price-original {
                font-size: 0.8rem;
            }

            .product-price-discount {
                font-size: 0.65rem;
                padding: 2px 6px;
            }

            .product-card-actions {
                flex-direction: column;
                gap: 8px;
            }

            .btn-add-cart {
                padding: 10px 12px;
                font-size: 0.8rem;
                width: 100%;
            }

            .btn-add-cart i {
                font-size: 0.9rem;
            }

            .btn-wishlist {
                display: none;
                /* Hide wishlist button on mobile to save space, it's in quick actions */
            }
        }

        /* Extra small devices - still show 2 cards */
        @media (max-width: 380px) {
            .products-container {
                padding: 0 8px;
            }

            .carousel-track {
                gap: 8px;
            }

            .product-card {
                flex: 0 0 calc(50% - 4px);
                min-width: calc(50% - 4px);
            }

            .product-card-info {
                padding: 10px;
            }

            .product-card-name {
                font-size: 0.8rem;
            }

            .product-price-current {
                font-size: 0.95rem;
            }

            .btn-add-cart {
                padding: 8px 10px;
                font-size: 0.75rem;
            }
        }
    </style>

    <!-- ==================== PRODUCTS SECTION ==================== -->
    <section class="products-section" id="products">
        <div class="products-container">
            <!-- Section Header -->
            <div class="products-header">
                <span class="products-badge">
                    <i class="bi bi-box-seam"></i> Our Collection
                </span>
                <h2 class="products-title">
                    Explore Our <span class="highlight">Products</span>
                </h2>
                <p class="products-subtitle">
                    Discover our premium range of water purification products designed for your home and office.
                </p>
            </div>

            <!-- Category-wise Product Rows -->
            @foreach ($categories as $category)
                @if ($category->products->count() > 0)
                    <div class="category-row" data-category-id="{{ $category->id }}">
                        <!-- Category Header -->
                        <div class="category-header">
                            <div class="category-title-wrapper">
                                <div class="category-icon">
                                    <i class="bi bi-droplet-fill"></i>
                                </div>
                                <h3 class="category-title">
                                    {{ $category->name }}
                                    <span class="category-count">({{ $category->products->count() }} Products)</span>
                                </h3>
                            </div>
                            <a href="{{ route('shop', ['category' => $category->id]) }}" class="category-view-all">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Carousel Container -->
                        <div class="carousel-container">
                            <!-- Navigation Arrows -->
                            <button class="carousel-nav prev" onclick="scrollCarousel(this, -1)">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="carousel-nav next" onclick="scrollCarousel(this, 1)">
                                <i class="bi bi-chevron-right"></i>
                            </button>

                            <!-- Products Track -->
                            <div class="carousel-track">
                                @foreach ($category->products as $product)
                                    <div class="product-card">
                                        <!-- Product Image -->
                                        <div class="product-card-image">
                                            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                                alt="{{ $product->name }}">

                                            <!-- Badges -->
                                            <div class="product-badges">
                                                @if ($product->featured)
                                                    <span class="product-badge featured">Featured</span>
                                                @endif
                                                @if ($product->discount > 0)
                                                    <span class="product-badge sale">{{ round($product->discount) }}%
                                                        OFF</span>
                                                @endif
                                                @if ($product->created_at->diffInDays(now()) < 30)
                                                    <span class="product-badge new">New</span>
                                                @endif
                                            </div>

                                            <!-- Quick Actions -->
                                            <div class="product-quick-actions">
                                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="quick-action-btn" title="Quick View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <button class="quick-action-btn wishlist"
                                                    data-product-id="{{ $product->id }}" title="Add to Wishlist">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                            </div>

                                            <!-- Quick View Overlay -->
                                            <div class="product-quick-view">
                                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="quick-view-btn">
                                                    <i class="bi bi-eye"></i> Quick View
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Product Info -->
                                        <div class="product-card-info">
                                            <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                class="product-card-name">
                                                {{ $product->name }}
                                            </a>

                                            <!-- Rating -->
                                            <div class="product-rating">
                                                <div class="product-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= ($product->rating ?? 4))
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star-fill empty"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span
                                                    class="product-reviews">({{ $product->reviews_count ?? rand(10, 50) }})</span>
                                            </div>

                                            <!-- Price -->
                                            <div class="product-price">
                                                @if ($product->discount > 0)
                                                    @php
                                                        $discountedPrice =
                                                            $product->price -
                                                            ($product->price * $product->discount) / 100;
                                                    @endphp
                                                    <span
                                                        class="product-price-current">₹{{ round($discountedPrice) }}</span>
                                                    <span
                                                        class="product-price-original">₹{{ round($product->price) }}</span>
                                                    <span class="product-price-discount">Save
                                                        {{ round($product->discount) }}%</span>
                                                @else
                                                    <span
                                                        class="product-price-current">₹{{ round($product->price) }}</span>
                                                @endif
                                            </div>

                                            <!-- Actions -->
                                            <div class="product-card-actions">
                                                <button class="btn-add-cart" data-product-id="{{ $product->id }}"
                                                    data-url="{{ route('cart.add', $product->id) }}">
                                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                                </button>
                                                <button class="btn-wishlist" data-product-id="{{ $product->id }}">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel Navigation
            window.scrollCarousel = function(button, direction) {
                const container = button.closest('.carousel-container');
                const track = container.querySelector('.carousel-track');
                const cardWidth = track.querySelector('.product-card').offsetWidth + 24; // card width + gap
                const scrollAmount = cardWidth * 2; // Scroll 2 cards at a time

                track.scrollBy({
                    left: scrollAmount * direction,
                    behavior: 'smooth'
                });

                // Update nav button states after scroll
                setTimeout(() => updateNavButtons(container), 300);
            };

            // Update navigation button states
            function updateNavButtons(container) {
                const track = container.querySelector('.carousel-track');
                const prevBtn = container.querySelector('.carousel-nav.prev');
                const nextBtn = container.querySelector('.carousel-nav.next');

                if (prevBtn && nextBtn) {
                    prevBtn.classList.toggle('disabled', track.scrollLeft <= 0);
                    nextBtn.classList.toggle('disabled',
                        track.scrollLeft >= track.scrollWidth - track.clientWidth - 10);
                }
            }

            // Initialize all carousels
            document.querySelectorAll('.carousel-container').forEach(container => {
                const track = container.querySelector('.carousel-track');

                // Initial state
                updateNavButtons(container);

                // Update on scroll
                track.addEventListener('scroll', () => {
                    updateNavButtons(container);
                });

                // Touch/Mouse drag for mobile
                let isDown = false;
                let startX;
                let scrollLeft;

                track.addEventListener('mousedown', (e) => {
                    isDown = true;
                    track.style.cursor = 'grabbing';
                    startX = e.pageX - track.offsetLeft;
                    scrollLeft = track.scrollLeft;
                });

                track.addEventListener('mouseleave', () => {
                    isDown = false;
                    track.style.cursor = 'grab';
                });

                track.addEventListener('mouseup', () => {
                    isDown = false;
                    track.style.cursor = 'grab';
                });

                track.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - track.offsetLeft;
                    const walk = (x - startX) * 1.5;
                    track.scrollLeft = scrollLeft - walk;
                });
            });

            // Add to Cart functionality
            document.addEventListener('click', function(e) {
                const addToCartBtn = e.target.closest('.btn-add-cart');

                if (addToCartBtn) {
                    e.preventDefault();
                    const productId = addToCartBtn.getAttribute('data-product-id');
                    const cartUrl = addToCartBtn.getAttribute('data-url');
                    const originalHTML = addToCartBtn.innerHTML;

                    // Loading state
                    addToCartBtn.classList.add('loading');
                    addToCartBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';

                    fetch(cartUrl, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw data;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Success state
                                addToCartBtn.classList.remove('loading');
                                addToCartBtn.classList.add('success');
                                addToCartBtn.innerHTML = '<i class="bi bi-check-lg"></i> Added!';

                                // Update cart count
                                const cartCountEl = document.querySelector('.cart-count');
                                if (cartCountEl && data.cart_count !== undefined) {
                                    cartCountEl.textContent = data.cart_count;
                                }

                                // Reset button after delay
                                setTimeout(() => {
                                    addToCartBtn.classList.remove('success');
                                    addToCartBtn.innerHTML = originalHTML;
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            addToCartBtn.classList.remove('loading');
                            addToCartBtn.innerHTML = originalHTML;

                            if (error.redirect) {
                                window.location.href = error.redirect;
                            } else {
                                alert(error.message || 'Something went wrong. Please try again.');
                            }
                        });
                }
            });

            // Wishlist functionality
            document.addEventListener('click', function(e) {
                const wishlistBtn = e.target.closest('.btn-wishlist, .quick-action-btn.wishlist');

                if (wishlistBtn) {
                    e.preventDefault();
                    const icon = wishlistBtn.querySelector('i');

                    wishlistBtn.classList.toggle('active');

                    if (wishlistBtn.classList.contains('active')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                    }
                }
            });
        });
    </script>

    {{-- USED --}}
    {{-- <style>
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
                            @foreach ($categories as $index => $category)
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
                            @foreach ($products as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3 product-item-wrapper"
                                    data-category="{{ $product->category_id }}">

                                    <!-- Minimal/Clean Product Card -->
                                    <div class="product-card-minimal">
                                        <div class="image-wrapper">
                                            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('img/product-default.png') }}"
                                                class="product-img" alt="{{ $product->name }}">

                                            <!-- Badges -->
                                            <div class="badges">
                                                @if ($product->featured)
                                                    <span class="badge featured">Featured</span>
                                                @endif
                                               
                                            </div>

                                            <!-- Quick View Button -->
                                            <div class="quick-view">
                                                <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                    class="quick-view-btn">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="product-info">
                                            <!-- Product Name -->
                                            <a href="{{ route('product.show', [$product->id, $product->slug]) }}"
                                                class="product-name">
                                                {{ $product->name }}
                                            </a>

                                            <!-- Price Section -->
                                            <div class="price-section">
                                                @if ($product->discount > 0)
                                                    <span class="price-current">
                                                        ₹{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
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

                                            <!-- Rating Stars -->
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= ($product->rating ?? 4))
                                                        <i class="fas fa-star text-primary"></i>
                                                    @else
                                                        <i class="fas fa-star" style="color: #d1d5db;"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            <!-- Actions -->
                                            <div class="actions">

                                                <a href="{{ route('cart.add', $product->id) }}"
                                                    class="btn-add-cart add-to-cart"
                                                    data-product-id="{{ $product->id }}">
                                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                </a>
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
                    @foreach ($categories as $category)
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
        document.addEventListener('DOMContentLoaded', function() {
            // Only select the actual navigation tab links, not product wrappers
            const categoryTabs = document.querySelectorAll('.nav-pills [data-category]');
            const allProducts = document.querySelectorAll('.product-item-wrapper');

            categoryTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
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
            // Add to cart functionality
            document.addEventListener('click', function(e) {
                const addToCartBtn = e.target.closest('.add-to-cart');
                const wishlistBtn = e.target.closest('.wishlist-btn');

                if (addToCartBtn) {
                    e.preventDefault();
                    const productId = addToCartBtn.getAttribute('data-product-id');
                    const cartUrl = addToCartBtn.getAttribute('href');

                    // Disable button to prevent double clicks
                    addToCartBtn.style.pointerEvents = 'none';
                    addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Adding...';

                    fetch(cartUrl, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw data;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Show success message (you can use toast/notification library)
                                alert(data.message);

                                // Update cart count in navbar if you have one
                                const cartCountEl = document.querySelector('.cart-count');
                                if (cartCountEl && data.cart_count !== undefined) {
                                    cartCountEl.textContent = data.cart_count;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);

                            // If not logged in, redirect to login
                            if (error.redirect) {
                                window.location.href = error.redirect;
                            } else if (error.message) {
                                alert(error.message);
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        })
                        .finally(() => {
                            // Re-enable button
                            addToCartBtn.style.pointerEvents = 'auto';
                            addToCartBtn.innerHTML =
                                '<i class="fas fa-shopping-cart me-2"></i> Add to Cart';
                        });

                } else if (wishlistBtn) {
                    e.preventDefault();
                    const productId = wishlistBtn.getAttribute('data-product-id');
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
    </style> --}}

    <!-- Our Products End -->


    {{-- 
    Professional Service Section - Human Psychology Based UI/UX
    
    Color Psychology Applied:
    - Primary Blue (#1e40af): Trust, reliability, professionalism
    - Accent Indigo (#4f46e5): Premium feel, innovation
    - Success Green (#059669): Positive actions, eco-friendly water
    - Clean whites/grays: Clarity, purity (fits water purifier theme)
    
    UX Psychology Principles:
    - Social proof with trust indicators
    - Visual engagement with animated circular menu
    - Clear value proposition
    - Easy booking flow with minimal friction
--}}

    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --accent: #4f46e5;
            --accent-light: #6366f1;
            --success: #059669;
            --success-light: #d1fae5;
            --text-primary: #111827;
            --text-secondary: #4b5563;
            --text-muted: #9ca3af;
            --border: #e5e7eb;
            --bg-light: #f8fafc;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
        }

        /* ==================== SERVICE SECTION ==================== */
        .service-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #ffffff 0%, var(--bg-light) 100%);
            position: relative;
            overflow: hidden;
        }

        .service-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .service-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .service-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .service-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 60px;
            align-items: center;
        }

        /* ==================== LEFT CONTENT ==================== */
        .service-content {
            position: sticky;
            top: 100px;
        }

        .service-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .service-badge-icon {
            font-size: 1rem;
        }

        .service-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.15;
            margin-bottom: 24px;
        }

        .service-title .highlight {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .service-title .underline-text {
            position: relative;
            display: inline-block;
        }

        .service-title .underline-text::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(79, 70, 229, 0.3) 100%);
            border-radius: 4px;
            z-index: -1;
        }

        .service-description {
            font-size: 1.05rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .service-description strong {
            color: var(--text-primary);
        }

        .service-description-extra {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 32px;
        }

        /* Feature Pills */
        .service-features {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
        }

        .feature-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            transition: all 0.2s;
        }

        .feature-pill:hover {
            border-color: var(--primary-light);
            color: var(--primary);
            background: #eff6ff;
        }

        .feature-pill i {
            color: var(--success);
            font-size: 0.9rem;
        }

        /* Buttons */
        .service-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .service-btn {
            padding: 16px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: var(--radius);
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

        .service-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .service-btn:hover::before {
            left: 100%;
        }

        .service-btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(30, 64, 175, 0.35);
        }

        .service-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(30, 64, 175, 0.45);
            color: white;
        }

        .service-btn-secondary {
            background: var(--bg-card);
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .service-btn-secondary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.25);
        }

        .btn-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Trust Indicators */
        .trust-indicators {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 24px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .trust-item {
            flex: 1;
            text-align: center;
            padding: 0 16px;
        }

        .trust-number {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 4px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .trust-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .trust-divider {
            width: 1px;
            height: 50px;
            background: linear-gradient(180deg, transparent 0%, var(--border) 50%, transparent 100%);
        }

        /* ==================== CIRCULAR SERVICE MENU ==================== */
        .service-circle-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .holderCircle {
            width: 480px;
            height: 480px;
            border-radius: 50%;
            position: relative;
            margin: 0 auto;
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
            border-radius: 50%;
            z-index: 20;
            transition: transform 2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .round {
            position: absolute;
            left: 40px;
            top: 40px;
            width: 400px;
            height: 400px;
            border: 2px dashed var(--border);
            border-radius: 50%;
            animation: rotateRound 60s infinite linear;
        }

        @keyframes rotateRound {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Service Dots */
        .itemDot {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            position: absolute;
            background: var(--bg-card);
            color: var(--text-secondary);
            border-radius: 50%;
            font-size: 1.5rem;
            z-index: 3;
            cursor: pointer;
            border: 2px solid var(--border);
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .itemDot:hover {
            transform: scale(1.1);
            border-color: var(--primary-light);
            color: var(--primary);
            box-shadow: var(--shadow-lg);
        }

        .itemDot.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            border: 3px solid white;
            box-shadow: 0 8px 30px rgba(30, 64, 175, 0.4);
            transform: scale(1.15);
        }

        .itemDot .forActive {
            display: none;
        }

        .itemDot.active .forActive {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            border-radius: 50%;
            animation: pulseRing 2s infinite;
        }

        @keyframes pulseRing {
            0% {
                box-shadow: 0 0 0 0 rgba(30, 64, 175, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(30, 64, 175, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(30, 64, 175, 0);
            }
        }

        /* Content Circle (Center) */
        .contentCircle {
            width: 280px;
            height: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--bg-card);
            border-radius: 50%;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .CirItem {
            position: absolute;
            text-align: center;
            padding: 30px;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .CirItem.active {
            opacity: 1;
            transform: scale(1);
        }

        .CirItem .service-icon-large {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .CirItem .service-icon-large i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .CirItem .title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .CirItem .title span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .CirItem p {
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.5;
            margin: 0;
        }

        /* Progress Indicators */
        .service-progress {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .progress-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--border);
            transition: all 0.3s;
            cursor: pointer;
        }

        .progress-dot.active {
            background: var(--primary);
            width: 24px;
            border-radius: 4px;
        }

        /* ==================== BOOKING MODAL ==================== */
        .booking-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .booking-modal-overlay.show {
            display: flex;
        }

        .booking-modal {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .booking-modal-header {
            padding: 24px 28px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .booking-modal-header p {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 4px 0 0 0;
        }

        .modal-close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            transition: all 0.2s;
        }

        .modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .booking-modal-body {
            padding: 28px;
            max-height: calc(90vh - 180px);
            overflow-y: auto;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .form-label .required {
            color: #dc2626;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.925rem;
            color: var(--text-primary);
            background: var(--bg-card);
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .booking-modal-footer {
            padding: 20px 28px;
            background: var(--bg-light);
            border-top: 1px solid var(--border);
            display: flex;
            gap: 12px;
        }

        .modal-btn {
            flex: 1;
            padding: 14px 24px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .modal-btn-cancel {
            background: var(--bg-card);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .modal-btn-cancel:hover {
            background: var(--bg-light);
            border-color: var(--text-muted);
        }

        .modal-btn-submit {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .modal-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
        }

        /* Service Type Cards in Modal */
        .service-type-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 8px;
        }

        .service-type-option {
            position: relative;
        }

        .service-type-option input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .service-type-card {
            padding: 14px 10px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        .service-type-card i {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 6px;
            display: block;
            transition: color 0.2s;
        }

        .service-type-card span {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .service-type-option input:checked+.service-type-card {
            border-color: var(--primary);
            background: #eff6ff;
        }

        .service-type-option input:checked+.service-type-card i {
            color: var(--primary);
        }

        .service-type-option input:checked+.service-type-card span {
            color: var(--primary);
            font-weight: 600;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1024px) {
            .service-wrapper {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .service-content {
                position: static;
                text-align: center;
            }

            .service-features {
                justify-content: center;
            }

            .service-buttons {
                justify-content: center;
            }

            .trust-indicators {
                max-width: 500px;
                margin: 0 auto;
            }

            .service-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .service-section {
                padding: 60px 0;
            }

            .service-title {
                font-size: 2rem;
            }

            .service-buttons {
                flex-direction: column;
                align-items: center;
            }

            .service-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .trust-indicators {
                flex-wrap: wrap;
                gap: 16px;
            }

            .trust-divider {
                display: none;
            }

            .trust-item {
                flex: 0 0 calc(33.333% - 12px);
            }

            .holderCircle {
                width: 320px;
                height: 320px;
            }

            .round {
                width: 260px;
                height: 260px;
                left: 30px;
                top: 30px;
            }

            .itemDot {
                width: 56px;
                height: 56px;
                font-size: 1.2rem;
            }

            .contentCircle {
                width: 180px;
                height: 180px;
            }

            .CirItem {
                padding: 15px;
            }

            .CirItem .service-icon-large {
                width: 40px;
                height: 40px;
                margin-bottom: 10px;
            }

            .CirItem .service-icon-large i {
                font-size: 1rem;
            }

            .CirItem .title {
                font-size: 0.9rem;
            }

            .CirItem p {
                font-size: 0.7rem;
                display: none;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .service-type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .service-title {
                font-size: 1.75rem;
            }

            .service-badge {
                font-size: 0.7rem;
                padding: 6px 12px;
            }

            .trust-item {
                flex: 0 0 100%;
            }

            .trust-number {
                font-size: 1.5rem;
            }

            .holderCircle {
                width: 280px;
                height: 280px;
            }

            .round {
                width: 220px;
                height: 220px;
                left: 30px;
                top: 30px;
            }

            .itemDot {
                width: 48px;
                height: 48px;
                font-size: 1rem;
            }

            .contentCircle {
                width: 150px;
                height: 150px;
            }

            .booking-modal-body {
                padding: 20px;
            }

            .service-type-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

    <!-- ==================== SERVICE SECTION ==================== -->
    <section class="service-section" id="services">
        <div class="service-container">
            <div class="service-wrapper">
                <!-- Left Content -->
                <div class="service-content">
                    <div class="service-badge">
                        <span class="service-badge-icon">💧</span>
                        <span>Our Services</span>
                    </div>

                    <h2 class="service-title">
                        Pure <span class="highlight">Aqua Tech</span><br>
                        <span class="underline-text">Services</span>
                    </h2>

                    <p class="service-description">
                        We provide <strong>end-to-end water purifier solutions</strong> for your home and office —
                        installation, repair, filter replacement, and more.
                    </p>

                    <p class="service-description-extra">
                        Ensure pure water and peace of mind with our certified technicians and fast response service.
                    </p>

                    <!-- Feature Pills -->
                    <div class="service-features">
                        <span class="feature-pill"><i class="bi bi-check-circle-fill"></i> Certified Technicians</span>
                        <span class="feature-pill"><i class="bi bi-check-circle-fill"></i> Genuine Parts</span>
                        <span class="feature-pill"><i class="bi bi-check-circle-fill"></i> Same Day Service</span>
                        <span class="feature-pill"><i class="bi bi-check-circle-fill"></i> Warranty Support</span>
                    </div>

                    <!-- Buttons -->
                    <div class="service-buttons">
                        <button type="button" class="service-btn service-btn-primary" onclick="openBookingModal()">
                            <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Book Service Now
                        </button>
                        <a href="#contact" class="service-btn service-btn-secondary">
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

                <!-- Right Circular Service Menu -->
                <div class="service-circle-wrapper">
                    <div class="holderCircle">
                        <div class="round"></div>
                        <div class="dotCircle">
                            <span class="itemDot active itemDot1" data-tab="1">
                                <i class="bi bi-tools"></i>
                                <span class="forActive"></span>
                            </span>
                            <span class="itemDot itemDot2" data-tab="2">
                                <i class="bi bi-droplet-fill"></i>
                                <span class="forActive"></span>
                            </span>
                            <span class="itemDot itemDot3" data-tab="3">
                                <i class="bi bi-arrow-repeat"></i>
                                <span class="forActive"></span>
                            </span>
                            <span class="itemDot itemDot4" data-tab="4">
                                <i class="bi bi-shield-check"></i>
                                <span class="forActive"></span>
                            </span>
                            <span class="itemDot itemDot5" data-tab="5">
                                <i class="bi bi-gear-fill"></i>
                                <span class="forActive"></span>
                            </span>
                            <span class="itemDot itemDot6" data-tab="6">
                                <i class="bi bi-headset"></i>
                                <span class="forActive"></span>
                            </span>
                        </div>

                        <div class="contentCircle">
                            <div class="CirItem active CirItem1">
                                <div class="service-icon-large">
                                    <i class="bi bi-tools"></i>
                                </div>
                                <h3 class="title"><span>Installation</span></h3>
                                <p>Expert installation of all types of water purifiers with quick, reliable service.</p>
                            </div>
                            <div class="CirItem CirItem2">
                                <div class="service-icon-large">
                                    <i class="bi bi-droplet-fill"></i>
                                </div>
                                <h3 class="title"><span>Filter Replacement</span></h3>
                                <p>Regular filter and membrane replacements by certified technicians.</p>
                            </div>
                            <div class="CirItem CirItem3">
                                <div class="service-icon-large">
                                    <i class="bi bi-arrow-repeat"></i>
                                </div>
                                <h3 class="title"><span>Maintenance</span></h3>
                                <p>Scheduled maintenance ensures efficient performance and extends lifespan.</p>
                            </div>
                            <div class="CirItem CirItem4">
                                <div class="service-icon-large">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h3 class="title"><span>Repairs</span></h3>
                                <p>Fast diagnosis and genuine parts for all RO, UV, and UF brands.</p>
                            </div>
                            <div class="CirItem CirItem5">
                                <div class="service-icon-large">
                                    <i class="bi bi-gear-fill"></i>
                                </div>
                                <h3 class="title"><span>AMC Plans</span></h3>
                                <p>Worry-free service with affordable Annual Maintenance Contracts.</p>
                            </div>
                            <div class="CirItem CirItem6">
                                <div class="service-icon-large">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <h3 class="title"><span>24/7 Support</span></h3>
                                <p>Customer care available anytime for quick service and troubleshooting.</p>
                            </div>
                        </div>

                        <!-- Progress Dots -->
                        <div class="service-progress">
                            <span class="progress-dot active" data-tab="1"></span>
                            <span class="progress-dot" data-tab="2"></span>
                            <span class="progress-dot" data-tab="3"></span>
                            <span class="progress-dot" data-tab="4"></span>
                            <span class="progress-dot" data-tab="5"></span>
                            <span class="progress-dot" data-tab="6"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== BOOKING MODAL ==================== -->
    <div class="booking-modal-overlay" id="bookingModal">
        <div class="booking-modal">
            <div class="booking-modal-header">
                <div>
                    <h3><i class="bi bi-calendar-check"></i> Book Your Service</h3>
                    <p>Fill in the details and we'll get back to you shortly</p>
                </div>
                <button class="modal-close-btn" onclick="closeBookingModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <form id="serviceBookingForm">
                @csrf
                <div class="booking-modal-body">
                    <!-- Service Type Selection -->
                    <div class="form-group">
                        <label class="form-label">Select Service Type <span class="required">*</span></label>
                        <div class="service-type-grid">
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="Installation" required>
                                <div class="service-type-card">
                                    <i class="bi bi-tools"></i>
                                    <span>Installation</span>
                                </div>
                            </label>
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="Maintenance">
                                <div class="service-type-card">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span>Maintenance</span>
                                </div>
                            </label>
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="Filter Change">
                                <div class="service-type-card">
                                    <i class="bi bi-droplet-fill"></i>
                                    <span>Filter Change</span>
                                </div>
                            </label>
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="Repair">
                                <div class="service-type-card">
                                    <i class="bi bi-wrench-adjustable"></i>
                                    <span>Repair</span>
                                </div>
                            </label>
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="Water Testing">
                                <div class="service-type-card">
                                    <i class="bi bi-clipboard2-pulse"></i>
                                    <span>Water Testing</span>
                                </div>
                            </label>
                            <label class="service-type-option">
                                <input type="radio" name="service_type" value="AMC">
                                <div class="service-type-card">
                                    <i class="bi bi-shield-check"></i>
                                    <span>AMC</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number <span class="required">*</span></label>
                            <input type="tel" name="phone" class="form-input" placeholder="Enter phone number"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" placeholder="Enter email (optional)">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Preferred Date <span class="required">*</span></label>
                            <input type="date" name="preferred_date" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Preferred Time <span class="required">*</span></label>
                            <input type="time" name="preferred_time" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address / Additional Notes</label>
                        <textarea name="notes" class="form-input" rows="3"
                            placeholder="Enter your address or any specific requirements..."></textarea>
                    </div>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </div>

                <div class="booking-modal-footer">
                    <button type="button" class="modal-btn modal-btn-cancel" onclick="closeBookingModal()">
                        Cancel
                    </button>
                    <button type="submit" class="modal-btn modal-btn-submit">
                        <i class="bi bi-check2-circle"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let currentTab = 1;
        const totalTabs = 6;
        let autoRotateInterval;

        $(document).ready(function() {
            // Position dots in circle
            positionDots();

            // Start auto rotation
            startAutoRotate();

            // Click on dots
            $('.itemDot').click(function() {
                const tab = $(this).data('tab');
                setActiveTab(tab);
                resetAutoRotate();
            });

            // Click on progress dots
            $('.progress-dot').click(function() {
                const tab = $(this).data('tab');
                setActiveTab(tab);
                resetAutoRotate();
            });

            // Set min date for booking
            const today = new Date().toISOString().split('T')[0];
            $('input[name="preferred_date"]').attr('min', today);
        });

        function positionDots() {
            const container = $('.dotCircle');
            const width = container.width();
            const height = container.height();
            const radius = width / 2.5;
            const fields = $('.itemDot');
            let angle = -Math.PI / 2; // Start from top
            const step = (2 * Math.PI) / fields.length;

            fields.each(function() {
                const x = Math.round(width / 2 + radius * Math.cos(angle) - $(this).width() / 2);
                const y = Math.round(height / 2 + radius * Math.sin(angle) - $(this).height() / 2);
                $(this).css({
                    left: x + 'px',
                    top: y + 'px'
                });
                angle += step;
            });
        }

        function setActiveTab(tab) {
            currentTab = tab;

            // Update dots
            $('.itemDot').removeClass('active');
            $(`.itemDot[data-tab="${tab}"]`).addClass('active');

            // Update content
            $('.CirItem').removeClass('active');
            $(`.CirItem${tab}`).addClass('active');

            // Update progress dots
            $('.progress-dot').removeClass('active');
            $(`.progress-dot[data-tab="${tab}"]`).addClass('active');
        }

        function startAutoRotate() {
            autoRotateInterval = setInterval(function() {
                currentTab++;
                if (currentTab > totalTabs) {
                    currentTab = 1;
                }
                setActiveTab(currentTab);
            }, 4000);
        }

        function resetAutoRotate() {
            clearInterval(autoRotateInterval);
            startAutoRotate();
        }

        // Modal Functions
        function openBookingModal() {
            document.getElementById('bookingModal').classList.add('show');
            document.body.style.overflow = 'hidden';
            getLocation();
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        // Close modal on outside click
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        // Geolocation
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;
                    },
                    (error) => {
                        console.log('Geolocation error:', error);
                    }
                );
            }
        }

        // Form submission
        $('#serviceBookingForm').on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $(this).find('.modal-btn-submit');
            const originalText = submitBtn.html();
            submitBtn.html('<i class="bi bi-hourglass-split"></i> Processing...').prop('disabled', true);

            $.ajax({
                url: "{{ route('service.book') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    submitBtn.html('<i class="bi bi-check-circle-fill"></i> Booked!').css('background',
                        'linear-gradient(135deg, #059669 0%, #10b981 100%)');

                    setTimeout(() => {
                        alert(response.message ||
                            'Service booked successfully! We will contact you shortly.');
                        $('#serviceBookingForm')[0].reset();
                        closeBookingModal();
                        submitBtn.html(originalText).css('background', '').prop('disabled',
                            false);
                    }, 1000);
                },
                error: function(xhr) {
                    submitBtn.html(originalText).prop('disabled', false);
                    alert("Please fill all required fields correctly.");
                }
            });
        });

        // Recalculate positions on window resize
        $(window).on('resize', function() {
            positionDots();
        });
    </script>

    {{-- 
    Professional Product Banner & Product List Design
    
    Color Psychology Applied:
    - Primary Blue (#1e40af): Trust, reliability
    - Accent colors for offers: Urgency (amber/red for sales)
    - Clean whites/grays: Professional feel
    
    Design Principles:
    - Consistent with other redesigned sections
    - Clear visual hierarchy
    - Engaging hover effects
    - Professional typography
--}}





    <!-- ==================== CATEGORY PRODUCTS SECTION ==================== -->
    <section class="category-products-section">
        <div class="category-products-container">
            <!-- Section Header -->
            <div class="section-header">
                <span class="section-badge wow fadeInUp" data-wow-delay="0.1s">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Browse Collection
                </span>
                <h2 class="section-title wow fadeInUp" data-wow-delay="0.2s">
                    All <span class="highlight">Category</span> Products
                </h2>
            </div>

            <!-- Category Carousel -->
            <div class="category-carousel owl-carousel productList-carousel wow fadeInUp" data-wow-delay="0.3s">
                @foreach ($categories as $category)
                    <!-- Products Inner Carousel for each category -->
                    <div class="products-inner-carousel owl-carousel productImg-carousel">
                        @foreach ($category->products as $categoryProduct)
                            <div class="product-mini-card">
                                <div class="product-mini-inner">
                                    <!-- Product Image -->
                                    <div class="product-mini-image">
                                        <img src="{{ asset('storage/' . $categoryProduct->main_image) }}"
                                            alt="{{ $categoryProduct->name }}">
                                        <div class="product-mini-view">
                                            <a
                                                href="{{ route('product.show', [$categoryProduct->id, $categoryProduct->slug]) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="product-mini-info">
                                        <a href="#" class="product-mini-category">{{ $category->name }}</a>
                                        <a href="{{ route('product.show', [$categoryProduct->id, $categoryProduct->slug]) }}"
                                            class="product-mini-name">
                                            {{ $categoryProduct->name }}
                                        </a>
                                        <div class="product-mini-price">
                                            @if ($categoryProduct->discount > 0)
                                                <span class="current">
                                                    ₹{{ number_format($categoryProduct->price - ($categoryProduct->price * $categoryProduct->discount) / 100, 2) }}
                                                </span>
                                                <span class="original">
                                                    ₹{{ number_format($categoryProduct->price, 2) }}
                                                </span>
                                            @else
                                                <span class="current">
                                                    ₹{{ number_format($categoryProduct->price, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Actions -->
                                <div class="product-mini-actions">
                                    <a href="{{ route('cart.add', $categoryProduct->id) }}"
                                        class="product-mini-cart-btn add-to-cart"
                                        data-product-id="{{ $categoryProduct->id }}">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </a>
                                    <div class="product-mini-quick-actions">
                                        <a href="#" class="product-mini-quick-btn compare"
                                            data-product-id="{{ $categoryProduct->id }}" title="Compare">
                                            <i class="bi bi-arrow-left-right"></i>
                                        </a>
                                        <a href="#" class="product-mini-quick-btn wishlist"
                                            data-product-id="{{ $categoryProduct->id }}" title="Add to Wishlist">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Owl Carousel for Category List
            if (typeof $.fn.owlCarousel !== 'undefined') {
                // Main category carousel
                $('.productList-carousel').owlCarousel({
                    loop: true,
                    margin: 24,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    navText: [
                        '<i class="bi bi-chevron-left"></i>',
                        '<i class="bi bi-chevron-right"></i>'
                    ],
                    responsive: {
                        0: {
                            items: 1
                        },
                        768: {
                            items: 2
                        },
                        1024: {
                            items: 2
                        },
                        1200: {
                            items: 3
                        }
                    }
                });

                // Inner product carousel within each category
                $('.productImg-carousel').owlCarousel({
                    loop: true,
                    margin: 16,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
                    items: 1
                });
            }

            // Add to Cart functionality
            document.querySelectorAll('.product-mini-cart-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const originalText = this.innerHTML;

                    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';
                    this.style.pointerEvents = 'none';

                    fetch(`/cart/add/${productId}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw data;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.innerHTML = '<i class="bi bi-check-lg"></i> Added!';
                                this.style.background = '#059669';

                                setTimeout(() => {
                                    this.innerHTML = originalText;
                                    this.style.background = '';
                                    this.style.pointerEvents = 'auto';
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            if (error.redirect) {
                                window.location.href = error.redirect;
                            } else {
                                this.innerHTML = '<i class="bi bi-x-lg"></i> Error';
                                this.style.background = '#dc2626';

                                setTimeout(() => {
                                    this.innerHTML = originalText;
                                    this.style.background = '';
                                    this.style.pointerEvents = 'auto';
                                }, 2000);
                            }
                        });
                });
            });

            // Wishlist toggle
            document.querySelectorAll('.product-mini-quick-btn.wishlist').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const icon = this.querySelector('i');

                    if (icon.classList.contains('bi-heart')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                        this.style.background = '#fef2f2';
                        this.style.borderColor = '#dc2626';
                        this.style.color = '#dc2626';
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                        this.style.background = '';
                        this.style.borderColor = '';
                        this.style.color = '';
                    }
                });
            });
        });
    </script>
    {{-- ============================================================================ --}}
    {{-- USEDDDDDDDDD --}}
    <!-- Product Banner Start -->
    {{-- <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">

                @if ($amountOffer)
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


                @if ($percentageOffer)
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
    <div class="container-fluid products productList overflow-hidden bg-light">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Products</h4>
                <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">All Category Products</h1>
            </div>
            <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
                @foreach ($categories as $category)
                    <div class="productImg-carousel owl-carousel productList-item">

                        @foreach ($category->products as $categoryProduct)
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
                                            @if ($categoryProduct->discount > 0)
                                                <del
                                                    class="me-2 fs-5">₹{{ number_format($categoryProduct->price, 2) }}</del>
                                                <span class="text-primary fs-5">
                                                    ₹{{ number_format($categoryProduct->price - ($categoryProduct->price * $categoryProduct->discount) / 100, 2) }}
                                                </span>
                                            @else
                                                <span
                                                    class="text-primary fs-5">₹{{ number_format($categoryProduct->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="products-mini-add border p-3">
                                    <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4">
                                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                    </a>
                                    <div class="d-flex">
                                        <a href="#"
                                            class="text-primary d-flex align-items-center justify-content-center me-3">
                                            <span class="rounded-circle btn-sm-square border">
                                                <i class="fas fa-random"></i>
                                            </span>
                                        </a>
                                        <a href="#"
                                            class="text-primary d-flex align-items-center justify-content-center me-0">
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
    </div> --}}
    <!-- Product List End -->
    {{-- USEDDDDDDDDD ENDDDDDD --}}
    {{-- ============================================================================ --}}

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
