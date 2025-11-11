@extends('user.layout.app')

@section('content')

    <div class="container py-5" style="max-width: 1400px;">
        <!-- Breadcrumb & Header -->
        <div style="margin-bottom: 2rem;">
            <h2 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Shopping Cart</h2>
            <p style="color: #6c757d; font-size: 0.95rem;">Review your items and proceed to checkout</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid #28a745; background: linear-gradient(135deg, #f1f9f4 0%, #ffffff 100%); border-radius: 8px; box-shadow: 0 2px 8px rgba(40, 167, 69, 0.1);">
                <i class="bi bi-check-circle me-2" style="color: #28a745; font-size: 1.2rem;"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-left: 4px solid #dc3545; background: linear-gradient(135deg, #fef1f2 0%, #ffffff 100%); border-radius: 8px; box-shadow: 0 2px 8px rgba(220, 53, 69, 0.1);">
                <i class="bi bi-exclamation-triangle me-2" style="color: #dc3545; font-size: 1.2rem;"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($cartItems->count())
            <div class="row g-4">
                <!-- Cart Items Section (Scrollable) -->
                <div class="col-lg-8">
                    <div class="cart-items-container" style="max-height: calc(100vh - 180px); overflow-y: auto; padding-right: 10px;">
                        <div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border-radius: 16px; overflow: hidden;">
                            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <h5 style="margin: 0; color: white; font-weight: 600; font-size: 1.1rem;">
                                            <i class="bi bi-cart3" style="margin-right: 0.5rem;"></i>Cart Items
                                        </h5>
                                        <span style="background: rgba(255, 255, 255, 0.25); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">
                                            {{ $cartItems->count() }} {{ $cartItems->count() == 1 ? 'item' : 'items' }}
                                        </span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <label style="color: white; display: flex; align-items: center; cursor: pointer; margin: 0;">
                                            <input type="checkbox" id="selectAll" style="width: 18px; height: 18px; cursor: pointer; margin-right: 0.5rem;">
                                            <span style="font-size: 0.9rem; font-weight: 500;">Select All</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @foreach($cartItems as $item)
                                    <div class="cart-item" data-item-id="{{ $item->id }}" data-original-price="{{ $item->product->price }}" data-discount="{{ $item->product->discount }}" style="border-bottom: 1px solid #f0f0f0; padding: 2rem; transition: all 0.3s ease; position: relative;">
                                        <!-- Selection Checkbox -->
                                        <div style="position: absolute; top: 2rem; left: 1rem;">
                                            <input type="checkbox" class="item-checkbox" data-item-id="{{ $item->id }}" style="width: 20px; height: 20px; cursor: pointer;" checked>
                                        </div>
                                        
                                        <div class="row align-items-center g-3" style="margin-left: 2rem;">
                                            <!-- Product Image -->
                                            <div class="col-md-2 col-3">
                                                <a href="{{ route('product.show', [$item->product->id, $item->product->slug]) }}" style="text-decoration: none;">
                                                    <div style="position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                                        <img src="{{ $item->product->main_image ? asset('storage/' . $item->product->main_image) : asset('images/no-image.png') }}"
                                                            class="img-fluid" alt="{{ $item->product->name }}"
                                                            style="max-height: 100px; object-fit: cover; width: 100%; display: block;">
                                                        @if($item->product->discount > 0)
                                                            <span style="position: absolute; top: 8px; left: 8px; background: #ff4757; color: white; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 700;">
                                                                -{{ number_format($item->product->discount, 0) }}%
                                                            </span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- Product Details -->
                                            <div class="col-md-4 col-9">
                                                <h6 style="margin-bottom: 0.75rem; font-weight: 600; font-size: 1rem;">
                                                    <a href="{{ route('product.show', [$item->product->id, $item->product->slug]) }}"
                                                        style="text-decoration: none; color: #2c3e50; transition: color 0.2s;">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h6>

                                                @if($item->product->sku)
                                                    <p style="color: #95a5a6; font-size: 0.8rem; margin-bottom: 0.5rem; font-family: 'Courier New', monospace;">
                                                        SKU: {{ $item->product->sku }}
                                                    </p>
                                                @endif

                                                @if($item->color)
                                                    <p style="margin-bottom: 0.5rem; font-size: 0.85rem;">
                                                        <span style="color: #7f8c8d; margin-right: 0.5rem;">Color:</span>
                                                        <span style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.8rem; font-weight: 500; color: #34495e;">
                                                            {{ $item->color }}
                                                        </span>
                                                    </p>
                                                @endif
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="col-md-3 col-6">
                                                <div style="display: flex; align-items: center; justify-content: center; max-width: 140px; background: #f8f9fa; border-radius: 10px; padding: 0.35rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <button type="button" class="qty-decrease" data-item-id="{{ $item->id }}"
                                                        style="border: none; background: white; color: #667eea; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; font-size: 1.1rem; font-weight: 700; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="number" class="form-control text-center qty-input" data-item-id="{{ $item->id }}"
                                                        value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                        readonly style="border: none; background: transparent; font-weight: 600; font-size: 1rem; color: #2c3e50; width: 50px; padding: 0;">
                                                    <button type="button" class="qty-increase" data-item-id="{{ $item->id }}" data-max="{{ $item->product->stock }}"
                                                        style="border: none; background: white; color: #667eea; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; font-size: 1.1rem; font-weight: 700; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Price & Remove -->
                                            <div class="col-md-3 col-6 text-md-end">
                                                <div style="margin-bottom: 1rem;">
                                                    @if($item->product->discount > 0)
                                                        <p style="margin-bottom: 0.25rem;">
                                                            <small style="color: #95a5a6; text-decoration: line-through; font-size: 0.85rem;">
                                                                ₹{{ number_format($item->product->price, 2) }}
                                                            </small>
                                                        </p>
                                                        <h6 style="color: #e74c3c; margin-bottom: 0.25rem; font-weight: 700; font-size: 1.1rem;">
                                                            ₹{{ number_format($item->product->price - ($item->product->price * $item->product->discount / 100), 2) }}
                                                        </h6>
                                                        <p style="color: #2ecc71; font-size: 0.75rem; margin-bottom: 0;">
                                                            Save ₹{{ number_format($item->product->price * $item->product->discount / 100, 2) }}
                                                        </p>
                                                    @else
                                                        <h6 style="margin-bottom: 0.25rem; font-weight: 700; color: #2c3e50; font-size: 1.1rem;">
                                                            ₹{{ number_format($item->product->price, 2) }}
                                                        </h6>
                                                    @endif
                                                </div>
                                                <div style="margin-bottom: 0.75rem;">
                                                    <p style="color: #7f8c8d; font-size: 0.8rem; margin-bottom: 0.25rem;">Total</p>
                                                    <strong class="item-total" style="color: #667eea; font-size: 1.25rem; font-weight: 700;">
                                                        ₹{{ number_format($item->quantity * ($item->product->price - ($item->product->price * $item->product->discount / 100)), 2) }}
                                                    </strong>
                                                </div>
                                                <button type="button" class="remove-item" data-item-id="{{ $item->id }}"
                                                    style="border: none; background: none; color: #e74c3c; padding: 0.5rem 1rem; cursor: pointer; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; border-radius: 6px;">
                                                    <i class="bi bi-trash3" style="margin-right: 0.25rem;"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Continue Shopping Button -->
                        <div style="margin-top: 1.5rem;">
                            <a href="{{ route('shop') }}" style="display: inline-flex; align-items: center; padding: 0.875rem 2rem; background: white; color: #667eea; text-decoration: none; border-radius: 10px; font-weight: 600; border: 2px solid #667eea; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);">
                                <i class="bi bi-arrow-left" style="margin-right: 0.5rem; font-size: 1.1rem;"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section (Fixed) -->
                <div class="col-lg-4">
                    <div style="position: sticky; top: 20px;">
                        <div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border-radius: 16px; overflow: hidden;">
                            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 1.5rem 2rem;">
                                <h5 style="margin: 0; color: white; font-weight: 600; font-size: 1.1rem;">
                                    <i class="bi bi-receipt" style="margin-right: 0.5rem;"></i>Order Summary
                                </h5>
                            </div>
                            <div class="card-body" style="padding: 2rem;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px dashed #e0e0e0;">
                                    <span style="color: #7f8c8d; font-size: 0.95rem;">Subtotal:</span>
                                    <strong id="subtotal" style="color: #2c3e50; font-size: 1rem;">₹0.00</strong>
                                </div>

                                <div id="discount-row" style="display: none; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px dashed #e0e0e0;">
                                    <span style="color: #2ecc71; font-size: 0.95rem;">
                                        <i class="bi bi-tag-fill" style="margin-right: 0.25rem;"></i>Discount:
                                    </span>
                                    <strong id="discount-amount" style="color: #2ecc71; font-size: 1rem;">-₹0.00</strong>
                                </div>

                                <div id="coupon-discount-row" style="display: none; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px dashed #e0e0e0;">
                                    <span style="color: #2ecc71; font-size: 0.95rem;">
                                        <i class="bi bi-ticket-perforated-fill" style="margin-right: 0.25rem;"></i>Coupon:
                                    </span>
                                    <strong id="coupon-discount-amount" style="color: #2ecc71; font-size: 1rem;">-₹0.00</strong>
                                </div>

                                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px dashed #e0e0e0;">
                                    <span style="color: #7f8c8d; font-size: 0.95rem;">
                                        <i class="bi bi-truck" style="margin-right: 0.25rem;"></i>Shipping:
                                    </span>
                                    <strong id="shipping" style="color: #2ecc71; font-size: 1rem;">FREE</strong>
                                </div>

                                <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 2px solid #e0e0e0;">
                                    <span style="color: #7f8c8d; font-size: 0.95rem;">Tax (GST 18%):</span>
                                    <strong id="tax" style="color: #2c3e50; font-size: 1rem;">₹0.00</strong>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding: 1.25rem; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 12px;">
                                    <h5 style="margin: 0; color: #2c3e50; font-weight: 700; font-size: 1.1rem;">Total:</h5>
                                    <h5 id="total" style="margin: 0; color: #667eea; font-weight: 700; font-size: 1.5rem;">₹0.00</h5>
                                </div>

                                <!-- Promo Code Section -->
                                <div style="margin-bottom: 1.5rem;">
                                    <div style="display: flex; gap: 0.5rem;">
                                        <input type="text" class="form-control" placeholder="Enter promo code" id="promoCode"
                                            style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 0.75rem 1rem; font-size: 0.9rem; transition: all 0.3s;">
                                        <button type="button" id="applyCoupon"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s; white-space: nowrap; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                            Apply
                                        </button>
                                    </div>
                                    <div id="coupon-message" style="margin-top: 0.5rem; font-size: 0.85rem;"></div>
                                </div>

                                <button type="button" id="checkoutBtn"
                                    style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border: none; border-radius: 12px; font-weight: 600; font-size: 1.05rem; margin-bottom: 1rem; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4); cursor: pointer;">
                                    <i class="bi bi-lock-fill" style="margin-right: 0.5rem; font-size: 1.1rem;"></i> Proceed to Checkout
                                </button>

                                <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 10px;">
                                    <small style="color: #7f8c8d; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                        <i class="bi bi-shield-fill-check" style="color: #2ecc71; font-size: 1.2rem;"></i>
                                        <span style="font-weight: 500;">SSL Secured Checkout</span>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border-radius: 16px; overflow: hidden; margin-top: 1.5rem;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h6 style="margin-bottom: 1.25rem; color: #2c3e50; font-weight: 600; font-size: 0.95rem;">
                                    <i class="bi bi-award-fill" style="color: #667eea; margin-right: 0.5rem;"></i>Why Shop With Us
                                </h6>
                                <div style="display: flex; align-items: start; margin-bottom: 1rem; padding: 0.75rem; background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%); border-radius: 10px; border-left: 3px solid #e74c3c;">
                                    <i class="bi bi-truck-front-fill" style="color: #e74c3c; font-size: 1.5rem; margin-right: 1rem; flex-shrink: 0;"></i>
                                    <div>
                                        <strong style="color: #2c3e50; font-size: 0.9rem; display: block; margin-bottom: 0.25rem;">Free Shipping</strong>
                                        <small style="color: #7f8c8d; font-size: 0.85rem;">On orders above ₹500</small>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: start; margin-bottom: 1rem; padding: 0.75rem; background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%); border-radius: 10px; border-left: 3px solid #3498db;">
                                    <i class="bi bi-arrow-repeat" style="color: #3498db; font-size: 1.5rem; margin-right: 1rem; flex-shrink: 0;"></i>
                                    <div>
                                        <strong style="color: #2c3e50; font-size: 0.9rem; display: block; margin-bottom: 0.25rem;">Easy Returns</strong>
                                        <small style="color: #7f8c8d; font-size: 0.85rem;">7-day hassle-free returns</small>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: start; padding: 0.75rem; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-radius: 10px; border-left: 3px solid #2ecc71;">
                                    <i class="bi bi-shield-fill-check" style="color: #2ecc71; font-size: 1.5rem; margin-right: 1rem; flex-shrink: 0;"></i>
                                    <div>
                                        <strong style="color: #2c3e50; font-size: 0.9rem; display: block; margin-bottom: 0.25rem;">Secure Payment</strong>
                                        <small style="color: #7f8c8d; font-size: 0.85rem;">100% secure transactions</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border-radius: 16px; overflow: hidden;">
                        <div class="card-body text-center" style="padding: 4rem 2rem;">
                            <div style="width: 120px; height: 120px; margin: 0 auto 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);">
                                <i class="bi bi-cart-x" style="font-size: 3.5rem; color: white;"></i>
                            </div>
                            <h4 style="margin-bottom: 1rem; color: #2c3e50; font-weight: 700; font-size: 1.75rem;">Your Cart is Empty</h4>
                            <p style="color: #7f8c8d; margin-bottom: 2rem; font-size: 1rem; line-height: 1.6;">Looks like you haven't added any items to your cart yet. Start exploring our products!</p>
                            <a href="{{ route('products.index') }}" 
                                style="display: inline-flex; align-items: center; padding: 1rem 2.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 1.05rem; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);">
                                <i class="bi bi-shop" style="margin-right: 0.5rem; font-size: 1.2rem;"></i> Start Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Shipping Address Modal -->
    <div id="shippingModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 9999; backdrop-filter: blur(4px); overflow-y: auto;">
        <div style="min-height: 100%; display: flex; align-items: center; justify-content: center; padding: 2rem 1rem;">
            <div style="background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); max-width: 700px; width: 100%; animation: modalSlideIn 0.3s ease; max-height: 90vh; display: flex; flex-direction: column;">
                <!-- Modal Header -->
                <div style="padding: 2rem 2rem 1rem; border-bottom: 2px solid #f0f0f0;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4 style="margin: 0 0 0.5rem 0; color: #2c3e50; font-weight: 700; font-size: 1.5rem;">
                                <i class="bi bi-geo-alt-fill" style="color: #667eea; margin-right: 0.5rem;"></i>Shipping Address
                            </h4>
                            <p style="margin: 0; color: #7f8c8d; font-size: 0.9rem;">Please provide your shipping details</p>
                        </div>
                        <button id="closeShippingModal" style="background: #f8f9fa; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                            <i class="bi bi-x-lg" style="font-size: 1.2rem; color: #6c757d;"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div style="padding: 2rem; overflow-y: auto; flex: 1;">
                    <form id="shippingForm">
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    First Name <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="first_name" id="first_name" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    Last Name <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="last_name" id="last_name" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    Email <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    Phone <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="tel" name="phone" id="phone" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    Address <span style="color: #e74c3c;">*</span>
                                </label>
                                <textarea name="address" id="address" rows="3" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s; resize: vertical;"></textarea>
                            </div>

                            <!-- City -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    City <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="city" id="city" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- State -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    State <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="state" id="state" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- ZIP Code -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    ZIP Code <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="zip" id="zip" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Country -->
                            <div class="col-md-6">
                                <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: 600; font-size: 0.9rem;">
                                    Country <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" name="country" id="country" value="India" required
                                    style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 0.95rem; transition: all 0.3s;">
                            </div>

                            <!-- Save Address Checkbox -->
                            <div class="col-12">
                                <label style="display: flex; align-items: center; cursor: pointer; padding: 1rem; background: #f8f9fa; border-radius: 10px; margin-top: 0.5rem;">
                                    <input type="checkbox" name="save_address" id="save_address" checked
                                        style="width: 20px; height: 20px; cursor: pointer; margin-right: 0.75rem;">
                                    <span style="color: #2c3e50; font-weight: 500; font-size: 0.95rem;">
                                        Save this address for future orders
                                    </span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div style="padding: 1.5rem 2rem; border-top: 2px solid #f0f0f0; background: #f8f9fa;">
                    <div style="display: flex; gap: 1rem;">
                        <button type="button" id="cancelShipping" 
                            style="flex: 1; padding: 1rem; background: white; color: #6c757d; border: 2px solid #e0e0e0; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; font-size: 1rem;">
                            Cancel
                        </button>
                        <button type="button" id="confirmShipping"
                            style="flex: 2; padding: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3); font-size: 1rem;">
                            <i class="bi bi-lock-fill" style="margin-right: 0.5rem;"></i>Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Modal -->
    <div id="customModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; backdrop-filter: blur(4px);">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 16px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); max-width: 400px; width: 90%; animation: modalSlideIn 0.3s ease;">
            <div style="padding: 2rem 2rem 1rem;">
                <div style="text-align: center; margin-bottom: 1.5rem;">
                    <div id="modalIcon" style="width: 80px; height: 80px; margin: 0 auto 1rem; border-radius: 50%; display: flex; align-items: center; justify-content: center;"></div>
                    <h5 id="modalTitle" style="margin-bottom: 0.5rem; color: #2c3e50; font-weight: 700; font-size: 1.3rem;"></h5>
                    <p id="modalMessage" style="color: #7f8c8d; font-size: 0.95rem; margin: 0;"></p>
                </div>
                <div style="display: flex; gap: 0.75rem;">
                    <button id="modalCancel" style="flex: 1; padding: 0.75rem; background: #f8f9fa; color: #6c757d; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                        Cancel
                    </button>
                    <button id="modalConfirm" style="flex: 1; padding: 0.75rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @keyframes modalSlideIn {
                from {
                    opacity: 0;
                    transform: translate(-50%, -48%);
                }
                to {
                    opacity: 1;
                    transform: translate(-50%, -50%);
                }
            }

            .cart-items-container::-webkit-scrollbar-thumb {
                background: #667eea;
                border-radius: 10px;
            }

            .cart-items-container::-webkit-scrollbar-thumb:hover {
                background: #764ba2;
            }

            .cart-item:last-child {
                border-bottom: none !important;
            }

            .cart-item:hover {
                background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            }

            .cart-item.selected {
                background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 100%);
                border-left: 4px solid #667eea;
            }

            .cart-item img:hover {
                transform: scale(1.05);
            }

            .cart-item a h6:hover {
                color: #667eea !important;
            }

            .qty-decrease:hover, .qty-increase:hover {
                background: #667eea !important;
                color: white !important;
                transform: scale(1.1);
            }

            .remove-item:hover {
                background: rgba(231, 76, 60, 0.1) !important;
                color: #c0392b !important;
            }

            a[href*="shop"]:hover {
                background: #667eea !important;
                color: white !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3) !important;
            }

            #checkoutBtn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 28px rgba(102, 126, 234, 0.5) !important;
            }

            #applyCoupon:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4) !important;
            }

            input#promoCode:focus {
                outline: none;
                border-color: #667eea !important;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
            }

            #modalCancel:hover {
                background: #e9ecef !important;
            }

            #modalConfirm:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4) !important;
            }

            @media (max-width: 768px) {
                .cart-items-container {
                    max-height: none !important;
                }
            }

            @media (max-width: 576px) {
                .card-body {
                    padding: 1.5rem !important;
                }
                
                .cart-item {
                    padding: 1.5rem !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            let selectedItems = [];
            let appliedCoupon = null;

            // Calculate totals
            function calculateTotals() {
                let subtotal = 0;

                selectedItems.forEach(itemId => {
                    const item = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    if (item) {
                        const originalPrice = parseFloat(item.dataset.originalPrice);
                        const discount = parseFloat(item.dataset.discount);
                        const quantity = parseInt(item.querySelector('.qty-input').value);
                        
                        // Calculate final price after discount
                        const finalPrice = originalPrice - (originalPrice * discount / 100);
                        subtotal += finalPrice * quantity;
                    }
                });

                // Calculate coupon discount
                let couponDiscount = 0;
                if (appliedCoupon && subtotal > 0) {
                    if (appliedCoupon.type === 'percentage') {
                        couponDiscount = (subtotal * appliedCoupon.value) / 100;
                    } else {
                        couponDiscount = appliedCoupon.value;
                    }
                }

                const shipping = 0;
                const tax = subtotal * 0.18;
                const total = subtotal - couponDiscount + shipping + tax;

                // Update UI
                document.getElementById('subtotal').textContent = '₹' + subtotal.toFixed(2);
                document.getElementById('tax').textContent = '₹' + tax.toFixed(2);
                document.getElementById('shipping').textContent = shipping === 0 ? 'FREE' : '₹' + shipping.toFixed(2);
                document.getElementById('total').textContent = '₹' + total.toFixed(2);

                // Show/hide coupon discount
                if (couponDiscount > 0) {
                    document.getElementById('coupon-discount-row').style.display = 'flex';
                    document.getElementById('coupon-discount-amount').textContent = '-₹' + couponDiscount.toFixed(2);
                } else {
                    document.getElementById('coupon-discount-row').style.display = 'none';
                }
            }

            // Select All functionality
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.item-checkbox');
                    selectedItems = [];
                    
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                        const item = document.querySelector(`.cart-item[data-item-id="${checkbox.dataset.itemId}"]`);
                        
                        if (this.checked) {
                            selectedItems.push(checkbox.dataset.itemId);
                            item.classList.add('selected');
                        } else {
                            item.classList.remove('selected');
                        }
                    });

                    calculateTotals();
                });
            }

            // Individual item selection
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const itemId = this.dataset.itemId;
                    const item = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    
                    if (this.checked) {
                        selectedItems.push(itemId);
                        item.classList.add('selected');
                    } else {
                        selectedItems = selectedItems.filter(id => id !== itemId);
                        item.classList.remove('selected');
                        document.getElementById('selectAll').checked = false;
                    }

                    calculateTotals();
                });
            });

            // Quantity controls
            document.querySelectorAll('.qty-decrease').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const input = document.querySelector(`.qty-input[data-item-id="${itemId}"]`);
                    let currentQty = parseInt(input.value);
                    
                    if (currentQty > 1) {
                        updateQuantity(itemId, currentQty - 1);
                    }
                });
            });

            document.querySelectorAll('.qty-increase').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    const max = parseInt(this.dataset.max);
                    const input = document.querySelector(`.qty-input[data-item-id="${itemId}"]`);
                    let currentQty = parseInt(input.value);
                    
                    if (currentQty < max) {
                        updateQuantity(itemId, currentQty + 1);
                    } else {
                        showModal('warning', 'Stock Limit Reached', `Maximum available quantity is ${max}`, false);
                    }
                });
            });

            // Update quantity via AJAX
            function updateQuantity(itemId, newQty) {
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
                        const input = document.querySelector(`.qty-input[data-item-id="${itemId}"]`);
                        const cartItem = input.closest('.cart-item');
                        const totalSpan = cartItem.querySelector('.item-total');
                        const originalPrice = parseFloat(cartItem.dataset.originalPrice);
                        const discount = parseFloat(cartItem.dataset.discount);
                        
                        // Calculate final price after discount
                        const finalPrice = originalPrice - (originalPrice * discount / 100);

                        input.value = newQty;
                        totalSpan.textContent = '₹' + (finalPrice * newQty).toFixed(2);

                        calculateTotals();
                        showModal('success', 'Updated!', 'Cart quantity updated successfully', false);
                    } else {
                        showModal('error', 'Error', data.message || 'Failed to update quantity', false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showModal('error', 'Error', 'Failed to update cart', false);
                });
            }

            // Remove item
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.itemId;
                    showModal('warning', 'Remove Item?', 'Are you sure you want to remove this item from cart?', true, () => {
                        removeItem(itemId);
                    });
                });
            });

            function removeItem(itemId) {
                fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        showModal('error', 'Error', data.message || 'Failed to remove item', false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showModal('error', 'Error', 'Failed to remove item', false);
                });
            }

            // Apply coupon
            const applyCouponBtn = document.getElementById('applyCoupon');
            if (applyCouponBtn) {
                applyCouponBtn.addEventListener('click', function() {
                    const code = document.getElementById('promoCode').value.trim();
                    
                    if (!code) {
                        showCouponMessage('Please enter a promo code', 'error');
                        return;
                    }

                    if (selectedItems.length === 0) {
                        showCouponMessage('Please select items to apply coupon', 'error');
                        return;
                    }

                    fetch('/cart/apply-coupon', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ code: code })
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            appliedCoupon = data.coupon;
                            calculateTotals();
                            showCouponMessage(data.message, 'success');
                            showModal('success', 'Coupon Applied!', data.message, false);
                        } else {
                            showCouponMessage(data.message, 'error');
                            showModal('error', 'Invalid Coupon', data.message, false);
                        }
                    })
                    .catch(error => {
                        console.error('Full error:', error);
                        showCouponMessage('Failed to apply coupon. Please try again.', 'error');
                        showModal('error', 'Error', 'Failed to apply coupon. Please check console for details.', false);
                    });
                });
            }

            function showCouponMessage(message, type) {
                const messageEl = document.getElementById('coupon-message');
                messageEl.textContent = message;
                messageEl.style.color = type === 'success' ? '#2ecc71' : '#e74c3c';
                
                setTimeout(() => {
                    messageEl.textContent = '';
                }, 5000);
            }

            // Checkout
            // const checkoutBtn = document.getElementById('checkoutBtn');
            // if (checkoutBtn) {
            //     checkoutBtn.addEventListener('click', function() {
            //         if (selectedItems.length === 0) {
            //             showModal('warning', 'No Items Selected', 'Please select at least one item to proceed to checkout', false);
            //             return;
            //         }

            //         // Store selected items in session and redirect
            //         fetch('/cart/prepare-checkout', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //             },
            //             body: JSON.stringify({ 
            //                 items: selectedItems,
            //                 coupon: appliedCoupon ? appliedCoupon.code : null
            //             })
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 window.location.href = '{{ route("checkout") }}';
            //             } else {
            //                 showModal('error', 'Error', data.message || 'Failed to proceed', false);
            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //             showModal('error', 'Error', 'Failed to proceed to checkout', false);
            //         });
            //     });
            // }

            // Checkout - Direct proceed without any validation
