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

    {{-- 
    Professional Single Product Page
    
    Psychology Principles Used:
    - Scarcity: Stock levels, "Only X left"
    - Social Proof: Views, ratings, reviews
    - Trust: Warranty, certifications, secure badges
    - Urgency: Discount timers, limited offers
    - Value: Savings calculation, price comparison
    - Authority: Quality badges, certifications
    
    Design: Consistent with other redesigned sections
--}}

    <style>
        :root {
            --sp-primary: #1e40af;
            --sp-primary-light: #3b82f6;
            --sp-primary-dark: #1e3a8a;
            --sp-accent: #4f46e5;
            --sp-success: #059669;
            --sp-success-light: #10b981;
            --sp-danger: #dc2626;
            --sp-warning: #f59e0b;
            --sp-orange: #ea580c;
            --sp-text-primary: #111827;
            --sp-text-secondary: #4b5563;
            --sp-text-muted: #9ca3af;
            --sp-border: #e5e7eb;
            --sp-bg-light: #f8fafc;
            --sp-bg-card: #ffffff;
            --sp-shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --sp-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --sp-shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --sp-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --sp-shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --sp-radius: 12px;
            --sp-radius-lg: 16px;
            --sp-radius-xl: 24px;
        }

        /* ==================== BREADCRUMB ==================== */
        .sp-breadcrumb {
            background: var(--sp-bg-light);
            padding: 16px 0;
            border-bottom: 1px solid var(--sp-border);
        }

        .sp-breadcrumb-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .sp-breadcrumb-list {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 0.9rem;
        }

        .sp-breadcrumb-list li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sp-breadcrumb-list li a {
            color: var(--sp-text-secondary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .sp-breadcrumb-list li a:hover {
            color: var(--sp-primary);
        }

        .sp-breadcrumb-list li.active {
            color: var(--sp-text-primary);
            font-weight: 500;
        }

        .sp-breadcrumb-list li i {
            font-size: 0.7rem;
            color: var(--sp-text-muted);
        }

        /* ==================== MAIN SECTION ==================== */
        .single-product-section {
            padding: 50px 0;
            background: var(--sp-bg-card);
        }

        .sp-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .sp-main-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }

        /* ==================== IMAGE GALLERY ==================== */
        .sp-gallery {
            position: sticky;
            top: 100px;
        }

        .sp-main-image {
            position: relative;
            background: var(--sp-bg-light);
            border-radius: var(--sp-radius-lg);
            overflow: hidden;
            margin-bottom: 16px;
            border: 1px solid var(--sp-border);
        }

        .sp-main-image img {
            width: 100%;
            height: 450px;
            object-fit: contain;
            transition: transform 0.3s;
            cursor: zoom-in;
        }

        .sp-main-image:hover img {
            transform: scale(1.05);
        }

        .sp-image-badges {
            position: absolute;
            top: 16px;
            left: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .sp-badge {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sp-badge-featured {
            background: linear-gradient(135deg, var(--sp-primary) 0%, var(--sp-accent) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .sp-badge-sale {
            background: var(--sp-danger);
            color: white;
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .sp-badge-new {
            background: var(--sp-success);
            color: white;
        }

        .sp-image-actions {
            position: absolute;
            top: 16px;
            right: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .sp-image-action-btn {
            width: 44px;
            height: 44px;
            background: var(--sp-bg-card);
            border: 1px solid var(--sp-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--sp-text-secondary);
            text-decoration: none;
        }

        .sp-image-action-btn:hover {
            background: var(--sp-primary);
            border-color: var(--sp-primary);
            color: white;
            transform: scale(1.1);
        }

        .sp-image-action-btn.wishlist:hover {
            background: var(--sp-danger);
            border-color: var(--sp-danger);
        }

        /* Thumbnails */
        .sp-thumbnails {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding-bottom: 8px;
        }

        .sp-thumbnail {
            flex: 0 0 80px;
            height: 80px;
            border-radius: var(--sp-radius);
            overflow: hidden;
            cursor: pointer;
            border: 2px solid var(--sp-border);
            transition: all 0.2s;
            background: var(--sp-bg-light);
        }

        .sp-thumbnail:hover,
        .sp-thumbnail.active {
            border-color: var(--sp-primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
        }

        .sp-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ==================== PRODUCT INFO ==================== */
        .sp-info {
            padding: 10px 0;
        }

        /* Category & SKU */
        .sp-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .sp-category {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border: 1px solid #bfdbfe;
            color: var(--sp-primary);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sp-category:hover {
            background: var(--sp-primary);
            color: white;
            border-color: var(--sp-primary);
        }

        .sp-sku {
            font-size: 0.85rem;
            color: var(--sp-text-muted);
        }

        /* Product Title */
        .sp-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--sp-text-primary);
            margin-bottom: 16px;
            line-height: 1.3;
        }

        /* Rating & Views */
        .sp-rating-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--sp-border);
        }

        .sp-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sp-stars {
            display: flex;
            gap: 2px;
        }

        .sp-stars i {
            font-size: 1rem;
            color: #fbbf24;
        }

        .sp-stars i.empty {
            color: #e5e7eb;
        }

        .sp-rating-text {
            font-size: 0.9rem;
            color: var(--sp-text-secondary);
        }

        .sp-rating-text strong {
            color: var(--sp-text-primary);
        }

        .sp-views {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            color: var(--sp-text-muted);
        }

        .sp-views i {
            color: var(--sp-primary);
        }

        /* Price Section */
        .sp-price-section {
            background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%);
            border: 1px solid #fde68a;
            border-radius: var(--sp-radius-lg);
            padding: 24px;
            margin-bottom: 24px;
        }

        .sp-price-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .sp-price-current {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--sp-text-primary);
        }

        .sp-price-original {
            font-size: 1.25rem;
            color: var(--sp-text-muted);
            text-decoration: line-through;
        }

        .sp-price-discount {
            padding: 6px 12px;
            background: var(--sp-danger);
            color: white;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .sp-savings {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            color: var(--sp-success);
            font-weight: 600;
        }

        .sp-savings i {
            font-size: 1rem;
        }

        /* Stock Status */
        .sp-stock-section {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .sp-stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .sp-stock-badge.in-stock {
            background: #d1fae5;
            color: var(--sp-success);
            border: 1px solid #a7f3d0;
        }

        .sp-stock-badge.low-stock {
            background: #fef3c7;
            color: var(--sp-orange);
            border: 1px solid #fde68a;
        }

        .sp-stock-badge.out-of-stock {
            background: #fee2e2;
            color: var(--sp-danger);
            border: 1px solid #fecaca;
        }

        .sp-stock-badge i {
            font-size: 0.9rem;
        }

        .sp-urgency {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            color: var(--sp-danger);
            font-weight: 600;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        /* Description */
        .sp-description {
            margin-bottom: 24px;
        }

        .sp-description-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--sp-text-primary);
            margin-bottom: 10px;
        }

        .sp-description-text {
            font-size: 0.95rem;
            color: var(--sp-text-secondary);
            line-height: 1.7;
        }

        /* Color Options */
        .sp-colors {
            margin-bottom: 24px;
        }

        .sp-colors-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--sp-text-primary);
            margin-bottom: 12px;
        }

        .sp-color-options {
            display: flex;
            gap: 12px;
        }

        .sp-color-option {
            position: relative;
        }

        .sp-color-option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .sp-color-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--sp-bg-card);
            border: 2px solid var(--sp-border);
            border-radius: var(--sp-radius);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sp-color-option input:checked+.sp-color-label {
            border-color: var(--sp-primary);
            background: #eff6ff;
            color: var(--sp-primary);
        }

        .sp-color-swatch {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--sp-border);
        }

        /* Quantity & Add to Cart */
        .sp-actions {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
        }

        .sp-quantity {
            display: flex;
            align-items: center;
            border: 2px solid var(--sp-border);
            border-radius: var(--sp-radius);
            overflow: hidden;
        }

        .sp-quantity-btn {
            width: 48px;
            height: 48px;
            background: var(--sp-bg-light);
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            color: var(--sp-text-secondary);
            transition: all 0.2s;
        }

        .sp-quantity-btn:hover {
            background: var(--sp-primary);
            color: white;
        }

        .sp-quantity-input {
            width: 60px;
            height: 48px;
            border: none;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--sp-text-primary);
        }

        .sp-quantity-input:focus {
            outline: none;
        }

        .sp-add-to-cart {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--sp-primary) 0%, var(--sp-accent) 100%);
            color: white;
            border: none;
            border-radius: var(--sp-radius);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
            text-decoration: none;
        }

        .sp-add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            color: white;
        }

        .sp-add-to-cart.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .sp-add-to-cart.success {
            background: linear-gradient(135deg, var(--sp-success) 0%, var(--sp-success-light) 100%);
        }

        .sp-buy-now {
            padding: 16px 32px;
            background: var(--sp-bg-card);
            color: var(--sp-text-primary);
            border: 2px solid var(--sp-border);
            border-radius: var(--sp-radius);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sp-buy-now:hover {
            border-color: var(--sp-primary);
            color: var(--sp-primary);
            background: #eff6ff;
        }

        /* Trust Badges */
        .sp-trust-badges {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
            padding: 20px;
            background: var(--sp-bg-light);
            border-radius: var(--sp-radius-lg);
            border: 1px solid var(--sp-border);
        }

        .sp-trust-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
        }

        .sp-trust-badge-icon {
            width: 48px;
            height: 48px;
            background: var(--sp-bg-card);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: var(--sp-shadow);
        }

        .sp-trust-badge:nth-child(1) .sp-trust-badge-icon {
            color: var(--sp-success);
        }

        .sp-trust-badge:nth-child(2) .sp-trust-badge-icon {
            color: var(--sp-primary);
        }

        .sp-trust-badge:nth-child(3) .sp-trust-badge-icon {
            color: var(--sp-warning);
        }

        .sp-trust-badge-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--sp-text-secondary);
        }

        /* Warranty Badge */
        .sp-warranty {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #a7f3d0;
            border-radius: var(--sp-radius-lg);
            margin-bottom: 24px;
        }

        .sp-warranty-icon {
            width: 56px;
            height: 56px;
            background: var(--sp-success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .sp-warranty-info h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--sp-success);
            margin-bottom: 4px;
        }

        .sp-warranty-info p {
            font-size: 0.9rem;
            color: var(--sp-text-secondary);
            margin: 0;
        }

        /* ==================== SPECIFICATIONS ==================== */
        .sp-specs-section {
            padding: 60px 0;
            background: var(--sp-bg-light);
        }

        .sp-specs-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .sp-specs-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .sp-specs-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--sp-primary);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .sp-specs-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--sp-text-primary);
        }

        .sp-specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .sp-spec-card {
            background: var(--sp-bg-card);
            border-radius: var(--sp-radius-lg);
            padding: 24px;
            border: 1px solid var(--sp-border);
            transition: all 0.3s;
        }

        .sp-spec-card:hover {
            box-shadow: var(--sp-shadow-lg);
            transform: translateY(-4px);
        }

        .sp-spec-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--sp-border);
        }

        .sp-spec-card-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: var(--sp-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sp-primary);
            font-size: 1.1rem;
        }

        .sp-spec-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--sp-text-primary);
        }

        .sp-spec-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sp-spec-list li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed var(--sp-border);
            font-size: 0.9rem;
        }

        .sp-spec-list li:last-child {
            border-bottom: none;
        }

        .sp-spec-list li span:first-child {
            color: var(--sp-text-muted);
        }

        .sp-spec-list li span:last-child {
            font-weight: 600;
            color: var(--sp-text-primary);
        }

        /* ==================== RELATED PRODUCTS ==================== */
        .sp-related-section {
            padding: 60px 0;
            background: var(--sp-bg-card);
        }

        .sp-related-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .sp-related-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }

        .sp-related-title-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sp-related-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--sp-primary) 0%, var(--sp-accent) 100%);
            border-radius: var(--sp-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .sp-related-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--sp-text-primary);
            margin: 0;
        }

        .sp-related-nav {
            display: flex;
            gap: 8px;
        }

        .sp-related-nav-btn {
            width: 44px;
            height: 44px;
            background: var(--sp-bg-card);
            border: 1px solid var(--sp-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--sp-text-secondary);
        }

        .sp-related-nav-btn:hover {
            background: var(--sp-primary);
            border-color: var(--sp-primary);
            color: white;
        }

        .sp-related-carousel {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            padding: 10px 0;
        }

        .sp-related-carousel::-webkit-scrollbar {
            display: none;
        }

        .sp-related-card {
            flex: 0 0 280px;
            background: var(--sp-bg-card);
            border-radius: var(--sp-radius-lg);
            overflow: hidden;
            border: 1px solid var(--sp-border);
            transition: all 0.3s;
        }

        .sp-related-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--sp-shadow-xl);
            border-color: transparent;
        }

        .sp-related-card-image {
            position: relative;
            aspect-ratio: 1;
            background: var(--sp-bg-light);
            overflow: hidden;
        }

        .sp-related-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .sp-related-card:hover .sp-related-card-image img {
            transform: scale(1.08);
        }

        .sp-related-card-info {
            padding: 20px;
        }

        .sp-related-card-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--sp-text-primary);
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.2s;
        }

        .sp-related-card-name:hover {
            color: var(--sp-primary);
        }

        .sp-related-card-price {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sp-related-card-price .current {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--sp-text-primary);
        }

        .sp-related-card-price .original {
            font-size: 0.9rem;
            color: var(--sp-text-muted);
            text-decoration: line-through;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 1200px) {
            .sp-main-grid {
                gap: 40px;
            }
        }

        @media (max-width: 992px) {
            .sp-main-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .sp-gallery {
                position: static;
            }

            .sp-main-image img {
                height: 400px;
            }

            .sp-specs-grid {
                grid-template-columns: 1fr;
            }

            .sp-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .single-product-section {
                padding: 30px 0;
            }

            .sp-main-image img {
                height: 350px;
            }

            .sp-title {
                font-size: 1.5rem;
            }

            .sp-price-current {
                font-size: 2rem;
            }

            .sp-trust-badges {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .sp-trust-badge {
                flex-direction: row;
                justify-content: flex-start;
                text-align: left;
            }

            .sp-actions {
                flex-direction: column;
            }

            .sp-quantity {
                justify-content: center;
            }

            .sp-related-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .sp-related-card {
                flex: 0 0 240px;
            }
        }

        @media (max-width: 576px) {
            .sp-meta-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .sp-rating-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .sp-price-row {
                flex-wrap: wrap;
            }

            .sp-stock-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .sp-color-options {
                flex-wrap: wrap;
            }

            .sp-warranty {
                flex-direction: column;
                text-align: center;
            }

            .sp-related-card {
                flex: 0 0 200px;
            }
        }
    </style>

    {{-- Buy Now --}}
    <style>
        /* Buy Now Product Summary */
        .buy-now-product-summary {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .buy-now-product-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .buy-now-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .buy-now-product-info {
            flex: 1;
        }

        .buy-now-product-info h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .buy-now-product-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .buy-now-price .price-current {
            font-size: 1.25rem;
            font-weight: 700;
            color: #059669;
        }

        .buy-now-price .price-original {
            font-size: 0.9rem;
            color: #9ca3af;
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        /* Buy Now Order Summary */
        .buy-now-order-summary {
            background: #f0fdf4;
            border-radius: 12px;
            padding: 1rem;
        }

        .buy-now-order-summary .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 0.9rem;
            color: #4b5563;
        }

        .buy-now-order-summary .summary-row.discount {
            color: #059669;
        }

        .buy-now-order-summary .summary-row.total {
            border-top: 2px solid #059669;
            margin-top: 0.5rem;
            padding-top: 0.75rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #059669;
        }

        /* Modal Styles (reuse from cart page) */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .modal-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100%;
            padding: 1rem;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-header h3 i {
            color: #f59e0b;
        }

        .modal-header p {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .modal-close {
            background: #f3f4f6;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .modal-close:hover {
            background: #e5e7eb;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .btn-cancel {
            flex: 1;
            padding: 0.875rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #f3f4f6;
        }

        .btn-submit {
            flex: 2;
            padding: 0.875rem;
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.4);
        }

        /* Form Styles */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-label .required {
            color: #ef4444;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .payment-options {
            display: flex;
            gap: 1rem;
        }

        .payment-option {
            flex: 1;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .payment-option:hover {
            border-color: #059669;
        }

        .payment-option.selected {
            border-color: #059669;
            background: #f0fdf4;
        }

        .payment-option input {
            display: none;
        }

        .payment-option span {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        /* Coupon Section Styles */
        .buy-now-coupon-section {
            margin-top: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            border: 2px dashed #e5e7eb;
        }

        .coupon-input-group {
            display: flex;
            gap: 0.5rem;
        }

        .coupon-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .coupon-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .coupon-input::placeholder {
            text-transform: none;
        }

        .coupon-apply-btn {
            padding: 0.75rem 1.25rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .coupon-apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .coupon-apply-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .coupon-message {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            min-height: 1.25rem;
        }

        .coupon-message.success {
            color: #059669;
        }

        .coupon-message.error {
            color: #dc2626;
        }

        /* Coupon Row in Summary */
        .summary-row.coupon-row {
            color: #059669;
            background: #f0fdf4;
            margin: 0.5rem -1rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .summary-row.coupon-row span:first-child {
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .remove-coupon-btn {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            padding: 0;
            margin-left: 0.5rem;
            font-size: 1rem;
            line-height: 1;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .remove-coupon-btn:hover {
            opacity: 1;
        }

        /* Success Animation for Coupon */
        @keyframes couponSuccess {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .coupon-applied {
            animation: couponSuccess 0.3s ease;
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .payment-options {
                flex-direction: column;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-submit {
                flex: none;
                width: 100%;
            }
        }
    </style>

    <!-- ==================== BREADCRUMB ==================== -->
    <nav class="sp-breadcrumb">
        <div class="sp-breadcrumb-container">
            <ul class="sp-breadcrumb-list">
                <li><a href="{{ route('home') }}"><i class="bi bi-house-fill"></i> Home</a></li>
                <li><i class="bi bi-chevron-right"></i></li>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><i class="bi bi-chevron-right"></i></li>
                <li><a href="{{ route('shop', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
                </li>
                <li><i class="bi bi-chevron-right"></i></li>
                <li class="active">{{ Str::limit($product->name, 40) }}</li>
            </ul>
        </div>
    </nav>

    <!-- ==================== MAIN PRODUCT SECTION ==================== -->
    <section class="single-product-section">
        <div class="sp-container">
            <div class="sp-main-grid">
                <!-- Image Gallery -->
                <div class="sp-gallery">
                    <div class="sp-main-image" id="mainImageContainer">
                        <!-- Badges -->
                        <div class="sp-image-badges">
                            @if ($product->featured)
                                <span class="sp-badge sp-badge-featured">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            @endif
                            @if ($product->discount > 0)
                                <span class="sp-badge sp-badge-sale">
                                    {{ $product->discount }}% OFF
                                </span>
                            @endif
                            @if ($product->created_at->diffInDays(now()) < 30)
                                <span class="sp-badge sp-badge-new">New</span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="sp-image-actions">
                            <button class="sp-image-action-btn wishlist" id="wishlistBtn"
                                data-product-id="{{ $product->id }}">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="sp-image-action-btn" id="shareBtn">
                                <i class="bi bi-share"></i>
                            </button>
                        </div>

                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}" id="mainImage">
                    </div>

                    <!-- Thumbnails -->
                    @php
                        $galleryImages = is_array($product->product_images)
                            ? $product->product_images
                            : json_decode($product->product_images, true) ?? [];
                    @endphp

                    <div class="sp-thumbnails">
                        <div class="sp-thumbnail active"
                            onclick="changeMainImage(this, '{{ asset($product->main_image) }}')">
                            <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                        </div>

                        @if (count($galleryImages) > 0)
                            @foreach ($galleryImages as $img)
                                <div class="sp-thumbnail" onclick="changeMainImage(this, '{{ asset($img) }}')">
                                    <img src="{{ asset($img) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

                <!-- Product Info -->
                <div class="sp-info">
                    <!-- Category & SKU -->
                    <div class="sp-meta-row">
                        <a href="{{ route('shop', ['category' => $product->category_id]) }}" class="sp-category">
                            <i class="bi bi-tag-fill"></i> {{ $product->category->name }}
                        </a>
                        <span class="sp-sku">SKU: {{ $product->sku ?? 'N/A' }}</span>
                    </div>

                    <!-- Product Title -->
                    <h1 class="sp-title">{{ $product->name }}</h1>

                    <!-- Rating & Views -->
                    <div class="sp-rating-row">
                        <div class="sp-rating">
                            <div class="sp-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->rating))
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star-fill empty"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="sp-rating-text">
                                <strong>{{ number_format($product->rating, 1) }}</strong> ({{ rand(15, 120) }} reviews)
                            </span>
                        </div>
                        <div class="sp-views">
                            <i class="bi bi-eye"></i>
                            <span>{{ $product->views }} people viewed this</span>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="sp-price-section">
                        <div class="sp-price-row">
                            @if ($product->discount > 0)
                                @php
                                    $discountedPrice = $product->price - ($product->price * $product->discount) / 100;
                                    $savings = $product->price - $discountedPrice;
                                @endphp
                                <span class="sp-price-current">₹{{ number_format($discountedPrice, 2) }}</span>
                                <span class="sp-price-original">₹{{ number_format($product->price, 2) }}</span>
                                <span class="sp-price-discount">{{ $product->discount }}% OFF</span>
                            @else
                                <span class="sp-price-current">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        @if ($product->discount > 0)
                            <div class="sp-savings">
                                <i class="bi bi-piggy-bank-fill"></i>
                                You save ₹{{ number_format($savings, 2) }} on this order!
                            </div>
                        @endif
                    </div>

                    <!-- Stock Status -->
                    <div class="sp-stock-section">
                        @if ($product->stock > 10)
                            <span class="sp-stock-badge in-stock">
                                <i class="bi bi-check-circle-fill"></i> In Stock
                            </span>
                        @elseif ($product->stock > 0)
                            <span class="sp-stock-badge low-stock">
                                <i class="bi bi-exclamation-circle-fill"></i> Only {{ $product->stock }} left!
                            </span>
                            <span class="sp-urgency">
                                <i class="bi bi-lightning-fill"></i> Hurry, limited stock!
                            </span>
                        @else
                            <span class="sp-stock-badge out-of-stock">
                                <i class="bi bi-x-circle-fill"></i> Out of Stock
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="sp-description">
                        <h4 class="sp-description-title">Product Description</h4>
                        <p class="sp-description-text">{{ $product->description }}</p>
                    </div>

                    <!-- Color Options -->
                    @php
                        $colors = is_array($product->colors)
                            ? $product->colors
                            : json_decode($product->colors, true) ?? [];
                    @endphp

                    @if (count($colors) > 0)
                        <div class="sp-colors">
                            <h4 class="sp-colors-title">Select Color</h4>
                            <div class="sp-color-options">
                                @foreach ($colors as $index => $color)
                                    <label class="sp-color-option">
                                        <input type="radio" name="product_color" value="{{ $color }}"
                                            {{ $index === 0 ? 'checked' : '' }}>
                                        <span class="sp-color-label">
                                            <span class="sp-color-swatch"
                                                style="background: {{ strtolower($color) }};"></span>
                                            {{ ucfirst($color) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <!-- Quantity & Add to Cart -->
                    <div class="sp-actions">
                        <div class="sp-quantity">
                            <button type="button" class="sp-quantity-btn" onclick="changeQuantity(-1)">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" class="sp-quantity-input" id="quantityInput" value="1"
                                min="1" max="{{ $product->stock }}">
                            <button type="button" class="sp-quantity-btn" onclick="changeQuantity(1)">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <button class="sp-add-to-cart" id="addToCartBtn" data-product-id="{{ $product->id }}"
                            data-url="{{ route('cart.add', $product->id) }}"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>

                    <!-- Buy Now Button -->
                    {{-- <a href="{{ route('cart') }}" class="sp-buy-now" style="width: 100%; margin-bottom: 24px;">
                        <i class="bi bi-lightning-fill"></i>
                        Buy Now
                    </a> --}}

                    <!-- Buy Now Button (Updated) -->
                    <button type="button" class="sp-buy-now" id="buyNowBtn"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-lightning-fill"></i>
                        Buy Now
                    </button>


                    <!-- Buy Now Modal  -->
                    <div class="modal-overlay" id="buyNowModal">
                        <div class="modal-container">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h3><i class="bi bi-lightning-fill"></i> Quick Checkout</h3>
                                        <p>Complete your purchase</p>
                                    </div>
                                    <button class="modal-close" id="closeBuyNowModal">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>

                                <form id="buyNowForm" method="POST" action="{{ route('buy.now.process') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" id="buyNowQuantity" value="1">
                                    <input type="hidden" name="color" id="buyNowColor" value="">
                                    <input type="hidden" name="coupon_code" id="buyNowCouponCode" value="">

                                    <div class="modal-body">
                                        <!-- Product Summary -->
                                        <div class="buy-now-product-summary">
                                            <div class="buy-now-product-image">
                                                <img src="{{ asset($product->main_image) }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="buy-now-product-info">
                                                <h4>{{ $product->name }}</h4>
                                                <div class="buy-now-product-meta">
                                                    <span class="buy-now-qty">Qty: <strong
                                                            id="summaryQty">1</strong></span>
                                                    <span class="buy-now-color" id="summaryColor" style="display: none;">
                                                        Color: <strong id="summaryColorValue"></strong>
                                                    </span>
                                                </div>
                                                <div class="buy-now-price">
                                                    @if ($product->discount > 0)
                                                        @php
                                                            $discountedPrice =
                                                                $product->price -
                                                                ($product->price * $product->discount) / 100;
                                                        @endphp
                                                        <span
                                                            class="price-current">₹{{ number_format($discountedPrice, 2) }}</span>
                                                        <span
                                                            class="price-original">₹{{ number_format($product->price, 2) }}</span>
                                                    @else
                                                        <span
                                                            class="price-current">₹{{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order Summary -->
                                        <div class="buy-now-order-summary">
                                            <div class="summary-row">
                                                <span>Subtotal</span>
                                                <span id="buyNowSubtotal">₹0.00</span>
                                            </div>
                                            @if ($product->discount > 0)
                                                <div class="summary-row discount">
                                                    <span><i class="bi bi-tag-fill"></i> Product Discount
                                                        ({{ $product->discount }}%)</span>
                                                    <span id="buyNowDiscount">-₹0.00</span>
                                                </div>
                                            @endif

                                            <!-- Coupon Discount Row (Hidden by default) -->
                                            <div class="summary-row coupon-row" id="buyNowCouponRow"
                                                style="display: none;">
                                                <span>
                                                    <i class="bi bi-ticket-perforated-fill"></i>
                                                    Coupon (<span id="appliedCouponCode"></span>)
                                                    <button type="button" class="remove-coupon-btn" id="removeCouponBtn"
                                                        title="Remove coupon">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </span>
                                                <span id="buyNowCouponDiscount">-₹0.00</span>
                                            </div>

                                            <div class="summary-row">
                                                <span>Tax (GST 18%)</span>
                                                <span id="buyNowTax">₹0.00</span>
                                            </div>
                                            <div class="summary-row">
                                                <span>Shipping</span>
                                                <span class="text-success">FREE</span>
                                            </div>
                                            <div class="summary-row total">
                                                <span>Total</span>
                                                <span id="buyNowTotal">₹0.00</span>
                                            </div>
                                        </div>

                                        <!-- Coupon Input Section -->
                                        <div class="buy-now-coupon-section">
                                            <div class="coupon-input-group">
                                                <input type="text" class="coupon-input" id="buyNowPromoCode"
                                                    placeholder="Enter promo code">
                                                <button type="button" class="coupon-apply-btn" id="applyBuyNowCoupon">
                                                    <i class="bi bi-check2"></i> Apply
                                                </button>
                                            </div>
                                            <div class="coupon-message" id="buyNowCouponMessage"></div>
                                        </div>

                                        <hr style="margin: 1.5rem 0; border-color: #e5e7eb;">

                                        <!-- Shipping Details -->
                                        @php $user = Auth::user(); @endphp

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">First Name <span
                                                        class="required">*</span></label>
                                                <input type="text" class="form-input" name="first_name" required
                                                    value="{{ old('first_name', $user->first_name ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Last Name <span
                                                        class="required">*</span></label>
                                                <input type="text" class="form-input" name="last_name" required
                                                    value="{{ old('last_name', $user->last_name ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="required">*</span></label>
                                                <input type="email" class="form-input" name="email" required
                                                    value="{{ old('email', $user->email ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Phone <span class="required">*</span></label>
                                                <input type="tel" class="form-input" name="phone" required
                                                    value="{{ old('phone', $user->phone ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Address <span class="required">*</span></label>
                                            <textarea class="form-textarea" name="address" rows="2" required>{{ old('address', $user->address ?? '') }}</textarea>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">City <span class="required">*</span></label>
                                                <input type="text" class="form-input" name="city" required
                                                    value="{{ old('city', $user->city ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">State <span class="required">*</span></label>
                                                <input type="text" class="form-input" name="state" required
                                                    value="{{ old('state', $user->state ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">ZIP Code <span class="required">*</span></label>
                                                <input type="text" class="form-input" name="zip" required
                                                    value="{{ old('zip', $user->zip ?? '') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Country <span class="required">*</span></label>
                                                <input type="text" class="form-input" name="country" required
                                                    value="{{ old('country', $user->country ?? 'India') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Payment Method <span
                                                    class="required">*</span></label>
                                            <div class="payment-options">
                                                <label class="payment-option">
                                                    <input type="radio" name="payment_method" value="COD" required>
                                                    <span><i class="bi bi-cash-coin"></i> Cash on Delivery</span>
                                                </label>
                                                <label class="payment-option">
                                                    <input type="radio" name="payment_method" value="Online" required>
                                                    <span><i class="bi bi-credit-card"></i> Online Payment</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn-cancel" id="cancelBuyNow">Cancel</button>
                                        <button type="submit" class="btn-submit">
                                            <i class="bi bi-lock-fill"></i> Place Order
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="sp-trust-badges">
                        <div class="sp-trust-badge">
                            <div class="sp-trust-badge-icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <span class="sp-trust-badge-text">Free Delivery</span>
                        </div>
                        <div class="sp-trust-badge">
                            <div class="sp-trust-badge-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <span class="sp-trust-badge-text">Secure Payment</span>
                        </div>
                        <div class="sp-trust-badge">
                            <div class="sp-trust-badge-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <span class="sp-trust-badge-text">Easy Returns</span>
                        </div>
                    </div>

                    <!-- Warranty Badge -->
                    @if ($product->warranty_months)
                        <div class="sp-warranty">
                            <div class="sp-warranty-icon">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div class="sp-warranty-info">
                                <h4>{{ $product->warranty_months }} Months Warranty</h4>
                                <p>This product comes with {{ $product->warranty_months }} months manufacturer warranty</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SPECIFICATIONS SECTION ==================== -->
    <section class="sp-specs-section">
        <div class="sp-specs-container">
            <div class="sp-specs-header">
                <span class="sp-specs-badge">
                    <i class="bi bi-list-check"></i> Details
                </span>
                <h2 class="sp-specs-title">Product Specifications</h2>
            </div>

            <div class="sp-specs-grid">
                <!-- General Info -->
                <div class="sp-spec-card">
                    <div class="sp-spec-card-header">
                        <div class="sp-spec-card-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h4 class="sp-spec-card-title">General Information</h4>
                    </div>
                    <ul class="sp-spec-list">
                        <li>
                            <span>Product Name</span>
                            <span>{{ $product->name }}</span>
                        </li>
                        <li>
                            <span>Category</span>
                            <span>{{ $product->category->name }}</span>
                        </li>
                        <li>
                            <span>SKU</span>
                            <span>{{ $product->sku ?? 'N/A' }}</span>
                        </li>
                        <li>
                            <span>Rating</span>
                            <span>{{ number_format($product->rating, 1) }} / 5.0</span>
                        </li>
                    </ul>
                </div>

                <!-- Pricing Info -->
                <div class="sp-spec-card">
                    <div class="sp-spec-card-header">
                        <div class="sp-spec-card-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                        <h4 class="sp-spec-card-title">Pricing Details</h4>
                    </div>
                    <ul class="sp-spec-list">
                        <li>
                            <span>MRP</span>
                            <span>₹{{ number_format($product->price, 2) }}</span>
                        </li>
                        @if ($product->discount > 0)
                            <li>
                                <span>Discount</span>
                                <span style="color: var(--sp-success);">{{ $product->discount }}% OFF</span>
                            </li>
                            <li>
                                <span>Sale Price</span>
                                <span style="color: var(--sp-primary); font-weight: 700;">
                                    ₹{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                </span>
                            </li>
                        @endif
                        <li>
                            <span>Stock Status</span>
                            <span style="color: {{ $product->stock > 0 ? 'var(--sp-success)' : 'var(--sp-danger)' }};">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Warranty & Support -->
                <div class="sp-spec-card">
                    <div class="sp-spec-card-header">
                        <div class="sp-spec-card-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="sp-spec-card-title">Warranty & Support</h4>
                    </div>
                    <ul class="sp-spec-list">
                        <li>
                            <span>Warranty Period</span>
                            <span>{{ $product->warranty_months ? $product->warranty_months . ' Months' : 'No Warranty' }}</span>
                        </li>
                        <li>
                            <span>Installation</span>
                            <span>Free Installation</span>
                        </li>
                        <li>
                            <span>Support</span>
                            <span>24/7 Customer Support</span>
                        </li>
                        <li>
                            <span>Returns</span>
                            <span>7 Days Return Policy</span>
                        </li>
                    </ul>
                </div>

                <!-- Availability -->
                <div class="sp-spec-card">
                    <div class="sp-spec-card-header">
                        <div class="sp-spec-card-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h4 class="sp-spec-card-title">Availability</h4>
                    </div>
                    <ul class="sp-spec-list">
                        <li>
                            <span>Available Stock</span>
                            <span>{{ $product->stock }} Units</span>
                        </li>
                        @if ($product->colors && count($product->colors) > 0)
                            <li>
                                <span>Colors Available</span>
                                <span>{{ implode(', ', $product->colors) }}</span>
                            </li>
                        @endif
                        <li>
                            <span>Delivery</span>
                            <span>3-5 Business Days</span>
                        </li>
                        <li>
                            <span>COD Available</span>
                            <span>Yes</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== RELATED PRODUCTS ==================== -->
    @if ($relatedProducts && $relatedProducts->count() > 0)
        <section class="sp-related-section">
            <div class="sp-related-container">
                <div class="sp-related-header">
                    <div class="sp-related-title-wrapper">
                        <div class="sp-related-icon">
                            <i class="bi bi-grid-fill"></i>
                        </div>
                        <h3 class="sp-related-title">You May Also Like</h3>
                    </div>
                    <div class="sp-related-nav">
                        <button class="sp-related-nav-btn" onclick="scrollRelated(-1)">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="sp-related-nav-btn" onclick="scrollRelated(1)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <div class="sp-related-carousel" id="relatedCarousel">
                    @foreach ($relatedProducts as $related)
                        <div class="sp-related-card">
                            <div class="sp-related-card-image">
                                <img src="{{ $related->main_image ? asset('storage/' . $related->main_image) : asset('img/product-default.png') }}"
                                    alt="{{ $related->name }}">
                            </div>
                            <div class="sp-related-card-info">
                                <a href="{{ route('product.show', [$related->id, $related->slug]) }}"
                                    class="sp-related-card-name">
                                    {{ $related->name }}
                                </a>
                                <div class="sp-related-card-price">
                                    @if ($related->discount > 0)
                                        <span
                                            class="current">₹{{ number_format($related->price - ($related->price * $related->discount) / 100, 2) }}</span>
                                        <span class="original">₹{{ number_format($related->price, 2) }}</span>
                                    @else
                                        <span class="current">₹{{ number_format($related->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Change Main Image
            window.changeMainImage = function(thumbnail, imageSrc) {
                document.getElementById('mainImage').src = imageSrc;

                // Update active thumbnail
                document.querySelectorAll('.sp-thumbnail').forEach(t => t.classList.remove('active'));
                thumbnail.classList.add('active');
            };

            // Quantity Control
            window.changeQuantity = function(delta) {
                const input = document.getElementById('quantityInput');
                let value = parseInt(input.value) + delta;
                const max = parseInt(input.max) || 99;

                if (value < 1) value = 1;
                if (value > max) value = max;

                input.value = value;
            };

            // Add to Cart
            const addToCartBtn = document.getElementById('addToCartBtn');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const url = this.getAttribute('data-url');
                    const quantity = document.getElementById('quantityInput').value;
                    const originalHTML = this.innerHTML;

                    // Loading state
                    this.classList.add('loading');
                    this.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';

                    fetch(url + '?quantity=' + quantity, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw data;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.classList.remove('loading');
                                this.classList.add('success');
                                this.innerHTML = '<i class="bi bi-check-lg"></i> Added to Cart!';

                                // Update cart count
                                const cartCount = document.querySelector('.cart-count');
                                if (cartCount && data.cart_count) {
                                    cartCount.textContent = data.cart_count;
                                }

                                setTimeout(() => {
                                    this.classList.remove('success');
                                    this.innerHTML = originalHTML;
                                }, 2500);
                            }
                        })
                        .catch(error => {
                            this.classList.remove('loading');
                            this.innerHTML = originalHTML;

                            if (error.redirect) {
                                window.location.href = error.redirect;
                            } else {
                                alert(error.message || 'Something went wrong. Please try again.');
                            }
                        });
                });
            }

            // Wishlist Toggle
            const wishlistBtn = document.getElementById('wishlistBtn');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    this.classList.toggle('active');

                    if (this.classList.contains('active')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                        this.style.background = 'var(--sp-danger)';
                        this.style.borderColor = 'var(--sp-danger)';
                        this.style.color = 'white';
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                        this.style.background = '';
                        this.style.borderColor = '';
                        this.style.color = '';
                    }
                });
            }

            // Share Button
            const shareBtn = document.getElementById('shareBtn');
            if (shareBtn) {
                shareBtn.addEventListener('click', function() {
                    if (navigator.share) {
                        navigator.share({
                            title: '{{ $product->name }}',
                            url: window.location.href
                        });
                    } else {
                        // Fallback: Copy to clipboard
                        navigator.clipboard.writeText(window.location.href);
                        alert('Link copied to clipboard!');
                    }
                });
            }

            // Related Products Carousel
            window.scrollRelated = function(direction) {
                const carousel = document.getElementById('relatedCarousel');
                const scrollAmount = 300;
                carousel.scrollBy({
                    left: scrollAmount * direction,
                    behavior: 'smooth'
                });
            };
        });
    </script>

    {{-- Buy Now --}}
    <script>
        // Buy Now Modal Logic
        const buyNowBtn = document.getElementById('buyNowBtn');
        const buyNowModal = document.getElementById('buyNowModal');
        const closeBuyNowModal = document.getElementById('closeBuyNowModal');
        const cancelBuyNow = document.getElementById('cancelBuyNow');

        // Product data
        const productPrice = {{ $product->price }};
        const productDiscount = {{ $product->discount ?? 0 }};
        const discountedPrice = productDiscount > 0 ?
            productPrice - (productPrice * productDiscount / 100) :
            productPrice;

        // Coupon state
        let buyNowAppliedCoupon = null;
        let currentQuantity = 1;

        // Open modal
        if (buyNowBtn) {
            buyNowBtn.addEventListener('click', function() {
                const quantity = parseInt(document.getElementById('quantityInput').value) || 1;
                const selectedColor = document.querySelector('input[name="product_color"]:checked');

                currentQuantity = quantity;

                // Set hidden fields
                document.getElementById('buyNowQuantity').value = quantity;
                document.getElementById('summaryQty').textContent = quantity;

                if (selectedColor) {
                    document.getElementById('buyNowColor').value = selectedColor.value;
                    document.getElementById('summaryColorValue').textContent = selectedColor.value;
                    document.getElementById('summaryColor').style.display = 'inline';
                }

                // Reset coupon state when opening modal
                buyNowAppliedCoupon = null;
                document.getElementById('buyNowCouponCode').value = '';
                document.getElementById('buyNowPromoCode').value = '';
                document.getElementById('buyNowCouponRow').style.display = 'none';
                document.getElementById('buyNowCouponMessage').textContent = '';
                document.getElementById('buyNowCouponMessage').className = 'coupon-message';

                // Calculate totals
                calculateBuyNowTotals(quantity);

                // Show modal
                buyNowModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        }

        // Close modal functions
        function closeBuyNowModalFunc() {
            buyNowModal.style.display = 'none';
            document.body.style.overflow = '';
        }

        closeBuyNowModal.addEventListener('click', closeBuyNowModalFunc);
        cancelBuyNow.addEventListener('click', closeBuyNowModalFunc);

        buyNowModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeBuyNowModalFunc();
            }
        });

        // Calculate totals
        function calculateBuyNowTotals(quantity) {
            const subtotal = productPrice * quantity;
            const productDiscountAmount = (productPrice * productDiscount / 100) * quantity;
            const afterProductDiscount = subtotal - productDiscountAmount;

            // Calculate coupon discount
            let couponDiscountAmount = 0;
            if (buyNowAppliedCoupon) {
                if (buyNowAppliedCoupon.type === 'percentage') {
                    couponDiscountAmount = (afterProductDiscount * buyNowAppliedCoupon.value) / 100;
                } else {
                    couponDiscountAmount = buyNowAppliedCoupon.value;
                }
                // Ensure coupon discount doesn't exceed the amount
                couponDiscountAmount = Math.min(couponDiscountAmount, afterProductDiscount);
            }

            const afterAllDiscounts = afterProductDiscount - couponDiscountAmount;
            const tax = afterAllDiscounts * 0.18;
            const total = afterAllDiscounts + tax;

            // Update UI
            document.getElementById('buyNowSubtotal').textContent = '₹' + subtotal.toFixed(2);

            const discountEl = document.getElementById('buyNowDiscount');
            if (discountEl) {
                discountEl.textContent = '-₹' + productDiscountAmount.toFixed(2);
            }

            // Update coupon row
            if (buyNowAppliedCoupon && couponDiscountAmount > 0) {
                document.getElementById('buyNowCouponRow').style.display = 'flex';
                document.getElementById('appliedCouponCode').textContent = buyNowAppliedCoupon.code;
                document.getElementById('buyNowCouponDiscount').textContent = '-₹' + couponDiscountAmount.toFixed(2);
            } else {
                document.getElementById('buyNowCouponRow').style.display = 'none';
            }

            document.getElementById('buyNowTax').textContent = '₹' + tax.toFixed(2);
            document.getElementById('buyNowTotal').textContent = '₹' + total.toFixed(2);
        }

        // Apply Coupon
        const applyBuyNowCouponBtn = document.getElementById('applyBuyNowCoupon');
        if (applyBuyNowCouponBtn) {
            applyBuyNowCouponBtn.addEventListener('click', function() {
                const code = document.getElementById('buyNowPromoCode').value.trim();
                const messageEl = document.getElementById('buyNowCouponMessage');

                if (!code) {
                    messageEl.textContent = 'Please enter a promo code';
                    messageEl.className = 'coupon-message error';
                    return;
                }

                // Disable button while processing
                this.disabled = true;
                this.innerHTML = '<i class="bi bi-hourglass-split"></i> Applying...';

                fetch('{{ route('cart.apply-coupon') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            code: code
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Store coupon
                            buyNowAppliedCoupon = data.coupon;

                            // Update hidden field
                            document.getElementById('buyNowCouponCode').value = data.coupon.code;

                            // Show success message
                            messageEl.textContent = data.message;
                            messageEl.className = 'coupon-message success';

                            // Add success animation
                            const couponSection = document.querySelector('.buy-now-coupon-section');
                            couponSection.classList.add('coupon-applied');
                            setTimeout(() => couponSection.classList.remove('coupon-applied'), 300);

                            // Recalculate totals
                            calculateBuyNowTotals(currentQuantity);

                            // Disable input after successful application
                            document.getElementById('buyNowPromoCode').disabled = true;

                        } else {
                            messageEl.textContent = data.message;
                            messageEl.className = 'coupon-message error';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        messageEl.textContent = 'Failed to apply coupon. Please try again.';
                        messageEl.className = 'coupon-message error';
                    })
                    .finally(() => {
                        // Re-enable button
                        this.disabled = false;
                        this.innerHTML = '<i class="bi bi-check2"></i> Apply';
                    });
            });
        }

        // Remove Coupon
        const removeCouponBtn = document.getElementById('removeCouponBtn');
        if (removeCouponBtn) {
            removeCouponBtn.addEventListener('click', function() {
                // Clear coupon
                buyNowAppliedCoupon = null;
                document.getElementById('buyNowCouponCode').value = '';
                document.getElementById('buyNowPromoCode').value = '';
                document.getElementById('buyNowPromoCode').disabled = false;
                document.getElementById('buyNowCouponMessage').textContent = '';
                document.getElementById('buyNowCouponMessage').className = 'coupon-message';

                // Recalculate totals
                calculateBuyNowTotals(currentQuantity);
            });
        }

        // Allow Enter key to apply coupon
        document.getElementById('buyNowPromoCode').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('applyBuyNowCoupon').click();
            }
        });

        // Payment option visual feedback
        document.querySelectorAll('#buyNowModal .payment-option input').forEach(input => {
            input.addEventListener('change', function() {
                document.querySelectorAll('#buyNowModal .payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.closest('.payment-option').classList.add('selected');
            });
        });
    </script>


    {{-- <!-- Single Products Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-5 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="product-categories mb-4">
                        <h4>Products Categories</h4>
                        <ul class="list-unstyled">
                            @foreach ($categories as $cat)
                                <li>
                                    <div class="categories-item">
                                        
                                        <i class="fas fa-{{ $cat->icon ?? 'box' }} text-secondary me-2"></i>
                                        {{ $cat->name }}
                                        
                                        <span>({{ $cat->products_count ?? 0 }})</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if ($product->colors && count($product->colors) > 0)
                        <div class="additional-product mb-4">
                            <h4>Available Colors</h4>

                            @foreach ($product->colors as $color)
                                <div class="additional-product-item">
                                    <input type="radio" class="me-2" id="color-{{ $loop->index }}" name="product-color"
                                        value="{{ $color }}">

                                    <label for="color-{{ $loop->index }}" class="text-dark">
                                        {{ ucfirst($color) }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    @endif

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
                                @if ($product->product_images && count($product->product_images) > 0)
                                    @foreach ($product->product_images as $img)
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

                            @if ($product->discount > 0)
                                <del class="me-2 fs-5">₹{{ number_format($product->price, 2) }}</del>
                                <h5 class="fw-bold mb-3">
                                    ₹{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}
                                </h5>
                            @else
                                <h5 class="fw-bold mb-3">₹{{ number_format($product->price, 2) }}</h5>
                            @endif

                            <div class="d-flex mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($product->rating))
                                        <i class="fa fa-star text-secondary"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <small>Product SKU: {{ $product->sku ?? 'N/A' }}</small>
                                
                            </div>

                            <p class="mb-4">{{ $product->description }}</p>

                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0"
                                    value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <a href="{{ route('cart.add', $product->id) }}"
                                class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
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
    @if ($relatedProducts && $relatedProducts->count() > 0)
        <div class="container-fluid related-product py-5">
            <div class="container">
                <div class="mx-auto text-center" style="max-width: 700px;">
                    <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                        data-wow-delay="0.1s">Related Products</h4>
                    <p class="wow fadeInUp" data-wow-delay="0.2s">Discover similar products you might like</p>
                </div>
                <div class="related-carousel owl-carousel pt-4">
                    @foreach ($relatedProducts as $related)
                        <div class="related-item rounded">
                            <div class="related-item-inner border rounded">
                                <div class="related-item-inner-item">
                                    <img src="{{ $related->main_image ? asset('storage/' . $related->main_image) : asset('img/default.png') }}"
                                        class="img-fluid w-100 rounded-top" style="max-height:260px;"
                                        alt="{{ $related->name }}">
                                    @if ($related->featured)
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
                                    @if ($related->discount > 0)
                                        <del class="me-2 fs-5">₹{{ number_format($related->price, 2) }}</del>
                                        <span
                                            class="text-primary fs-5">₹{{ number_format($related->price - ($related->price * $related->discount) / 100, 2) }}</span>
                                    @else
                                        <span class="text-primary fs-5">₹{{ number_format($related->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="related-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                <a href="#"
                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart"
                                    data-product-id="{{ $related->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= round($related->rating) ? 'text-primary' : '' }}"></i>
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
    @endif --}}
    <!-- Related Product End -->
@endsection
