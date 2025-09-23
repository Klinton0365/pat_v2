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
                    <div class="input-group w-100 mx-auto d-flex mb-4">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
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
                    <div class="additional-product mb-4">
                        <h4>Select By Color</h4>
                        <div class="additional-product-item">
                            <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                            <label for="Categories-1" class="text-dark"> Gold</label>
                        </div>
                        <div class="additional-product-item">
                            <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                            <label for="Categories-2" class="text-dark"> Green</label>
                        </div>
                        <div class="additional-product-item">
                            <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                            <label for="Categories-3" class="text-dark"> White</label>
                        </div>
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
                                <img src="img/product-6.png" class="img-fluid rounded" alt="Image">
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
                                <img src="img/product-7.png" class="img-fluid rounded" alt="Image">
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
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <img src="img/product-8.png" class="img-fluid rounded" alt="Image">
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
                    <div class="product-tags my-4">
                        <h4 class="mb-3">PRODUCT TAGS</h4>
                        <div class="product-tags-items bg-light rounded p-3">
                            <a href="#" class="border rounded py-1 px-2 mb-2">New</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">brand</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">black</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">white</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">tablats</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">phone</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">camera</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">drone</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">talevision</a>
                            <a href="#" class="border rounded py-1 px-2 mb-2">slaes</a>
                        </div>
                    </div>
                </div>
                {{-- - <div class="col-lg-7 col-xl-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4 single-product">
                        <div class="col-xl-6">
                            <div class="single-carousel owl-carousel">
                                <div class="single-item"
                                    data-dot="<img class='img-fluid' src='img/product-4.png' alt=''>">
                                    <div class="single-inner bg-light rounded">
                                        <img src="img/product-4.png" class="img-fluid rounded" alt="Image">
                                    </div>
                                </div>
                                <div class="single-item"
                                    data-dot="<img class='img-fluid' src='img/product-5.png' alt=''>">
                                    <div class="single-inner bg-light rounded">
                                        <img src="img/product-5.png" class="img-fluid rounded" alt="Image">
                                    </div>
                                </div>
                                <div class="single-item"
                                    data-dot="<img class='img-fluid' src='img/product-6.png' alt=''>">
                                    <div class="single-inner bg-light rounded">
                                        <img src="img/product-6.png" class="img-fluid rounded" alt="Image">
                                    </div>
                                </div>
                                <div class="single-item"
                                    data-dot="<img class='img-fluid' src='img/product-7.png' alt=''>">
                                    <div class="single-inner bg-light rounded">
                                        <img src="img/product-7.png" class="img-fluid rounded" alt="Image">
                                    </div>
                                </div>
                                <div class="single-item"
                                    data-dot="<img class='img-fluid' src='img/product-3.png' alt=''>">
                                    <div class="single-inner bg-light rounded">
                                        <img src="img/product-3.png" class="img-fluid rounded" alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <h4 class="fw-bold mb-3">Smart Camera</h4>
                            <p class="mb-3">Category: Electronics</p>
                            <h5 class="fw-bold mb-3">3,35 $</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="mb-3">
                                <div class="btn btn-primary d-inline-block rounded text-white py-1 px-4 me-2"><i
                                        class="fab fa-facebook-f me-1"></i> Share</div>
                                <div class="btn btn-secondary d-inline-block rounded text-white py-1 px-4 ms-2"><i
                                        class="fab fa-twitter ms-1"></i> Share</div>
                            </div>
                            <div class="d-flex flex-column mb-3">
                                <small>Product SKU: N/A</small>
                                <small>Available: <strong class="text-primary">20 items in stock</strong></small>
                            </div>
                            <p class="mb-4">The generated Lorem Ipsum is therefore always free from repetition injected
                                humour, or non-characteristic words etc.</p>
                            <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder;
                                chain pickerel hatchetfish, pencilfish snailfish</p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#"
                                class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-white"></i> Add to cart</a>
                        </div>
                        
                        <form action="#">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#"
                                            class="btn btn-primary border border-secondary text-primary rounded-pill px-4 py-3">
                                            Post Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>--}}
                <div class="col-lg-7 col-xl-9 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-4 single-product">
        <div class="col-xl-6">
            <div class="single-carousel owl-carousel">
                {{-- Main Image --}}
                <div class="single-item" data-dot="<img class='img-fluid' src='{{ asset('storage/'.$product->main_image) }}' alt=''>">
                    <div class="single-inner bg-light rounded">
                        <img src="{{ asset('storage/'.$product->main_image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </div>
                </div>

                {{-- Extra Images --}}
                @if($product->product_images)
                    @foreach(json_decode($product->product_images) as $img)
                        <div class="single-item" data-dot="<img class='img-fluid' src='{{ asset('storage/'.$img) }}' alt=''>">
                            <div class="single-inner bg-light rounded">
                                <img src="{{ asset('storage/'.$img) }}" class="img-fluid rounded" alt="{{ $product->name }}">
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
                <h5 class="fw-bold mb-3">${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</h5>
            @else
                <h5 class="fw-bold mb-3">${{ number_format($product->price, 2) }}</h5>
            @endif

            {{-- Rating --}}
            <div class="d-flex mb-4">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($product->rating))
                        <i class="fa fa-star text-secondary"></i>
                    @else
                        <i class="fa fa-star"></i>
                    @endif
                @endfor
            </div>

            {{-- Stock & SKU --}}
            <div class="d-flex flex-column mb-3">
                <small>Product SKU: {{ $product->sku ?? 'N/A' }}</small>
                <small>Available: 
                    <strong class="text-primary">{{ $product->stock > 0 ? $product->stock.' items in stock' : 'Out of stock' }}</strong>
                </small>
            </div>

            {{-- Description --}}
            <p class="mb-4">{{ $product->description }}</p>

            {{-- Quantity --}}
            <div class="input-group quantity mb-5" style="width: 100px;">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-minus rounded-circle bg-light border"><i class="fa fa-minus"></i></button>
                </div>
                <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                <div class="input-group-btn">
                    <button class="btn btn-sm btn-plus rounded-circle bg-light border"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            {{-- Add to Cart --}}
            <a href="#" 
                class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary add-to-cart"
                data-product-id="{{ $product->id }}">
                <i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart
            </a>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- Single Products End -->

    <!-- Related Product Start -->
    <div class="container-fluid related-product">
        <div class="container">
            <div class="mx-auto text-center pb-5" style="max-width: 700px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                    data-wow-delay="0.1s">Related Products</h4>
                <p class="wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Modi, asperiores ducimus sint quos tempore officia similique quia? Libero, pariatur consectetur?</p>
            </div>
            <div class="related-carousel owl-carousel pt-4">
                <div class="related-item rounded">
                    <div class="related-item-inner border rounded">
                        <div class="related-item-inner-item">
                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                            <div class="related-new">New</div>
                            <div class="related-details">
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
                    <div class="related-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
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
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-item rounded">
                    <div class="related-item-inner border rounded">
                        <div class="related-item-inner-item">
                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                            <div class="related-new">New</div>
                            <div class="related-details">
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
                    <div class="related-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
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
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-item rounded">
                    <div class="related-item-inner border rounded">
                        <div class="related-item-inner-item">
                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                            <div class="related-new">New</div>
                            <div class="related-details">
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
                    <div class="related-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
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
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-item rounded">
                    <div class="related-item-inner border rounded">
                        <div class="related-item-inner-item">
                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                            <div class="related-new">New</div>
                            <div class="related-details">
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
                    <div class="related-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
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
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-item rounded">
                    <div class="related-item-inner border rounded">
                        <div class="related-item-inner-item">
                            <img src="img/product-3.png" class="img-fluid w-100 rounded-top" alt="">
                            <div class="related-new">New</div>
                            <div class="related-details">
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
                    <div class="related-item-add border border-top-0 rounded-bottom  text-center p-4 pt-0">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
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
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related Product End -->
    @endsection