const checkoutBtn = document.getElementById('checkoutBtn');
if (checkoutBtn) {
    checkoutBtn.addEventListener('click', function() {
        // Directly prepare checkout and redirect without any checks
        fetch('/cart/prepare-checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ 
                items: selectedItems,
                coupon: appliedCoupon ? appliedCoupon.code : null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("checkout") }}';
            } else {
                showModal('error', 'Error', data.message || 'Failed to proceed', false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showModal('error', 'Error', 'Failed to proceed to checkout', false);
        });
    });
}
            // Custom Modal
            function showModal(type, title, message, showConfirm, onConfirm = null) {
                const modal = document.getElementById('customModal');
                const icon = document.getElementById('modalIcon');
                const titleEl = document.getElementById('modalTitle');
                const messageEl = document.getElementById('modalMessage');
                const confirmBtn = document.getElementById('modalConfirm');
                const cancelBtn = document.getElementById('modalCancel');

                // Set icon and colors based on type
                let iconHtml = '';
                let bgColor = '';
                
                if (type === 'success') {
                    iconHtml = '<i class="bi bi-check-circle-fill" style="font-size: 3rem; color: white;"></i>';
                    bgColor = 'linear-gradient(135deg, #2ecc71 0%, #27ae60 100%)';
                } else if (type === 'error') {
                    iconHtml = '<i class="bi bi-x-circle-fill" style="font-size: 3rem; color: white;"></i>';
                    bgColor = 'linear-gradient(135deg, #e74c3c 0%, #c0392b 100%)';
                } else if (type === 'warning') {
                    iconHtml = '<i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem; color: white;"></i>';
                    bgColor = 'linear-gradient(135deg, #f39c12 0%, #e67e22 100%)';
                }

                icon.innerHTML = iconHtml;
                icon.style.background = bgColor;
                icon.style.boxShadow = '0 8px 24px rgba(102, 126, 234, 0.3)';
                titleEl.textContent = title;
                messageEl.textContent = message;

                // Show/hide confirm button
                if (showConfirm) {
                    confirmBtn.style.display = 'block';
                    cancelBtn.textContent = 'Cancel';
                } else {
                    confirmBtn.style.display = 'none';
                    cancelBtn.textContent = 'Close';
                }

                modal.style.display = 'block';

                // Handle confirm
                confirmBtn.onclick = function() {
                    modal.style.display = 'none';
                    if (onConfirm) onConfirm();
                };

                // Handle cancel
                cancelBtn.onclick = function() {
                    modal.style.display = 'none';
                };

                // Close on outside click
                modal.onclick = function(e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                };
            }

            // Initialize - Select all items by default
            document.addEventListener('DOMContentLoaded', function() {
                // Select all checkboxes by default
                const checkboxes = document.querySelectorAll('.item-checkbox');
                selectedItems = [];
                
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    const itemId = checkbox.dataset.itemId;
                    selectedItems.push(itemId);
                    const item = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
                    item.classList.add('selected');
                });

                // Check the "Select All" checkbox
                document.getElementById('selectAll').checked = true;

                // Calculate initial totals
                calculateTotals();
            });
        </script>
    @endpush

@endsection