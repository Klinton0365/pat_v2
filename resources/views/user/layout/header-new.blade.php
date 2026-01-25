{{-- 
    Professional Header Design with Cart Preview
    
    Features:
    - Clean topbar with contact info
    - Modern search bar with categories
    - Cart dropdown with product preview
    - Quick checkout functionality
    - Responsive mobile menu
    
    Color Psychology:
    - Primary Blue (#1e40af): Trust, professionalism
    - Clean whites: Clarity, modern feel
--}}

<style>
    :root {
        --header-primary: #1e40af;
        --header-primary-light: #3b82f6;
        --header-primary-dark: #1e3a8a;
        --header-accent: #4f46e5;
        --header-success: #059669;
        --header-danger: #dc2626;
        --header-warning: #f59e0b;
        --header-text-primary: #111827;
        --header-text-secondary: #4b5563;
        --header-text-muted: #9ca3af;
        --header-border: #e5e7eb;
        --header-bg-light: #f8fafc;
        --header-bg-card: #ffffff;
        --header-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --header-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --header-radius: 12px;
    }

    /* ==================== TOPBAR ==================== */
    .topbar {
        background: var(--header-bg-light);
        border-bottom: 1px solid var(--header-border);
        padding: 10px 0;
        font-size: 0.875rem;
    }

    .topbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .topbar-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--header-text-secondary);
    }

    .topbar-item i {
        color: var(--header-primary);
        font-size: 0.9rem;
    }

    .topbar-item a {
        color: var(--header-text-secondary);
        text-decoration: none;
        transition: color 0.2s;
    }

    .topbar-item a:hover {
        color: var(--header-primary);
    }

    .topbar-center {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .topbar-phone {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: linear-gradient(135deg, var(--header-primary) 0%, var(--header-accent) 100%);
        color: white;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .topbar-phone:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        color: white;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* Login Button */
    .login-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: var(--header-primary);
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .login-btn:hover {
        background: var(--header-primary-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-dropdown-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        background: var(--header-bg-card);
        border: 1px solid var(--header-border);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .user-dropdown-btn:hover {
        border-color: var(--header-primary-light);
        box-shadow: var(--header-shadow);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--header-primary) 0%, var(--header-accent) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .user-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--header-text-primary);
    }

    .user-dropdown-btn i.arrow {
        font-size: 0.7rem;
        color: var(--header-text-muted);
        transition: transform 0.2s;
    }

    .user-dropdown:hover .user-dropdown-btn i.arrow {
        transform: rotate(180deg);
    }

    .user-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 200px;
        background: var(--header-bg-card);
        border: 1px solid var(--header-border);
        border-radius: var(--header-radius);
        box-shadow: var(--header-shadow-lg);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s;
        z-index: 1000;
    }

    .user-dropdown:hover .user-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown-menu a,
    .user-dropdown-menu button {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 12px 16px;
        color: var(--header-text-secondary);
        text-decoration: none;
        border: none;
        background: none;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .user-dropdown-menu a:hover,
    .user-dropdown-menu button:hover {
        background: var(--header-bg-light);
        color: var(--header-primary);
    }

    .user-dropdown-menu a i,
    .user-dropdown-menu button i {
        width: 18px;
        text-align: center;
    }

    .user-dropdown-divider {
        height: 1px;
        background: var(--header-border);
        margin: 4px 0;
    }

    .user-dropdown-menu button.logout {
        color: var(--header-danger);
    }

    .user-dropdown-menu button.logout:hover {
        background: #fef2f2;
        color: var(--header-danger);
    }

    /* ==================== MAIN HEADER ==================== */
    .main-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 20px 0;
    }

    .main-header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    /* Logo */
    .header-logo {
        flex-shrink: 0;
    }

    .header-logo img {
        height: 60px;
        width: auto;
    }

    /* Search Bar */
    .header-search {
        flex: 1;
        max-width: 600px;
    }

    .search-wrapper {
        display: flex;
        background: var(--header-bg-card);
        border-radius: 50px;
        overflow: hidden;
        box-shadow: var(--header-shadow);
    }

    .search-input {
        flex: 1;
        padding: 14px 20px;
        border: none;
        font-size: 0.95rem;
        outline: none;
    }

    .search-input::placeholder {
        color: var(--header-text-muted);
    }

    .search-category {
        padding: 14px 16px;
        border: none;
        border-left: 1px solid var(--header-border);
        background: var(--header-bg-light);
        font-size: 0.9rem;
        color: var(--header-text-secondary);
        cursor: pointer;
        min-width: 150px;
    }

    .search-category:focus {
        outline: none;
    }

    .search-btn {
        padding: 14px 24px;
        background: var(--header-primary);
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .search-btn:hover {
        background: var(--header-primary-dark);
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-action-btn {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: var(--header-radius);
        color: white;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }

    .header-action-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
    }

    .header-action-btn i {
        font-size: 1.25rem;
    }

    .header-action-btn .badge {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: var(--header-danger);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-action-text {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .header-action-text .label {
        font-size: 0.7rem;
        opacity: 0.7;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .header-action-text .value {
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* ==================== CART DROPDOWN ==================== */
    .cart-dropdown {
        position: relative;
    }

    .cart-dropdown-menu {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        width: 380px;
        background: var(--header-bg-card);
        border: 1px solid var(--header-border);
        border-radius: var(--header-radius);
        box-shadow: var(--header-shadow-lg);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s;
        z-index: 1000;
    }

    .cart-dropdown:hover .cart-dropdown-menu,
    .cart-dropdown-menu:hover {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .cart-dropdown-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--header-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cart-dropdown-header h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--header-text-primary);
        margin: 0;
    }

    .cart-dropdown-header span {
        font-size: 0.8rem;
        color: var(--header-text-muted);
    }

    .cart-dropdown-items {
        max-height: 320px;
        overflow-y: auto;
    }

    .cart-dropdown-items::-webkit-scrollbar {
        width: 6px;
    }

    .cart-dropdown-items::-webkit-scrollbar-track {
        background: var(--header-bg-light);
    }

    .cart-dropdown-items::-webkit-scrollbar-thumb {
        background: var(--header-border);
        border-radius: 3px;
    }

    .cart-dropdown-item {
        display: flex;
        gap: 12px;
        padding: 16px 20px;
        border-bottom: 1px solid var(--header-border);
        transition: background 0.2s;
    }

    .cart-dropdown-item:last-child {
        border-bottom: none;
    }

    .cart-dropdown-item:hover {
        background: var(--header-bg-light);
    }

    .cart-item-image {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        overflow: hidden;
        background: var(--header-bg-light);
        flex-shrink: 0;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-details {
        flex: 1;
        min-width: 0;
    }

    .cart-item-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--header-text-primary);
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-decoration: none;
        display: block;
        transition: color 0.2s;
    }

    .cart-item-name:hover {
        color: var(--header-primary);
    }

    .cart-item-meta {
        font-size: 0.8rem;
        color: var(--header-text-muted);
        margin-bottom: 4px;
    }

    .cart-item-price {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cart-item-price .current {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--header-primary);
    }

    .cart-item-price .original {
        font-size: 0.8rem;
        color: var(--header-text-muted);
        text-decoration: line-through;
    }

    .cart-item-remove {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--header-bg-light);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--header-text-muted);
        cursor: pointer;
        transition: all 0.2s;
        flex-shrink: 0;
        align-self: flex-start;
    }

    .cart-item-remove:hover {
        background: #fef2f2;
        color: var(--header-danger);
    }

    .cart-dropdown-footer {
        padding: 16px 20px;
        border-top: 1px solid var(--header-border);
        background: var(--header-bg-light);
        border-radius: 0 0 var(--header-radius) var(--header-radius);
    }

    .cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .cart-total .label {
        font-size: 0.95rem;
        color: var(--header-text-secondary);
    }

    .cart-total .value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--header-text-primary);
    }

    .cart-dropdown-actions {
        display: flex;
        gap: 10px;
    }

    .cart-dropdown-actions a {
        flex: 1;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .cart-view-btn {
        background: var(--header-bg-card);
        color: var(--header-text-primary);
        border: 1px solid var(--header-border);
    }

    .cart-view-btn:hover {
        border-color: var(--header-primary);
        color: var(--header-primary);
    }

    .cart-checkout-btn {
        background: var(--header-primary);
        color: white;
    }

    .cart-checkout-btn:hover {
        background: var(--header-primary-dark);
        color: white;
    }

    .cart-empty {
        padding: 40px 20px;
        text-align: center;
    }

    .cart-empty-icon {
        width: 60px;
        height: 60px;
        background: var(--header-bg-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .cart-empty-icon i {
        font-size: 1.5rem;
        color: var(--header-text-muted);
    }

    .cart-empty h5 {
        font-size: 1rem;
        color: var(--header-text-primary);
        margin-bottom: 4px;
    }

    .cart-empty p {
        font-size: 0.85rem;
        color: var(--header-text-muted);
        margin: 0;
    }

    /* ==================== NAVIGATION ==================== */
    .main-nav {
        background: var(--header-bg-card);
        border-bottom: 1px solid var(--header-border);
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .main-nav-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Categories Dropdown */
    .categories-dropdown {
        position: relative;
    }

    .categories-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: var(--header-primary);
        color: white;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 600;
        transition: background 0.2s;
    }

    .categories-btn:hover {
        background: var(--header-primary-dark);
    }

    .categories-btn i.bars {
        font-size: 1rem;
    }

    .categories-btn i.arrow {
        font-size: 0.7rem;
        margin-left: auto;
        transition: transform 0.2s;
    }

    .categories-dropdown:hover .categories-btn i.arrow {
        transform: rotate(180deg);
    }

    .categories-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 280px;
        background: var(--header-bg-card);
        border: 1px solid var(--header-border);
        border-top: none;
        border-radius: 0 0 var(--header-radius) var(--header-radius);
        box-shadow: var(--header-shadow-lg);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s;
        z-index: 1000;
    }

    .categories-dropdown:hover .categories-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .categories-menu a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        color: var(--header-text-secondary);
        text-decoration: none;
        border-bottom: 1px solid var(--header-border);
        transition: all 0.2s;
    }

    .categories-menu a:last-child {
        border-bottom: none;
        border-radius: 0 0 var(--header-radius) var(--header-radius);
    }

    .categories-menu a:hover {
        background: var(--header-bg-light);
        color: var(--header-primary);
        padding-left: 24px;
    }

    .categories-menu a span {
        font-size: 0.8rem;
        color: var(--header-text-muted);
    }

    /* Nav Links */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link {
        padding: 16px 20px;
        color: var(--header-text-secondary);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.2s;
        position: relative;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--header-primary);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 2px;
        background: var(--header-primary);
        transform: scaleX(0);
        transition: transform 0.2s;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        transform: scaleX(1);
    }

    /* CTA Button */
    .nav-cta {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--header-success) 0%, #10b981 100%);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    .nav-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(5, 150, 105, 0.4);
        color: white;
    }

    /* ==================== MOBILE STYLES ==================== */
    .mobile-header {
        display: none;
    }

    @media (max-width: 992px) {
        .topbar,
        .main-header,
        .main-nav {
            display: none !important;
        }

        .mobile-header {
            display: block;
            background: var(--header-bg-card);
            border-bottom: 1px solid var(--header-border);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .mobile-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            gap: 12px;
        }

        .mobile-menu-btn {
            width: 44px;
            height: 44px;
            background: var(--header-bg-light);
            border: 1px solid var(--header-border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--header-text-primary);
            cursor: pointer;
        }

        .mobile-logo img {
            height: 40px;
            width: auto;
        }

        .mobile-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-action-btn {
            position: relative;
            width: 44px;
            height: 44px;
            background: var(--header-bg-light);
            border: 1px solid var(--header-border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--header-text-primary);
            text-decoration: none;
        }

        .mobile-action-btn .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 18px;
            height: 18px;
            padding: 0 4px;
            background: var(--header-danger);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-search {
            padding: 0 16px 12px;
        }

        .mobile-search-wrapper {
            display: flex;
            background: var(--header-bg-light);
            border: 1px solid var(--header-border);
            border-radius: 8px;
            overflow: hidden;
        }

        .mobile-search-wrapper input {
            flex: 1;
            padding: 12px 16px;
            border: none;
            background: transparent;
            font-size: 0.95rem;
            outline: none;
        }

        .mobile-search-wrapper button {
            padding: 12px 16px;
            background: var(--header-primary);
            color: white;
            border: none;
            cursor: pointer;
        }
    }

    /* Mobile Menu Overlay */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }

    .mobile-menu-overlay.show {
        display: block;
    }

    /* Mobile Sidebar Menu */
    .mobile-sidebar {
        position: fixed;
        top: 0;
        left: -300px;
        width: 300px;
        height: 100%;
        background: var(--header-bg-card);
        z-index: 9999;
        transition: left 0.3s ease;
        overflow-y: auto;
    }

    .mobile-sidebar.show {
        left: 0;
    }

    .mobile-sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        border-bottom: 1px solid var(--header-border);
    }

    .mobile-sidebar-close {
        width: 36px;
        height: 36px;
        background: var(--header-bg-light);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .mobile-sidebar-nav {
        padding: 16px;
    }

    .mobile-sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        color: var(--header-text-secondary);
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 4px;
        transition: all 0.2s;
    }

    .mobile-sidebar-nav a:hover,
    .mobile-sidebar-nav a.active {
        background: var(--header-bg-light);
        color: var(--header-primary);
    }

    .mobile-sidebar-divider {
        height: 1px;
        background: var(--header-border);
        margin: 16px 0;
    }

    .mobile-sidebar-footer {
        padding: 16px;
        border-top: 1px solid var(--header-border);
    }

    .mobile-sidebar-cta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px;
        background: var(--header-primary);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .mobile-sidebar-cta:hover {
        background: var(--header-primary-dark);
        color: white;
    }
