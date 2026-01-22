@extends('user.layout.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    <div class="card" style="border: none; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1); border-radius: 20px; overflow: hidden;">
        <div class="card-body text-center" style="padding: 4rem 2rem;">
            <!-- Success Icon with Animation -->
            <div style="width: 140px; height: 140px; margin: 0 auto 2rem; background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(46, 204, 113, 0.4); animation: successPop 0.6s ease;">
                <i class="bi bi-check-lg" style="font-size: 5rem; color: white; font-weight: bold;"></i>
            </div>

            <!-- Success Message -->
            <h2 style="margin-bottom: 1rem; color: #2c3e50; font-weight: 700; font-size: 2.25rem; animation: fadeInUp 0.6s ease 0.2s both;">
                Order Placed Successfully!
            </h2>
            
            <p style="color: #7f8c8d; margin-bottom: 2.5rem; font-size: 1.1rem; line-height: 1.6; animation: fadeInUp 0.6s ease 0.3s both;">
                Thank you for your purchase! Your order has been confirmed and will be delivered soon.
            </p>

            <!-- Order Details Card -->
            <div style="padding: 2rem; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 16px; margin-bottom: 2.5rem; text-align: left; animation: fadeInUp 0.6s ease 0.4s both;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 2px dashed rgba(255, 255, 255, 0.5);">
                    <div>
                        <p style="color: #7f8c8d; font-size: 0.9rem; margin-bottom: 0.5rem;">Order Number</p>
                        <h5 style="color: #2c3e50; font-weight: 700; font-size: 1.1rem; margin: 0; font-family: 'Courier New', monospace;">
                            #{{ session('order_number', 'ORD-' . date('YmdHis')) }}
                        </h5>
                    </div>
                    <div style="background: #2ecc71; color: white; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem;">
                        <i class="bi bi-check-circle-fill" style="margin-right: 0.25rem;"></i> PAID
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div>
                        <p style="color: #7f8c8d; font-size: 0.85rem; margin-bottom: 0.5rem;">
                            <i class="bi bi-calendar3" style="margin-right: 0.25rem;"></i> Order Date
                        </p>
                        <p style="color: #2c3e50; font-weight: 600; margin: 0;">{{ date('F j, Y') }}</p>
                    </div>
                    <div>
                        <p style="color: #7f8c8d; font-size: 0.85rem; margin-bottom: 0.5rem;">
                            <i class="bi bi-clock" style="margin-right: 0.25rem;"></i> Order Time
                        </p>
                        <p style="color: #2c3e50; font-weight: 600; margin: 0;">{{ date('h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- What's Next Section -->
            <div style="background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%); border-radius: 16px; padding: 2rem; margin-bottom: 2.5rem; border-left: 4px solid #667eea; text-align: left; animation: fadeInUp 0.6s ease 0.5s both;">
                <h5 style="color: #2c3e50; font-weight: 700; margin-bottom: 1.25rem; font-size: 1.1rem;">
                    <i class="bi bi-info-circle-fill" style="color: #667eea; margin-right: 0.5rem;"></i>What Happens Next?
                </h5>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: white; font-weight: 700; font-size: 0.85rem;">
                            1
                        </div>
                        <div style="flex: 1;">
                            <p style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem; font-size: 0.95rem;">Order Confirmation Email</p>
                            <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">You'll receive a confirmation email with your order details shortly.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: white; font-weight: 700; font-size: 0.85rem;">
                            2
                        </div>
                        <div style="flex: 1;">
                            <p style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem; font-size: 0.95rem;">Order Processing</p>
                            <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">We'll prepare your order and get it ready for shipment.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 1rem;">
                        <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: white; font-weight: 700; font-size: 0.85rem;">
                            3
                        </div>
                        <div style="flex: 1;">
                            <p style="color: #2c3e50; font-weight: 600; margin-bottom: 0.25rem; font-size: 0.95rem;">Shipping Updates</p>
                            <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">Track your order with the tracking number sent to your email.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; animation: fadeInUp 0.6s ease 0.6s both;">
                <a href="{{ route('user.orders.index') }}" 
                    style="display: inline-flex; align-items: center; padding: 1rem 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);">
                    <i class="bi bi-box-seam" style="margin-right: 0.5rem; font-size: 1.1rem;"></i> View My Orders
                </a>
                <a href="{{ route('shop') }}" 
                    style="display: inline-flex; align-items: center; padding: 1rem 2rem; background: white; color: #667eea; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 1rem; border: 2px solid #667eea; transition: all 0.3s ease;">
                    <i class="bi bi-shop" style="margin-right: 0.5rem; font-size: 1.1rem;"></i> Continue Shopping
                </a>
            </div>

            <!-- Support Section -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #f0f0f0; animation: fadeInUp 0.6s ease 0.7s both;">
                <p style="color: #7f8c8d; font-size: 0.9rem; margin-bottom: 1rem;">
                    Need help with your order?
                </p>
                <a href="{{ route('contact') }}" style="color: #667eea; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-headset" style="font-size: 1.2rem;"></i> Contact Support
                </a>
            </div>
        </div>
    </div>

    <!-- Trust Badges -->
    <div class="row g-3" style="margin-top: 2rem; animation: fadeInUp 0.6s ease 0.8s both;">
        <div class="col-md-4">
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
                <i class="bi bi-truck-front-fill" style="font-size: 2.5rem; color: #e74c3c; margin-bottom: 0.75rem;"></i>
                <h6 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Fast Delivery</h6>
                <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">Quick & reliable shipping</p>
            </div>
        </div>
        <div class="col-md-4">
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
                <i class="bi bi-arrow-repeat" style="font-size: 2.5rem; color: #3498db; margin-bottom: 0.75rem;"></i>
                <h6 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Easy Returns</h6>
                <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">7-day return policy</p>
            </div>
        </div>
        <div class="col-md-4">
            <div style="text-align: center; padding: 1.5rem; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
                <i class="bi bi-shield-fill-check" style="font-size: 2.5rem; color: #2ecc71; margin-bottom: 0.75rem;"></i>
                <h6 style="color: #2c3e50; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">Secure Payment</h6>
                <p style="color: #7f8c8d; font-size: 0.85rem; margin: 0;">100% secure checkout</p>
            </div>
        </div>
    </div>
</div>

<style>
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

    a[href*="orders"]:hover,
    a[href*="shop"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
    }

    a[href*="shop"]:hover {
        background: #667eea !important;
        color: white !important;
    }

    a[href*="contact"]:hover {
        color: #764ba2 !important;
    }
</style>

<script>
    // Confetti effect (optional - requires canvas-confetti library)
    document.addEventListener('DOMContentLoaded', function() {
        // Clear any stored session data
        {{ session()->forget(['order_number', 'pending_order_id', 'razorpay_order', 'order_total']) }}
    });
</script>
@endsection