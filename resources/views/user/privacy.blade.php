@extends('user.layout.app')

@section('content')
<div class="container py-5">
    <div class="bg-white shadow-lg rounded p-5">
        <h2 class="text-primary mb-4">Privacy Policy</h2>
        <p class="text-muted">Last Updated: {{ now()->format('F d, Y') }}</p>
        <hr>

        <h4 class="mt-4">1. Information We Collect</h4>
        <ul>
            <li>Name, email, phone, address during sign-up or order</li>
            <li>Payment information during checkout (processed securely via Razorpay)</li>
            <li>Device, IP, and browsing data for analytics</li>
            <li>Service request details for technician assignment</li>
        </ul>

        <h4 class="mt-4">2. How We Use Your Information</h4>
        <ul>
            <li>To process orders and payments</li>
            <li>To schedule installation and services</li>
            <li>To send service reminders and updates</li>
            <li>To improve website performance and customer experience</li>
        </ul>

        <h4 class="mt-4">3. Data Security</h4>
        <p>
            We implement industry-standard encryption and secure storage practices.  
            Payment data is never stored on our servers.
        </p>

        <h4 class="mt-4">4. Sharing of Information</h4>
        <ul>
            <li>Authorized technicians for service visits</li>
            <li>Payment gateways like Razorpay (PCI-DSS certified)</li>
            <li>Logistics partners for delivery</li>
        </ul>

        <h4 class="mt-4">5. Cookies & Tracking</h4>
        <p>We use cookies to enhance user experience, remember preferences, and analyze traffic.</p>

        <h4 class="mt-4">6. Your Rights</h4>
        <ul>
            <li>Access and update your personal data</li>
            <li>Request account deletion</li>
            <li>Opt-out from promotional emails</li>
        </ul>

        <h4 class="mt-4">7. Policy Updates</h4>
        <p>This policy may be updated periodically. Updates will be posted on this page.</p>

        <h4 class="mt-4">8. Contact Us</h4>
        <p>
            Email: privacy@pureaquatech.com<br>
            Phone: +91 XXXXX XXXXX
        </p>
    </div>
</div>
@endsection
