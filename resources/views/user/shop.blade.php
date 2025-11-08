@extends('user.layout.app')
@section('content')
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Shop Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Searvices Start -->
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


    <!-- Products Offer Start -->
    {{-- <div class="container-fluid bg-light py-5">
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
    </div> --}}
    <!-- Products Offer End -->


    <!-- Shop Page Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-categories mb-4">
                        <h4>Products Categories</h4>
                        <ul class="list-unstyled">
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>
                                        Accessories</a>
                                    <span>(3)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>
                                        Electronics & Computer</a>
                                    <span>(5)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>Laptops & Desktops</a>
                                    <span>(2)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>Mobiles & Tablets</a>
                                    <span>(8)</span>
                                </div>
                            </li>
                            <li>
                                <div class="categories-item">
                                    <a href="#" class="text-dark"><i
                                            class="fas fa-apple-alt text-secondary me-2"></i>SmartPhone & Smart TV</a>
                                    <span>(5)</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="price mb-4">
                        <h4 class="mb-2">Price</h4>
                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500"
                            value="0" oninput="amount.value=rangeInput.value">
                        <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                        <div class=""></div>
                    </div>

                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Featured products</h4>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-3.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">SmartPhone</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-4.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Smart Camera</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-5.png" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2">Camera Leance</h6>
                                <div class="d-flex mb-2">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">2.99 $</h5>
                                    <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn btn-primary px-4 py-3 rounded-pill w-100">Vew More</a>
                        </div>
                    </div>
                    <a href="#">
                        <div class="position-relative">
                            <img src="img/product-banner-2.jpg" class="img-fluid w-100 rounded" alt="Image">
                            <div class="text-center position-absolute d-flex flex-column align-items-center justify-content-center rounded p-4"
                                style="width: 100%; height: 100%; top: 0; right: 0; background: rgba(242, 139, 0, 0.3);">
                                <h5 class="display-6 text-primary">SALE</h5>
                                <h4 class="text-secondary">Get UP To 50% Off</h4>
                                <a href="#" class="btn btn-primary rounded-pill px-4">Shop Now</a>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4">
                        <div class="col-xl-7">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-3 text-end">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                                <label for="electronics">Sort By:</label>
                                <select id="electronics" name="electronicslist"
                                    class="border-0 form-select-sm bg-light me-3" form="electronicsform">
                                    <option value="volvo">Default Sorting</option>
                                    <option value="volv">Nothing</option>
                                    <option value="sab">Popularity</option>
                                    <option value="saab">Newness</option>
                                    <option value="opel">Average Rating</option>
                                    <option value="audio">Low to high</option>
                                    <option value="audi">High to low</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="tab-content">
                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4 product">
                                <div class="col-lg-4">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
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
                                <div class="col-lg-4">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <img src="img/product-4.png" class="img-fluid w-100 rounded-top" alt="">
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
                                <div class="col-lg-4">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <img src="img/product-5.png" class="img-fluid w-100 rounded-top" alt="">
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
                                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                            
                                            <li class="nav-item mb-4">
                                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active"
                                                    data-bs-toggle="pill" href="#tab-all" data-category="all">
                                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                                </a>
                                            </li>

                                           
                                            @foreach($categories as $index => $category)
                                                <li class="nav-item mb-4">
                                                    <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill"
                                                        href="#tab-{{ $category->id }}" data-category="{{ $category->id }}">
                                                        <span class="text-dark"
                                                            style="width: 130px;">{{ $category->name }}</span>
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
                                                                        ${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                                                                    </span>
                                                                    <span class="price-original">
                                                                        ${{ number_format($product->price, 2) }}
                                                                    </span>
                                                                @else
                                                                    <span class="price-current">
                                                                        ${{ number_format($product->price, 2) }}
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
                                                                <a href="#" class="btn-add-cart add-to-cart"
                                                                    data-product-id="{{ $product->id }}">
                                                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                                </a>
                                                                <a href="#" class="btn-wishlist wishlist-btn"
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
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End -->

    <!-- Product Banner Start -->
    <div class="container-fluid py-5">
        <div class="container pb-5">
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
@endsection