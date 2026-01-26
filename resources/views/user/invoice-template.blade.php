{{-- 
================================================================================
    PROFESSIONAL INVOICE SYSTEM FOR LARAVEL
================================================================================
    
    INSTALLATION STEPS:
    
    1. Install DomPDF:
       composer require barryvdh/laravel-dompdf
    
    2. Publish config (optional):
       php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
    
    3. Save files to their respective locations as indicated below
    
================================================================================
--}}


{{-- ============================================================================
    FILE 1: resources/views/invoices/invoice.blade.php
    Invoice PDF Template
============================================================================ --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        @page {
            margin: 0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', sans-serif;
        }

        body {
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            background: #fff;
            padding: 25px;
        }

        /* Header Styles */
        .invoice-header {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 20px;
        }

        .header-table {
            width: 100%;
        }

        .company-info {
            width: 50%;
            vertical-align: top;
        }

        .invoice-info {
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .company-name {
            font-size: 22px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 3px;
        }

        .company-tagline {
            font-size: 10px;
            color: #666;
            margin-bottom: 8px;
        }

        .company-details {
            font-size: 10px;
            color: #555;
            line-height: 1.5;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .invoice-meta {
            font-size: 11px;
            color: #333;
            line-height: 1.6;
        }

        .invoice-number {
            color: #1e40af;
            font-weight: bold;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 8px;
        }

        .status-paid {
            background: #d1fae5;
            color: #059669;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-failed {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Billing & Shipping */
        .address-section {
            width: 100%;
            margin-bottom: 25px;
        }

        .address-table {
            width: 100%;
        }

        .address-box {
            width: 48%;
            vertical-align: top;
        }

        .address-box-spacer {
            width: 4%;
        }

        .box-title {
            font-size: 10px;
            font-weight: bold;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }

        .box-content {
            background: #f8fafc;
            padding: 12px;
            border-radius: 6px;
            font-size: 11px;
            line-height: 1.6;
        }

        .customer-name {
            font-size: 13px;
            font-weight: bold;
            color: #111;
            margin-bottom: 4px;
        }

        /* Items Table */
        .items-section {
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table thead tr {
            background: #1e40af;
        }

        .items-table thead th {
            padding: 12px 10px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .items-table thead th.text-center {
            text-align: center;
        }

        .items-table thead th.text-right {
            text-align: right;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table tbody tr.even {
            background: #f9fafb;
        }

        .items-table tbody td {
            padding: 12px 10px;
            font-size: 11px;
            vertical-align: top;
        }

        .items-table tbody td.text-center {
            text-align: center;
        }

        .items-table tbody td.text-right {
            text-align: right;
        }

        .item-name {
            font-weight: 600;
            color: #111;
            margin-bottom: 2px;
        }

        .item-sku {
            font-size: 9px;
            color: #888;
        }

        .item-meta {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
        }

        /* Totals Section */
        .totals-section {
            width: 100%;
            margin-bottom: 20px;
        }

        .totals-table {
            width: 100%;
        }

        .payment-cell {
            width: 50%;
            vertical-align: top;
            padding-right: 15px;
        }

        .totals-cell {
            width: 50%;
            vertical-align: top;
        }

        .payment-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 12px;
        }

        .payment-title {
            font-size: 10px;
            font-weight: bold;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .payment-row {
            margin-bottom: 4px;
        }

        .payment-label {
            font-size: 10px;
            color: #555;
            display: inline-block;
            width: 45%;
        }

        .payment-value {
            font-size: 10px;
            color: #333;
            font-weight: 500;
            display: inline-block;
            width: 50%;
            text-align: right;
        }

        .totals-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 12px;
        }

        .totals-row {
            margin-bottom: 8px;
        }

        .totals-label {
            font-size: 11px;
            color: #555;
            display: inline-block;
            width: 60%;
        }

        .totals-value {
            font-size: 11px;
            color: #333;
            font-weight: 500;
            display: inline-block;
            width: 35%;
            text-align: right;
        }

        .discount-value {
            color: #059669;
        }

        .grand-total {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #1e40af;
        }

        .grand-total .totals-label {
            font-size: 13px;
            font-weight: bold;
            color: #1e40af;
        }

        .grand-total .totals-value {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
        }

        .savings-badge {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            border-radius: 6px;
            padding: 10px 12px;
            margin-top: 10px;
            text-align: center;
        }

        .savings-text {
            font-size: 11px;
            font-weight: 600;
            color: #059669;
        }

        /* Terms Section */
        .terms-section {
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
            margin-bottom: 20px;
        }

        .terms-title {
            font-size: 10px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .terms-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .terms-list li {
            font-size: 9px;
            color: #666;
            margin-bottom: 4px;
            padding-left: 12px;
            position: relative;
        }

        .terms-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #1e40af;
        }

        /* Footer */
        .invoice-footer {
            text-align: center;
            padding-top: 15px;
            border-top: 3px solid #1e40af;
        }

        .footer-thank-you {
            font-size: 14px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 8px;
        }

        .footer-contact {
            font-size: 10px;
            color: #666;
            margin-bottom: 10px;
        }

        .footer-legal {
            font-size: 8px;
            color: #999;
            line-height: 1.5;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 40%;
            left: 25%;
            font-size: 80px;
            font-weight: bold;
            color: rgba(34, 197, 94, 0.08);
            transform: rotate(-30deg);
            z-index: -1;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    @if($order->payment_status === 'paid')
        <div class="watermark">PAID</div>
    @endif

    <!-- Header -->
    <div class="invoice-header">
        <table class="header-table">
            <tr>
                <td class="company-info">
                    <div class="company-name">Pure Aqua Tech</div>
                    <div class="company-tagline">Premium Water Purification Solutions</div>
                    <div class="company-details">
                        123 Water Street, Clean City<br>
                        Kerala, India - 682001<br>
                        Phone: +91 999 596 9939<br>
                        Email: info@pureaquatech.com<br>
                        GST: 33XXXXX1234X1ZX
                    </div>
                </td>
                <td class="invoice-info">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-meta">
                        @if($order->invoice_no)
                            Invoice No: <span class="invoice-number">#{{ $order->invoice_no }}</span><br>
                        @endif
                        Order No: <span class="invoice-number">#{{ $order->order_number }}</span><br>
                        Date: {{ $order->created_at->format('F j, Y') }}<br>
                        Time: {{ $order->created_at->format('h:i A') }}
                    </div>
                    @if($order->payment_status === 'paid')
                        <span class="status-badge status-paid">✓ Paid</span>
                    @elseif($order->payment_status === 'pending')
                        <span class="status-badge status-pending">⏳ Pending</span>
                    @else
                        <span class="status-badge status-failed">✗ Failed</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Billing & Shipping -->
    <div class="address-section">
        <table class="address-table">
            <tr>
                <td class="address-box">
                    <div class="box-title">Bill To</div>
                    <div class="box-content">
                        <div class="customer-name">{{ $order->user->first_name ?? '' }} {{ $order->user->last_name ?? '' }}</div>
                        {{ $order->user->email ?? 'N/A' }}<br>
                        {{ $order->user->phone ?? 'N/A' }}
                    </div>
                </td>
                <td class="address-box-spacer"></td>
                <td class="address-box">
                    <div class="box-title">Ship To</div>
                    <div class="box-content">
                        <div class="customer-name">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</div>
                        {{ $order->shipping_address }}<br>
                        {{ $order->shipping_city }}{{ $order->shipping_state ? ', ' . $order->shipping_state : '' }}<br>
                        {{ $order->shipping_zip }}, {{ $order->shipping_country }}<br>
                        Phone: {{ $order->shipping_phone ?? 'N/A' }}<br>
                        Email: {{ $order->shipping_email ?? 'N/A' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Items Table -->
    <div class="items-section">
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 40%;">Product Details</th>
                    <th class="text-center" style="width: 12%;">Price</th>
                    <th class="text-center" style="width: 10%;">Qty</th>
                    <th class="text-center" style="width: 13%;">Discount</th>
                    <th class="text-right" style="width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr class="{{ $index % 2 == 1 ? 'even' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="item-name">{{ $item->product_name }}</div>
                            <div class="item-sku">SKU: {{ $item->product_sku ?? 'N/A' }}</div>
                        </td>
                        <td class="text-center">₹{{ number_format($item->price, 2) }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-center">
                            @if($item->discount > 0)
                                <span style="color: #059669;">{{ $item->discount }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">₹{{ number_format($item->final_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Totals Section -->
    <div class="totals-section">
        <table class="totals-table">
            <tr>
                <td class="payment-cell">
                    <div class="payment-box">
                        <div class="payment-title">Payment Information</div>
                        <div class="payment-row">
                            <span class="payment-label">Payment Method</span>
                            <span class="payment-value">{{ ucfirst($order->payment_method ?? 'Online') }}</span>
                        </div>
                        @if($order->razorpay_payment_id)
                            <div class="payment-row">
                                <span class="payment-label">Transaction ID</span>
                                <span class="payment-value">{{ $order->razorpay_payment_id }}</span>
                            </div>
                        @endif
                        <div class="payment-row">
                            <span class="payment-label">Payment Status</span>
                            <span class="payment-value" style="color: {{ $order->payment_status === 'paid' ? '#059669' : '#d97706' }};">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <div class="payment-row">
                            <span class="payment-label">Order Status</span>
                            <span class="payment-value">{{ ucfirst($order->order_status) }}</span>
                        </div>
                    </div>
                </td>
                <td class="totals-cell">
                    <div class="totals-box">
                        <div class="totals-row">
                            <span class="totals-label">Subtotal</span>
                            <span class="totals-value">₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="totals-row">
                                <span class="totals-label">Discount</span>
                                <span class="totals-value discount-value">- ₹{{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        @if($order->coupon_discount > 0)
                            <div class="totals-row">
                                <span class="totals-label">Coupon ({{ $order->coupon_code }})</span>
                                <span class="totals-value discount-value">- ₹{{ number_format($order->coupon_discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="totals-row">
                            <span class="totals-label">Shipping</span>
                            <span class="totals-value">
                                @if($order->shipping_amount > 0)
                                    ₹{{ number_format($order->shipping_amount, 2) }}
                                @else
                                    <span style="color: #059669;">FREE</span>
                                @endif
                            </span>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="totals-row">
                                <span class="totals-label">Tax (GST 18%)</span>
                                <span class="totals-value">₹{{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="totals-row grand-total">
                            <span class="totals-label">Grand Total</span>
                            <span class="totals-value">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    @if($order->discount_amount + $order->coupon_discount > 0)
                        <div class="savings-badge">
                            <span class="savings-text">🎉 You saved ₹{{ number_format($order->discount_amount + $order->coupon_discount, 2) }} on this order!</span>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Terms & Conditions -->
    <div class="terms-section">
        <div class="terms-title">Terms & Conditions</div>
        <ul class="terms-list">
            <li>This invoice is computer-generated and does not require a physical signature.</li>
            <li>Products come with manufacturer warranty as specified on the product page.</li>
            <li>Returns are accepted within 7 days of delivery with original packaging.</li>
            <li>For any queries, please contact our customer support at +91 999 596 9939.</li>
            <li>All disputes are subject to the jurisdiction of courts in Kerala, India.</li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="invoice-footer">
        <div class="footer-thank-you">Thank You for Your Purchase!</div>
        <div class="footer-contact">
            Questions? Contact us at info@pureaquatech.com or call +91 999 596 9939
        </div>
        <div class="footer-legal">
            This is an electronically generated invoice. © {{ date('Y') }} Pure Aqua Tech. All rights reserved.<br>
            CIN: U12345KL2020PTC012345 | PAN: XXXXX1234X
        </div>
    </div>
</body>
</html>