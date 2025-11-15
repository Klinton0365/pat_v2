@extends('user.layout.app')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow-lg rounded p-5">
        <h2 class="text-primary mb-4">Terms & Conditions</h2>
        <p class="text-muted">Last Updated: {{ now()->format('F d, Y') }}</p>

        <hr>

        <h4 class="mt-4 text-dark">1. Introduction</h4>
        <p>
            Welcome to <strong>Pure Aqua Tech</strong>. By accessing our website, purchasing products, or availing
            services, you agree to comply with and be bound by these Terms & Conditions. Please read them carefully.
        </p>

        <h4 class="mt-4 text-dark">2. Products & Services</h4>
        <p>
            Pure Aqua Tech specializes in RO water purifiers, water treatment solutions, filters, spare parts,
            installation, and maintenance services. Product specifications, pricing, and availability may vary and are 
            subject to change without prior notice.
        </p>

        <h4 class="mt-4 text-dark">3. Order & Payment</h4>
        <ul>
            <li>All orders placed on our website are subject to acceptance and availability.</li>
            <li>Payments made online via Razorpay or other gateways must be authorized and valid.</li>
            <li>Cash on Delivery (COD) is available only in select locations.</li>
            <li>Once an order is placed, cancellation may only be approved based on our service policy.</li>
        </ul>

        <h4 class="mt-4 text-dark">4. Delivery & Installation</h4>
        <ul>
            <li>Delivery timelines may vary based on location and product availability.</li>
            <li>Installation is carried out only by authorized Pure Aqua Tech technicians.</li>
            <li>Customers must ensure proper access and availability during installation visits.</li>
        </ul>

        <h4 class="mt-4 text-dark">5. Warranty Policy</h4>
        <p>
            All products come with standard manufacturer warranty. Warranty coverage excludes:
        </p>
        <ul>
            <li>Damage caused by improper handling</li>
            <li>Unauthorized service</li>
            <li>Electrical fluctuations</li>
            <li>External contamination in water source</li>
        </ul>

        <h4 class="mt-4 text-dark">6. Service & Maintenance</h4>
        <ul>
            <li>Scheduled service dates are indicative and may change based on technician availability.</li>
            <li>Customers will be notified for next service reminders via SMS/Email.</li>
            <li>Failure to service the purifier at recommended intervals may affect performance.</li>
        </ul>

        <h4 class="mt-4 text-dark">7. Refund & Replacement</h4>
        <ul>
            <li>Refunds are applicable only for defective or damaged products reported within 48 hours.</li>
            <li>Replacement eligibility depends on product condition and verification.</li>
            <li>Service charges once paid are non-refundable.</li>
        </ul>

        <h4 class="mt-4 text-dark">8. Limitation of Liability</h4>
        <p>
            Pure Aqua Tech shall not be liable for loss, damage, or injury arising from product misuse,
            customer negligence, or failure to follow instructions.
        </p>

        <h4 class="mt-4 text-dark">9. Governing Law</h4>
        <p>
            These terms shall be governed by the laws of India. Any disputes shall be resolved within local
            jurisdiction courts.
        </p>

        <h4 class="mt-4 text-dark">10. Contact Us</h4>
        <p>
            For queries, service requests, or complaints, reach out to:<br>
            <strong>Email:</strong> support@pureaquatech.com<br>
            <strong>Phone:</strong> +91 XXXXX XXXXX
        </p>

    </div>
</div>
@endsection
