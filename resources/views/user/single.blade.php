@extends('user.layout.app')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Single Product</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Single Product</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Products Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-5 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    {{-- <div class="input-group w-100 mx-auto d-flex mb-4">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div> --}}

                    <div class="product-categories mb-4">
                        <h4>Products Categories</h4>
                        <ul class="list-unstyled">
                            @foreach($categories as $cat)
                                <li>
                                    <div class="categories-item">
                                        {{-- <a href="{{ route('category.products', $cat->slug) }}" class="text-dark"> --}}
                                            <i class="fas fa-{{ $cat->icon ?? 'box' }} text-secondary me-2"></i>
                                            {{ $cat->name }}
                                            {{-- </a> --}}
                                        <span>({{ $cat->products_count ?? 0 }})</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if($product->colors && count(json_decode($product->colors)) > 0)
                        <div class="additional-product mb-4">
                            <h4>Available Colors</h4>
                            @foreach(json_decode($product->colors) as $color)
                                <div class="additional-product-item">
                                    <input type="radio" class="me-2" id="color-{{ $loop->index }}" name="product-color"
                                        value="{{ $color }}">
                                    <label for="color-{{ $loop->index }}" class="text-dark">{{ ucfirst($color) }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- @if($featuredProducts && $featuredProducts->count() > 0)
                    <div class="featured-product mb-4">
                        <h4 class="mb-3">Featured products</h4>
                        @foreach($featuredProducts as $featured)
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="{{ $featured->main_image ? asset('storage/' . $featured->main_image) : asset('img/default.png') }}"
                                    class="img-fluid rounded" style="max-height: 300px;" alt="{{ $featured->name }}">
                            </div>
                            <div>
                                <h6 class="mb-2">
                                    <a href="{{ route('product.show', [$featured->id, $featured->slug]) }}"
                                        class="text-dark">
                                        {{ Str::limit($featured->name, 30) }}
                                    </a>
                                </h6>
                                <div class="d-flex mb-2">
                                    @for($i = 1; $i <= 5; $i++) <i
                                        class="fa fa-star {{ $i <= round($featured->rating) ? 'text-secondary' : '' }}"></i>
                                        @endfor
                                </div>
                                <div class="d-flex mb-2">
                                    @if($featured->discount > 0)
                                    <h5 class="fw-bold me-2">${{ number_format($featured->price - ($featured->price *
                                        $featured->discount / 100), 2) }}</h5>
                                    <h5 class="text-danger text-decoration-line-through">${{ number_format($featured->price,
                                        2) }}</h5>
                                    @else
                                    <h5 class="fw-bold">${{ number_format($featured->price, 2) }}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-center my-4">
                            <a href="{{ route('shop') }}" class="btn btn-primary px-4 py-3 rounded-pill w-100">View More</a>
                        </div>
                    </div>
                    @endif --}}

                    <!-- Sale Banner -->
                    <a href="{{ route('shop') }}">
                        <div class="position-relative">
                            <img src="{{ asset('img/product-banner-2.jpg') }}" class="img-fluid w-100 rounded" alt="Sale">
                            <div class="text-center position-absolute d-flex flex-column align-items-center justify-content-center rounded p-4"
                                style="width: 100%; height: 100%; top: 0; right: 0; background: rgba(242, 139, 0, 0.3);">
                                <h5 class="display-6 text-primary">SALE</h5>
                                <h4 class="text-secondary">Get UP To 50% Off</h4>
                                <span class="btn btn-primary rounded-pill px-4">Shop Now</span>
                            </div>
                        </div>
                    </a>

                    <!-- Product Tags -->
                    {{-- @if($productTags && count($productTags) > 0)
                    <div class="product-tags my-4">
                        <h4 class="mb-3">PRODUCT TAGS</h4>
                        <div class="product-tags-items bg-light rounded p-3">
                            @foreach($productTags as $tag)
                            <a href="{{ route('shop', ['tag' => $tag]) }}" class="border rounded py-1 px-2 mb-2">{{ $tag
                                }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif --}}
                </div>

                <div class="col-lg-7 col-xl-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4 single-product">
                        <div class="col-xl-6">
                            <div class="single-carousel owl-carousel">

                                <div class="single-item" style="max-height: 350px;"
                                    data-dot="<img class='img-fluid' src='{{ asset('storage/' . $product->main_image) }}' alt=''>">
                                    <div class="single-inner bg-light rounded" style="max-height: 350px;">
                                        <img src="{{ asset('storage/' . $product->main_image) }}" class="img-fluid rounded"
                                            style="max-height: 300px;" alt="{{ $product->name }}">
                                    </div>
                                </div>

                                @if($product->product_images)
                                    @foreach(json_decode($product->product_images) as $img)
                                        <div class="single-item"
                                            data-dot="<img class='img-fluid' src='{{ asset('storage/' . $img) }}' alt=''>">
                                            <div class="single-inner bg-light rounded">
                                                <img src="{{ asset('storage/' . $img) }}" class="img-fluid rounded"
                                                    style="max-height: 300px;" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            <p class="mb-3">Category: {{ $product->category->name }}</p>

                            @if($product->discount > 0)
                                <del class="me-2 fs-5">${{ number_format($product->price, 2) }}</del>
                                <h5 class="fw-bold mb-3">
                                    ${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</h5>
                            @else
                                <h5 class="fw-bold mb-3">${{ number_format($product->price, 2) }}</h5>
                            @endif

                            <div class="d-flex mb-4">
                                @for($i = 1; $i <= 5; $i++) @if($i <= round($product->rating))
                                        <i class="fa fa-star text-secondary"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <small>Product SKU: {{ $product->sku ?? 'N/A' }}</small>
                                <small>Available:
                                    <strong class="text-primary">{{ $product->stock > 0 ? $product->stock . ' items in
                                                            stock' : 'Out of stock' }}</strong>
                                </small>
                            </div>

                            <p class="mb-4">{{ $product->description }}</p>

                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit"
                                    class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart
                                </button>
                            </form>

                            {{-- <a href="javascript:void(0);"
                                class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary add-to-cart"
                                data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart
                            </a> --}}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Single Products End -->

    <!-- Related Product Start -->
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
    @if($relatedProducts && $relatedProducts->count() > 0)
        <div class="container-fluid related-product py-5">
            <div class="container">
                <div class="mx-auto text-center" style="max-width: 700px;">
                    <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                        data-wow-delay="0.1s">Related Products</h4>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Discover similar products you might like</p>
                </div>
                <div class="related-carousel owl-carousel pt-4">
                    @foreach($relatedProducts as $related)
                        <div class="related-item rounded">
                            <div class="related-item-inner border rounded">
                                <div class="related-item-inner-item">
                                    <img src="{{ $related->main_image ? asset('storage/' . $related->main_image) : asset('img/default.png') }}"
                                        class="img-fluid w-100 rounded-top" style="max-height:260px;" alt="{{ $related->name }}">
                                    @if($related->featured)
                                        <div class="related-new">Featured</div>
                                    @endif
                                    <div class="related-details">
                                        <a href="{{ route('product.show', [$related->id, $related->slug]) }}">
                                            <i class="fa fa-eye fa-1x"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center rounded-bottom p-4">
                                    <a href="#" class="d-block mb-2">{{ $related->category->name }}</a>
                                    <a href="{{ route('product.show', [$related->id, $related->slug]) }}"
                                        class="d-block h4 product-name">{{ $related->name }}</a>
                                    @if($related->discount > 0)
                                        <del class="me-2 fs-5">${{ number_format($related->price, 2) }}</del>
                                        <span
                                            class="text-primary fs-5">${{ number_format($related->price - ($related->price * $related->discount / 100), 2) }}</span>
                                    @else
                                        <span class="text-primary fs-5">${{ number_format($related->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="related-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart"
                                    data-product-id="{{ $related->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= round($related->rating) ? 'text-primary' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="d-flex">
                                        <a href="#"
                                            class="text-primary d-flex align-items-center justify-content-center me-0 wishlist-btn"
                                            data-product-id="{{ $related->id }}">
                                            <span class="rounded-circle btn-sm-square border">
                                                <i class="fas fa-heart"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Related Product End -->

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.add-to-cart');

            buttons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');
                    console.log('Clicked Add to Cart for product:', productId);

                    
                    fetch("{{ route('cart.add') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ product_id: productId }),
                        credentials: "same-origin" // or "include" if using another domain/port
                    })

                        .then(response => {
                            if (!response.ok) throw new Error("Network response was not ok");
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response:', data);
                            if (data.success) {
                                alert(data.message);
                            } else {
                                alert('Something went wrong!');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            alert('Request failed — check console for details.');
                        });
                });
            });
        });
    </script> --}}

@endsection