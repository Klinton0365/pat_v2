@extends('user.layout.app')
@section('content')

<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </nav>

    <h2 class="mb-4">Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($cartItems->count())
        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Cart Items ({{ $cartItems->count() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($cartItems as $item)
                            <div class="cart-item border-bottom p-3 p-md-4">
                                <div class="row align-items-center">
                                    <!-- Product Image -->
                                    <div class="col-md-2 col-3 mb-3 mb-md-0">
                                        <a href="{{ route('product.show', [$item->product->id, $item->product->slug]) }}">
                                            <img src="{{ $item->product->main_image ? asset('storage/' . $item->product->main_image) : asset('images/no-image.png') }}" 
                                                 class="img-fluid rounded" 
                                                 alt="{{ $item->product->name }}"
                                                 style="max-height: 100px; object-fit: cover;">
                                        </a>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="col-md-4 col-9 mb-3 mb-md-0">
                                        <h6 class="mb-2">
                                            <a href="{{ route('product.show', [$item->product->id, $item->product->slug]) }}" class="text-decoration-none text-dark">
                                                {{ $item->product->name }}
                                            </a>
                                        </h6>
                                        
                                        @if($item->product->sku)
                                            <p class="text-muted small mb-1">SKU: {{ $item->product->sku }}</p>
                                        @endif

                                        @if($item->color)
                                            <p class="text-muted small mb-1">
                                                Color: <span class="badge bg-light text-dark">{{ $item->color }}</span>
                                            </p>
                                        @endif

                                        <!-- Stock Status -->
                                        @if($item->product->stock > 0)
                                            <p class="text-success small mb-0">
                                                <i class="bi bi-check-circle"></i> In Stock
                                            </p>
                                        @else
                                            <p class="text-danger small mb-0">
                                                <i class="bi bi-x-circle"></i> Out of Stock
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="col-md-3 col-6 mb-3 mb-md-0">
                                        <div class="input-group input-group-sm" style="max-width: 130px;">
                                            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item->id }}, -1)">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" 
                                                   class="form-control text-center" 
                                                   id="qty-{{ $item->id }}" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock }}"
                                                   readonly>
                                            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item->id }}, 1)">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Price & Remove -->
                                    <div class="col-md-3 col-6 text-md-end">
                                        <div class="mb-2">
                                            @if($item->product->discount > 0)
                                                <p class="mb-1">
                                                    <small class="text-muted text-decoration-line-through">
                                                        ₹{{ number_format($item->product->price, 2) }}
                                                    </small>
                                                </p>
                                                <h6 class="text-danger mb-0">₹{{ number_format($item->price, 2) }}</h6>
                                            @else
                                                <h6 class="mb-0">₹{{ number_format($item->price, 2) }}</h6>
                                            @endif
                                            <p class="text-muted small mb-0">× {{ $item->quantity }}</p>
                                        </div>
                                        <div>
                                            <strong class="text-primary">₹{{ number_format($item->quantity * $item->price, 2) }}</strong>
                                        </div>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('Remove this item from cart?')">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Continue Shopping Button -->
                <div class="mt-3">
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $subtotal = $cartItems->sum(function($item) {
                                return $item->quantity * $item->price;
                            });
                            $totalDiscount = $cartItems->sum(function($item) {
                                return $item->quantity * ($item->product->price - $item->price);
                            });
                            $shipping = 0; // Calculate based on your logic
                            $tax = $subtotal * 0.18; // 18% GST example
                            $total = $subtotal + $shipping + $tax;
                        @endphp

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>₹{{ number_format($subtotal, 2) }}</strong>
                        </div>

                        @if($totalDiscount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Discount:</span>
                                <strong>-₹{{ number_format($totalDiscount, 2) }}</strong>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <strong>{{ $shipping == 0 ? 'FREE' : '₹' . number_format($shipping, 2) }}</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (GST 18%):</span>
                            <strong>₹{{ number_format($tax, 2) }}</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">Total:</h5>
                            <h5 class="mb-0 text-primary">₹{{ number_format($total, 2) }}</h5>
                        </div>

                        <!-- Promo Code Section -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo Code" id="promoCode">
                                <button class="btn btn-outline-secondary" type="button">Apply</button>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-lock"></i> Proceed to Checkout
                        </a>

                        <div class="text-center">
                            <small class="text-muted">
                                <i class="bi bi-shield-check"></i> Secure Checkout
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-truck text-primary me-2"></i>
                            <small>Free shipping on orders above ₹500</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-arrow-repeat text-primary me-2"></i>
                            <small>Easy 7-day return policy</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-check text-primary me-2"></i>
                            <small>100% secure payment</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="row justify-content-center">
            <div class="col-md-6 text-center py-5">
                <div class="card shadow-sm">
                    <div class="card-body py-5">
                        <i class="bi bi-cart-x" style="font-size: 4rem; color: #ddd;"></i>
                        <h4 class="mt-3 mb-2">Your Cart is Empty</h4>
                        <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="bi bi-shop"></i> Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .cart-item:last-child {
        border-bottom: none !important;
    }
    
    .cart-item:hover {
        background-color: #f8f9fa;
    }

    .input-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }

    .input-group-sm input {
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .sticky-top {
            position: relative !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
function updateQuantity(itemId, change) {
    const input = document.getElementById(`qty-${itemId}`);
    let currentQty = parseInt(input.value);
    let newQty = currentQty + change;
    
    if (newQty < 1) {
        return;
    }
    
    const max = parseInt(input.getAttribute('max'));
    if (newQty > max) {
        alert('Maximum available quantity is ' + max);
        return;
    }
    
    // Send AJAX request to update cart
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Failed to update quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update cart');
    });
}
</script>
@endpush

@endsection