</style>

<!-- ==================== DESKTOP HEADER ==================== -->

<!-- Topbar -->
<div class="topbar d-none d-lg-block">
    <div class="topbar-container">
        <div class="topbar-left">
            <div class="topbar-item">
                <i class="bi bi-file-text"></i>
                <span>GST: 7339047488000</span>
            </div>
        </div>

        <div class="topbar-center">
            <a href="tel:+919994969939" class="topbar-phone">
                <i class="bi bi-telephone-fill"></i>
                <span>+91 9994969939</span>
            </a>
        </div>

        <div class="topbar-right">
            @guest
                <a href="{{ route('login') }}" class="login-btn">
                    <i class="bi bi-person"></i>
                    <span>Login / Register</span>
                </a>
            @else
                <div class="user-dropdown">
                    <div class="user-dropdown-btn">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->last_name, 0, 1)) }}
                        </div>
                        <span class="user-name">{{ Auth::user()->first_name }}</span>
                        <i class="bi bi-chevron-down arrow"></i>
                    </div>
                    <div class="user-dropdown-menu">
                        <a href="{{ route('user.dashboard') }}">
                            <i class="bi bi-grid-1x2"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('user.profile') }}">
                            <i class="bi bi-person"></i>
                            <span>My Account</span>
                        </a>
                        <a href="{{ route('cart') }}">
                            <i class="bi bi-bag"></i>
                            <span>My Orders</span>
                        </a>
                        <div class="user-dropdown-divider"></div>
                        <form action="{{ route('user.logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</div>

