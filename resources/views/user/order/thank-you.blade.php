{{-- 
================================================================================
    FILE: resources/views/user/thankyou.blade.php
    
    Order Success Page - Receives $order object directly
================================================================================
--}}

@extends('user.layout.app')

@section('content')
<style>
    :root {
        --success-primary: #667eea;
        --success-secondary: #764ba2;
        --success-green: #2ecc71;
        --success-green-dark: #27ae60;
        --success-text: #2c3e50;
        --success-muted: #7f8c8d;
    }

    .success-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .success-card {
        background: white;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border-radius: 24px;
        overflow: hidden;
    }

    .success-card-body {
        padding: 3rem 2rem;
        text-align: center;
    }

    /* Success Icon Animation */
    .success-icon-wrapper {
        width: 140px;
        height: 140px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, var(--success-green) 0%, var(--success-green-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(46, 204, 113, 0.4);
        animation: successPop 0.6s ease;
    }

    .success-icon-wrapper i {
        font-size: 4rem;
        color: white;
    }

    /* Success Message */
    .success-title {
        color: var(--success-text);
        font-weight: 700;
        font-size: 2.25rem;
        margin-bottom: 1rem;
        animation: fadeInUp 0.6s ease 0.2s both;
    }

    .success-subtitle {
        color: var(--success-muted);
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease 0.3s both;
    }

    /* Order Details Card */
    .order-details-card {
        padding: 1.75rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
        border-radius: 16px;
        margin-bottom: 2rem;
        text-align: left;
        animation: fadeInUp 0.6s ease 0.4s both;
    }

    .order-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        padding-bottom: 1.25rem;
        border-bottom: 2px dashed rgba(0, 0, 0, 0.1);
        flex-wrap: wrap;
        gap: 1rem;
    }

    .order-number-section p {
        color: var(--success-muted);
        font-size: 0.85rem;
        margin-bottom: 0.35rem;
    }

    .order-number-section h5 {
        color: var(--success-text);
        font-weight: 700;
        font-size: 1.1rem;
        font-family: 'Courier New', monospace;
        margin: 0;
    }

    .order-status-badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .order-status-badge.paid {
        background: var(--success-green);
        color: white;
    }

    .order-status-badge.pending {
        background: #f39c12;
        color: white;
    }

    .order-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .order-meta-item p:first-child {
        color: var(--success-muted);
        font-size: 0.85rem;
        margin-bottom: 0.35rem;
    }

    .order-meta-item p:last-child {
        color: var(--success-text);
        font-weight: 600;
        margin: 0;
    }

    /* Invoice Download Section */
    .invoice-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 1.75rem;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease 0.45s both;
    }

    .invoice-section-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .invoice-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .invoice-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .invoice-icon i {
        font-size: 1.75rem;
        color: white;
    }

    .invoice-text h4 {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .invoice-text p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin: 0;
    }

    .invoice-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.75rem;
        background: white;
        color: var(--success-primary);
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .invoice-download-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        color: var(--success-secondary);
    }

    .invoice-download-btn i {
        font-size: 1.1rem;
    }

    /* Order Items Summary */
    .order-items-section {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
        animation: fadeInUp 0.6s ease 0.5s both;
    }

    .order-items-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--success-text);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .order-items-title i {
        color: var(--success-primary);
    }

    .order-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        background: #f8f9fa;
        flex-shrink: 0;
    }

    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .order-item-details {
        flex: 1;
    }

    .order-item-name {
        font-weight: 600;
        color: var(--success-text);
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }

    .order-item-meta {
        font-size: 0.85rem;
        color: var(--success-muted);
    }

    .order-item-price {
        font-weight: 700;
        color: var(--success-text);
        text-align: right;
    }

    /* Order Totals */
    .order-totals {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #e5e7eb;
    }

    .order-total-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.95rem;
    }

    .order-total-row.grand-total {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--success-primary);
        border-top: 2px solid var(--success-primary);
        margin-top: 0.5rem;
        padding-top: 0.75rem;
    }

    /* What's Next Section */
    .whats-next-section {
        background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        border-radius: 16px;
        padding: 1.75rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--success-primary);
        text-align: left;
        animation: fadeInUp 0.6s ease 0.55s both;
    }

    .whats-next-title {
        color: var(--success-text);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .whats-next-title i {
        color: var(--success-primary);
    }

    .timeline-steps {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .timeline-step {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .step-number {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--success-primary) 0%, var(--success-secondary) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .step-content h5 {
        color: var(--success-text);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }

    .step-content p {
        color: var(--success-muted);
        font-size: 0.85rem;
        margin: 0;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
        animation: fadeInUp 0.6s ease 0.6s both;
    }

    .btn-primary-gradient {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--success-primary) 0%, var(--success-secondary) 100%);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        color: white;
    }

    .btn-outline-gradient {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: white;
        color: var(--success-primary);
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        border: 2px solid var(--success-primary);
        transition: all 0.3s ease;
    }

    .btn-outline-gradient:hover {
        background: var(--success-primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Support Section */
    .support-section {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px solid #f0f0f0;
        animation: fadeInUp 0.6s ease 0.7s both;
    }

    .support-section p {
        color: var(--success-muted);
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .support-link {
        color: var(--success-primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }

    .support-link:hover {
        color: var(--success-secondary);
    }

    /* Trust Badges */
    .trust-badges {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 2rem;
        animation: fadeInUp 0.6s ease 0.8s both;
    }

    .trust-badge {
        text-align: center;
        padding: 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
    }

    .trust-badge:hover {
        transform: translateY(-5px);
    }

    .trust-badge i {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
    }

    .trust-badge:nth-child(1) i { color: #e74c3c; }
    .trust-badge:nth-child(2) i { color: #3498db; }
    .trust-badge:nth-child(3) i { color: #2ecc71; }

    .trust-badge h6 {
        color: var(--success-text);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.35rem;
    }

    .trust-badge p {
        color: var(--success-muted);
        font-size: 0.85rem;
        margin: 0;
    }

    /* Animations */
    @keyframes successPop {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
            opacity: 1;
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

    /* Responsive */
    @media (max-width: 768px) {
        .success-card-body {
            padding: 2rem 1.5rem;
        }

        .success-title {
            font-size: 1.75rem;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .invoice-section-inner {
            flex-direction: column;
            text-align: center;
        }

        .invoice-info {
            flex-direction: column;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons a {
            width: 100%;
            justify-content: center;
        }

        .trust-badges {
            grid-template-columns: 1fr;
        }

        .order-meta-grid {
            grid-template-columns: 1fr;
        }

        .order-item {
            flex-wrap: wrap;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-card-body">
            <!-- Success Icon -->
            <div class="success-icon-wrapper">
                <i class="bi bi-check-lg"></i>
            </div>

            <!-- Success Message -->
            <h2 class="success-title">Order Placed Successfully!</h2>
            <p class="success-subtitle">
                Thank you for your purchase! Your order has been confirmed and will be delivered soon.
            </p>

            <!-- Order Details Card -->
            <div class="order-details-card">
                <div class="order-header">
                    <div class="order-number-section">
                        <p>Order Number</p>
                        <h5>#{{ $order->order_number }}</h5>
                        @if($order->invoice_no)
                            <p style="margin-top: 0.5rem;">Invoice: <strong>{{ $order->invoice_no }}</strong></p>
                        @endif
                    </div>
                    <div class="order-status-badge {{ $order->payment_status === 'paid' ? 'paid' : 'pending' }}">
                        @if($order->payment_status === 'paid')
                            <i class="bi bi-check-circle-fill"></i> PAID
                        @else
                            <i class="bi bi-clock-fill"></i> {{ strtoupper($order->payment_status) }}
                        @endif
                    </div>
                </div>

                <div class="order-meta-grid">
                    <div class="order-meta-item">
                        <p><i class="bi bi-calendar3"></i> Order Date</p>
                        <p>{{ $order->created_at->format('F j, Y') }}</p>
                    </div>
                    <div class="order-meta-item">
                        <p><i class="bi bi-clock"></i> Order Time</p>
                        <p>{{ $order->created_at->format('h:i A') }}</p>
                    </div>
                    <div class="order-meta-item">
                        <p><i class="bi bi-credit-card"></i> Payment Method</p>
                        <p>{{ $order->payment_method }}</p>
                    </div>
                    <div class="order-meta-item">
                        <p><i class="bi bi-truck"></i> Estimated Delivery</p>
                        <p>3-5 Business Days</p>
                    </div>
                </div>
            </div>

            <!-- Invoice Download Section -->
            <div class="invoice-section">
                <div class="invoice-section-inner">
                    <div class="invoice-info">
                        <div class="invoice-icon">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div class="invoice-text">
                            <h4>Download Invoice</h4>
                            <p>Get your tax invoice as PDF</p>
                        </div>
                    </div>
                    {{-- ✅ USING SPECIFIC ORDER ID --}}
                    <a href="{{ route('invoice.download', $order->id) }}" class="invoice-download-btn">
                        <i class="bi bi-download"></i> Download PDF
                    </a>
                </div>
            </div>

            <!-- Order Items Summary -->
            <div class="order-items-section">
                <h5 class="order-items-title">
                    <i class="bi bi-bag-check"></i> Order Summary
                </h5>

                @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="order-item-image">
                            <img src="{{ $item->product_image ? asset($item->product_image) : asset('img/product-default.png') }}" 
                                 alt="{{ $item->product_name }}">
                        </div>
                        <div class="order-item-details">
                            <div class="order-item-name">{{ $item->product_name }}</div>
                            <div class="order-item-meta">
                                Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 2) }}
                                @if($item->discount > 0)
                                    <span style="color: #2ecc71;">({{ $item->discount }}% off)</span>
                                @endif
                            </div>
                        </div>
                        <div class="order-item-price">
                            ₹{{ number_format($item->final_price, 2) }}
                        </div>
                    </div>
                @endforeach

                <!-- Order Totals -->
                <div class="order-totals">
                    <div class="order-total-row">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="order-total-row" style="color: #2ecc71;">
                            <span>Discount</span>
                            <span>- ₹{{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    @if($order->coupon_discount > 0)
                        <div class="order-total-row" style="color: #2ecc71;">
                            <span>Coupon ({{ $order->coupon_code }})</span>
                            <span>- ₹{{ number_format($order->coupon_discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="order-total-row">
                        <span>Tax (GST 18%)</span>
                        <span>₹{{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="order-total-row">
                        <span>Shipping</span>
                        <span>{{ $order->shipping_amount > 0 ? '₹' . number_format($order->shipping_amount, 2) : 'FREE' }}</span>
                    </div>
                    <div class="order-total-row grand-total">
                        <span>Total Amount</span>
                        <span>₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- What's Next Section -->
            <div class="whats-next-section">
                <h5 class="whats-next-title">
                    <i class="bi bi-info-circle-fill"></i> What Happens Next?
                </h5>
                <div class="timeline-steps">
                    <div class="timeline-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h5>Order Confirmation Email</h5>
                            <p>You'll receive a confirmation email at {{ $order->shipping_email }} shortly.</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h5>Order Processing</h5>
                            <p>We'll prepare your order and get it ready for shipment.</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h5>Shipping & Tracking</h5>
                            <p>Track your order with the tracking number sent to your email.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('user.orders.index') }}" class="btn-primary-gradient">
                    <i class="bi bi-box-seam"></i> View My Orders
                </a>
                <a href="{{ route('shop') }}" class="btn-outline-gradient">
                    <i class="bi bi-shop"></i> Continue Shopping
                </a>
            </div>

            <!-- Support Section -->
            <div class="support-section">
                <p>Need help with your order?</p>
                <a href="{{ route('contact') }}" class="support-link">
                    <i class="bi bi-headset"></i> Contact Support
                </a>
            </div>
        </div>
    </div>

    <!-- Trust Badges -->
    <div class="trust-badges">
        <div class="trust-badge">
            <i class="bi bi-truck"></i>
            <h6>Fast Delivery</h6>
            <p>Quick & reliable shipping</p>
        </div>
        <div class="trust-badge">
            <i class="bi bi-arrow-repeat"></i>
            <h6>Easy Returns</h6>
            <p>7-day return policy</p>
        </div>
        <div class="trust-badge">
            <i class="bi bi-shield-check"></i>
            <h6>Secure Payment</h6>
            <p>100% secure checkout</p>
        </div>
    </div>
</div>
@endsection