<!-- Main Header -->
<div class="main-header d-none d-lg-block">
    <div class="main-header-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ asset('img/logo/PNG.png') }}" alt="Pure Aqua Tech">
        </a>

        <!-- Search -->
        <div class="header-search">
            @php
                $categories = \App\Models\Category::orderBy('name', 'asc')->get();
            @endphp
            <form action="{{ route('shop') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" class="search-input" placeholder="Search for products...">
                <select name="category" class="search-category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- Actions -->
        <div class="header-actions">
            @auth
                @php
                    $cartItems = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
                    $cartTotal = $cartItems->sum(function($item) {
                        $price = $item->product->price;
                        $discount = $item->product->discount ?? 0;
                        $finalPrice = $price - ($price * $discount / 100);
                        return $finalPrice * $item->quantity;
                    });
                    $cartCount = $cartItems->count();
                @endphp

                <!-- Cart Dropdown -->
                <div class="cart-dropdown">
                    <div class="header-action-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="badge cart-count">{{ $cartCount }}</span>
                        <div class="header-action-text">
                            <span class="label">Your Cart</span>
                            <span class="value cart-total-display">₹{{ number_format($cartTotal, 2) }}</span>
                        </div>
                    </div>

                    <div class="cart-dropdown-menu">
                        <div class="cart-dropdown-header">
                            <h4>Shopping Cart</h4>
                            <span>{{ $cartCount }} {{ $cartCount == 1 ? 'item' : 'items' }}</span>
                        </div>

                        @if($cartItems->count() > 0)
                            <div class="cart-dropdown-items">
                                @foreach($cartItems as $item)
                                    @php
                                        $itemPrice = $item->product->price;
                                        $itemDiscount = $item->product->discount ?? 0;
                                        $finalPrice = $itemPrice - ($itemPrice * $itemDiscount / 100);
                                    @endphp
                                    <div class="cart-dropdown-item" data-item-id="{{ $item->id }}">
                                        <div class="cart-item-image">
                                            <img src="{{ $item->product->main_image ? asset('storage/' . $item->product->main_image) : asset('img/product-default.png') }}" 
                                                 alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="cart-item-details">
                                            <a href="{{ route('product.show', [$item->product->id, $item->product->slug]) }}" class="cart-item-name">
                                                {{ $item->product->name }}
                                            </a>
                                            <div class="cart-item-meta">Qty: {{ $item->quantity }}</div>
                                            <div class="cart-item-price">
                                                <span class="current">₹{{ number_format($finalPrice * $item->quantity, 2) }}</span>
                                                @if($itemDiscount > 0)
                                                    <span class="original">₹{{ number_format($itemPrice * $item->quantity, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <button class="cart-item-remove" onclick="removeFromCart({{ $item->id }})">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <div class="cart-dropdown-footer">
                                <div class="cart-total">
                                    <span class="label">Subtotal:</span>
                                    <span class="value">₹{{ number_format($cartTotal, 2) }}</span>
                                </div>
                                <div class="cart-dropdown-actions">
                                    <a href="{{ route('cart') }}" class="cart-view-btn">View Cart</a>
                                    <a href="{{ route('cart') }}" class="cart-checkout-btn">Checkout</a>
                                </div>
                            </div>
                        @else
                            <div class="cart-empty">
                                <div class="cart-empty-icon">
                                    <i class="bi bi-cart-x"></i>
                                </div>
                                <h5>Your cart is empty</h5>
                                <p>Add items to get started</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="header-action-btn">
                    <i class="bi bi-cart3"></i>
                    <div class="header-action-text">
                        <span class="label">Your Cart</span>
                        <span class="value">₹0.00</span>
                    </div>
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="main-nav d-none d-lg-block">
    <div class="main-nav-container">
        <!-- Categories Dropdown -->
        <div class="categories-dropdown">
            <button class="categories-btn">
                <i class="bi bi-grid-3x3-gap-fill bars"></i>
                <span>All Categories</span>
                <i class="bi bi-chevron-down arrow"></i>
            </button>
            <div class="categories-menu">
                @foreach ($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}">
                        {{ $category->name }}
                        <span>({{ $category->products_count ?? 0 }})</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Nav Links -->
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Shop</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        <!-- CTA -->
        <a href="tel:+919994969939" class="nav-cta">
            <i class="bi bi-headset"></i>
            <span>24/7 Support</span>
        </a>
    </div>
</nav>

<!-- ==================== MOBILE HEADER ==================== -->
<div class="mobile-header">
    <div class="mobile-header-top">
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="bi bi-list fs-5"></i>
        </button>

        <a href="{{ route('home') }}" class="mobile-logo">
            <img src="{{ asset('img/logo/PNG.png') }}" alt="Pure Aqua Tech">
        </a>

        <div class="mobile-actions">
            @auth
                @php
                    $mobileCartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                @endphp
                <a href="{{ route('cart') }}" class="mobile-action-btn">
                    <i class="bi bi-cart3"></i>
                    @if($mobileCartCount > 0)
                        <span class="badge">{{ $mobileCartCount }}</span>
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="mobile-action-btn">
                    <i class="bi bi-person"></i>
                </a>
            @endauth
        </div>
    </div>

    <div class="mobile-search">
        <form action="{{ route('shop') }}" method="GET" class="mobile-search-wrapper">
            <input type="text" name="search" placeholder="Search products...">
            <button type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="closeMobileMenu()"></div>

<!-- Mobile Sidebar -->
<div class="mobile-sidebar" id="mobileSidebar">
    <div class="mobile-sidebar-header">
        <img src="{{ asset('img/logo/PNG.png') }}" alt="Logo" style="height: 40px;">
        <button class="mobile-sidebar-close" onclick="closeMobileMenu()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="mobile-sidebar-nav">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">
            <i class="bi bi-shop"></i>
            <span>Shop</span>
        </a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i>
            <span>Contact</span>
        </a>

        <div class="mobile-sidebar-divider"></div>

        @auth
            <a href="{{ route('user.dashboard') }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('user.profile') }}">
                <i class="bi bi-person"></i>
                <span>My Account</span>
            </a>
            <a href="{{ route('cart') }}">
                <i class="bi bi-cart"></i>
                <span>My Cart</span>
            </a>
            
            <div class="mobile-sidebar-divider"></div>
            
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; background: #fef2f2; color: #dc2626; border: none; padding: 14px 16px; border-radius: 8px; display: flex; align-items: center; gap: 12px; cursor: pointer;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}">
                <i class="bi bi-person-plus"></i>
                <span>Register</span>
            </a>
        @endauth
    </div>

    <div class="mobile-sidebar-footer">
        <a href="tel:+919994969939" class="mobile-sidebar-cta">
            <i class="bi bi-telephone"></i>
            <span>Call: +91 9994969939</span>
        </a>
    </div>
</div>

<script>
    // Mobile Menu Toggle
    function toggleMobileMenu() {
        document.getElementById('mobileSidebar').classList.add('show');
        document.getElementById('mobileMenuOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        document.getElementById('mobileSidebar').classList.remove('show');
        document.getElementById('mobileMenuOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    // Remove from Cart (Header Dropdown)
    function removeFromCart(itemId) {
        if (!confirm('Remove this item from cart?')) return;

        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove item from dropdown
                const item = document.querySelector(`.cart-dropdown-item[data-item-id="${itemId}"]`);
                if (item) {
                    item.remove();
                }

                // Update cart count
                const countElements = document.querySelectorAll('.cart-count, .badge');
                countElements.forEach(el => {
                    const currentCount = parseInt(el.textContent) || 0;
                    if (currentCount > 0) {
                        el.textContent = currentCount - 1;
                    }
                });

                // Reload if cart is empty
                const remainingItems = document.querySelectorAll('.cart-dropdown-item');
                if (remainingItems.length === 0) {
                    location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>