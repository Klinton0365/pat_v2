@extends('user.layout.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Contact Us</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    {{-- 
    Professional Contact Page Design - Human Psychology Based UI/UX
    
    Color Psychology Applied:
    - Primary Blue (#1e40af): Trust, reliability, professionalism
    - Success Green (#059669): Positive feedback, confirmation
    - Clean whites/grays: Clarity, approachability
    
    UX Psychology Principles:
    - Reduce friction with clear form labels
    - Build trust with contact info visibility
    - Social proof with business presence (map)
    - Immediate feedback with toast notifications
--}}

<style>
    :root {
        --primary: #1e40af;
        --primary-light: #3b82f6;
        --primary-dark: #1e3a8a;
        --accent: #4f46e5;
        --success: #059669;
        --success-light: #d1fae5;
        --danger: #dc2626;
        --danger-light: #fee2e2;
        --warning: #f59e0b;
        --text-primary: #111827;
        --text-secondary: #4b5563;
        --text-muted: #9ca3af;
        --border: #e5e7eb;
        --bg-light: #f8fafc;
        --bg-card: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --radius: 12px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    /* ==================== TOAST NOTIFICATIONS ==================== */
    .toast-container {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .custom-toast {
        display: none;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        min-width: 320px;
        max-width: 420px;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    .custom-toast.show {
        display: flex;
    }

    .custom-toast.hiding {
        animation: slideOut 0.3s ease forwards;
    }

    .custom-toast.success {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: white;
    }

    .custom-toast.error {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        color: white;
    }

    .toast-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }

    .toast-content {
        flex: 1;
    }

    .toast-title {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .toast-message {
        font-size: 0.85rem;
        opacity: 0.9;
    }

    .toast-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .toast-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* ==================== CONTACT SECTION ==================== */
    .contact-section {
        padding: 80px 0;
        background: linear-gradient(180deg, var(--bg-light) 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .contact-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 90% 80%, rgba(79, 70, 229, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .contact-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 1;
    }

    /* Section Header */
    .contact-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .contact-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 16px;
    }

    .contact-title {
        font-size: 2.75rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .contact-title .highlight {
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-subtitle {
        font-size: 1.1rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Main Content Grid */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Contact Form Card */
    .contact-form-card {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        padding: 40px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
    }

    .form-card-header {
        margin-bottom: 32px;
    }

    .form-card-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: var(--success-light);
        color: var(--success);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50px;
        margin-bottom: 12px;
    }

    .form-card-badge i {
        font-size: 0.65rem;
    }

    .form-card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .form-card-subtitle {
        font-size: 0.95rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Form Styles */
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .form-label .optional {
        font-weight: 400;
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    .form-input-wrapper {
        position: relative;
    }

    .form-input-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1rem;
        transition: color 0.2s;
    }

    .form-input-wrapper.textarea i {
        top: 20px;
        transform: none;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 2px solid var(--border);
        border-radius: var(--radius);
        font-size: 0.95rem;
        color: var(--text-primary);
        background: var(--bg-card);
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
    }

    .form-input:focus + i,
    .form-input:not(:placeholder-shown) + i {
        color: var(--primary);
    }

    .form-input::placeholder {
        color: var(--text-muted);
    }

    .form-textarea {
        min-height: 140px;
        resize: vertical;
    }

    .submit-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 16px 32px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        color: white;
        border: none;
        border-radius: var(--radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
    }

    .submit-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
    }

    .submit-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .submit-btn .spinner {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Map Card */
    .contact-map-card {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        height: 100%;
        min-height: 500px;
        display: flex;
        flex-direction: column;
    }

    .map-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .map-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--warning);
    }

    .map-header-content h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 4px 0;
    }

    .map-header-content p {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin: 0;
    }

    .map-wrapper {
        flex: 1;
        position: relative;
    }

    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    /* Contact Info Cards */
    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    @media (max-width: 1200px) {
        .contact-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .contact-info-grid {
            grid-template-columns: 1fr;
        }
    }

    .contact-info-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 28px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        text-align: center;
    }

    .contact-info-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }

    .info-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: transform 0.3s;
    }

    .contact-info-card:hover .info-icon {
        transform: scale(1.1);
    }

    .info-icon i {
        font-size: 1.5rem;
    }

    .info-icon.address {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: var(--danger);
    }

    .info-icon.email {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: var(--primary);
    }

    .info-icon.phone {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: var(--success);
    }

    .info-icon.web {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: var(--warning);
    }

    .info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 8px;
    }

    .info-text {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.6;
    }

    .info-text a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color 0.2s;
    }

    .info-text a:hover {
        color: var(--primary);
    }

    /* Social Links */
    .social-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 40px;
    }

    .social-link {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--bg-card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: var(--shadow-sm);
    }

    .social-link:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .social-link.facebook:hover {
        background: #1877f2;
        border-color: #1877f2;
        color: white;
    }

    .social-link.twitter:hover {
        background: #1da1f2;
        border-color: #1da1f2;
        color: white;
    }

    .social-link.instagram:hover {
        background: linear-gradient(135deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        border-color: transparent;
        color: white;
    }

    .social-link.linkedin:hover {
        background: #0077b5;
        border-color: #0077b5;
        color: white;
    }

    .social-link.whatsapp:hover {
        background: #25d366;
        border-color: #25d366;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-section {
            padding: 60px 0;
        }

        .contact-header {
            margin-bottom: 40px;
        }

        .contact-title {
            font-size: 2rem;
        }

        .contact-form-card {
            padding: 28px;
        }

        .form-card-title {
            font-size: 1.25rem;
        }

        .contact-map-card {
            min-height: 400px;
        }
    }

    @media (max-width: 576px) {
        .contact-title {
            font-size: 1.75rem;
        }

        .contact-subtitle {
            font-size: 1rem;
        }

        .contact-form-card {
            padding: 24px;
        }

        .contact-info-card {
            padding: 24px;
        }

        .info-icon {
            width: 56px;
            height: 56px;
        }

        .info-icon i {
            font-size: 1.25rem;
        }
    }
</style>

<!-- ==================== TOAST NOTIFICATIONS ==================== -->
<div class="toast-container">
    <!-- Success Toast -->
    <div class="custom-toast success" id="successToast">
        <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="toast-content">
            <div class="toast-title">Success!</div>
            <div class="toast-message" id="toastMessage">Your message has been sent.</div>
        </div>
        <button class="toast-close" onclick="hideToast('successToast')">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <!-- Error Toast -->
    <div class="custom-toast error" id="errorToast">
        <svg class="toast-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="toast-content">
            <div class="toast-title">Error!</div>
            <div class="toast-message" id="errorMessage">Something went wrong.</div>
        </div>
        <button class="toast-close" onclick="hideToast('errorToast')">
            <i class="bi bi-x"></i>
        </button>
    </div>
</div>

<!-- ==================== CONTACT SECTION ==================== -->
<section class="contact-section" id="contact">
    <div class="contact-container">
        <!-- Section Header -->
        <div class="contact-header">
            <span class="contact-badge wow fadeInUp" data-wow-delay="0.1s">
                <i class="bi bi-envelope-paper-fill"></i> Get In Touch
            </span>
            <h1 class="contact-title wow fadeInUp" data-wow-delay="0.2s">
                We'd Love to <span class="highlight">Hear From You</span>
            </h1>
            <p class="contact-subtitle wow fadeInUp" data-wow-delay="0.3s">
                Have questions about our water purifier services? We're here to help! 
                Send us a message and we'll respond as soon as possible.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-card wow fadeInLeft" data-wow-delay="0.2s">
                <div class="form-card-header">
                    <span class="form-card-badge">
                        <i class="bi bi-circle-fill"></i> Quick Response
                    </span>
                    <h2 class="form-card-title">Send Us a Message</h2>
                    <p class="form-card-subtitle">
                        Fill out the form below and our team will get back to you within 24 hours.
                    </p>
                </div>

                <form id="contactForm" class="contact-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <div class="form-input-wrapper">
                                <input type="text" class="form-input" id="name" name="name" 
                                       placeholder="Enter your name" required>
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <div class="form-input-wrapper">
                                <input type="email" class="form-input" id="email" name="email" 
                                       placeholder="Enter your email" required>
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number <span class="optional">(Optional)</span></label>
                        <div class="form-input-wrapper">
                            <input type="tel" class="form-input" id="phone" name="phone" 
                                   placeholder="Enter your phone number">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Your Message</label>
                        <div class="form-input-wrapper textarea">
                            <textarea class="form-input form-textarea" id="message" name="message" 
                                      placeholder="How can we help you?" required></textarea>
                            <i class="bi bi-chat-text"></i>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn" id="contactSubmitBtn">
                        <i class="bi bi-send-fill"></i>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>

            <!-- Map -->
            <div class="contact-map-card wow fadeInRight" data-wow-delay="0.3s">
                <div class="map-header">
                    <div class="map-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="map-header-content">
                        <h4>Our Location</h4>
                        <p>Find us on the map</p>
                    </div>
                </div>
                <div class="map-wrapper">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.568599391863!2d78.38255817479892!3d10.376336689749174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b009db1c233d1fd%3A0xc36099a938da5f66!2sPure%20Aqua%20Tech!5e0!3m2!1sen!2sin!4v1760469329580!5m2!1sen!2sin"
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="contact-info-grid">
            <div class="contact-info-card wow fadeInUp" data-wow-delay="0.1s">
                <div class="info-icon address">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h4 class="info-title">Visit Us</h4>
                <p class="info-text">
                    123 Street, Pure Aqua Tech<br>
                    New York, USA
                </p>
            </div>

            <div class="contact-info-card wow fadeInUp" data-wow-delay="0.2s">
                <div class="info-icon email">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <h4 class="info-title">Email Us</h4>
                <p class="info-text">
                    <a href="mailto:info@pureaquatech.com">info@pureaquatech.com</a><br>
                    <a href="mailto:support@pureaquatech.com">support@pureaquatech.com</a>
                </p>
            </div>

            <div class="contact-info-card wow fadeInUp" data-wow-delay="0.3s">
                <div class="info-icon phone">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h4 class="info-title">Call Us</h4>
                <p class="info-text">
                    <a href="tel:+1234567890">+1 (234) 567-890</a><br>
                    <a href="tel:+0987654321">+0 (987) 654-321</a>
                </p>
            </div>

            <div class="contact-info-card wow fadeInUp" data-wow-delay="0.4s">
                <div class="info-icon web">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h4 class="info-title">Working Hours</h4>
                <p class="info-text">
                    Mon - Sat: 9:00 AM - 6:00 PM<br>
                    Sunday: Closed
                </p>
            </div>
        </div>

        <!-- Social Links -->
        <div class="social-links wow fadeInUp" data-wow-delay="0.5s">
            <a href="#" class="social-link facebook" title="Facebook">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="social-link twitter" title="Twitter">
                <i class="bi bi-twitter-x"></i>
            </a>
            <a href="#" class="social-link instagram" title="Instagram">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="#" class="social-link linkedin" title="LinkedIn">
                <i class="bi bi-linkedin"></i>
            </a>
            <a href="#" class="social-link whatsapp" title="WhatsApp">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Toast Functions
    function showToast(toastId, message) {
        const toast = document.getElementById(toastId);
        const messageEl = toastId === 'successToast' ? 
            document.getElementById('toastMessage') : 
            document.getElementById('errorMessage');
        
        if (message) {
            messageEl.innerHTML = message;
        }
        
        toast.classList.remove('hiding');
        toast.classList.add('show');
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideToast(toastId);
        }, 5000);
    }

    function hideToast(toastId) {
        const toast = document.getElementById(toastId);
        toast.classList.add('hiding');
        
        setTimeout(() => {
            toast.classList.remove('show', 'hiding');
        }, 300);
    }

    // Contact Form Handler
    $(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            var submitBtn = $('#contactSubmitBtn');
            var originalContent = submitBtn.html();

            $.ajax({
                url: "{{ route('contact.store') }}",
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function() {
                    submitBtn.prop('disabled', true).html(
                        '<span class="spinner"></span><span>Sending...</span>'
                    );
                },
                success: function(response) {
                    if (response.success) {
                        showToast('successToast', response.message);
                        $('#contactForm')[0].reset();
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    let msg = '';
                    
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value[0] + '<br>';
                        });
                    } else {
                        msg = xhr.responseJSON?.message || 'Something went wrong!';
                    }
                    
                    showToast('errorToast', msg);
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html(originalContent);
                }
            });
        });
    });

    // Add focus effects for form inputs
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
</script>

    {{-- <!-- Success Message Alert -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
                    <span id="toastMessage"></span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Error Message Alert -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <span id="errorMessage"></span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Contucts Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block pb-2">Get in
                                touch</h4>
                            <p class="mb-5 fs-5 text-dark">We are here for you! how can we help, We are here for you!
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <h5 class="text-primary wow fadeInUp" data-wow-delay="0.1s">Let's Connect</h5>
                        <h1 class="display-5 mb-4 wow fadeInUp" data-wow-delay="0.3s">Send Your Message</h1>
                        <p class="mb-4 wow fadeInUp" data-wow-delay="0.5s">The contact form is currently inactive. Get a
                            functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste
                            the files, add a little code and you're done.</p>
                        <form id="contactForm">
                            @csrf
                            <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                        <label for="phone">Your Phone</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message"
                                            name="message" style="height: 160px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="contactSubmitBtn" class="btn btn-primary w-100 py-3">Send Message</button>
                                </div>
                            </div>
                        </form>

                      
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(function () {
                                $('#contactForm').on('submit', function (e) {
                                    e.preventDefault();

                                    var submitBtn = $('#contactSubmitBtn');

                                    $.ajax({
                                        url: "{{ route('contact.store') }}",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        beforeSend: function () {
                                            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Sending...');
                                        },
                                        success: function (response) {
                                            if (response.success) {
                                                // Show success toast
                                                $('#toastMessage').text(response.message);
                                                var successToast = new bootstrap.Toast(document.getElementById('successToast'));
                                                successToast.show();
                                                
                                                // Reset form
                                                $('#contactForm')[0].reset();
                                            }
                                        },
                                        error: function (xhr) {
                                            let errors = xhr.responseJSON?.errors;
                                            let msg = '';
                                            
                                            if (errors) {
                                                $.each(errors, function (key, value) {
                                                    msg += value[0] + '\n';
                                                });
                                            } else {
                                                msg = xhr.responseJSON?.message || 'Something went wrong!';
                                            }
                                            
                                            // Show error toast
                                            $('#errorMessage').html(msg.replace(/\n/g, '<br>'));
                                            var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                                            errorToast.show();
                                        },
                                        complete: function () {
                                            submitBtn.prop('disabled', false).text('Send Message');
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                    <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="h-100 rounded">
                            
                            <iframe class="rounded w-100" style="height: 100%;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.568599391863!2d78.38255817479892!3d10.376336689749174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b009db1c233d1fd%3A0xc36099a938da5f66!2sPure%20Aqua%20Tech!5e0!3m2!1sen!2sin!4v1760469329580!5m2!1sen!2sin"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row g-4 align-items-center justify-content-center">
                            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="rounded p-4">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                        style="width: 70px; height: 70px;">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4>Address</h4>
                                        <p class="mb-2">123 Street New York.USA</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="rounded p-4">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                        style="width: 70px; height: 70px;">
                                        <i class="fas fa-envelope fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4>Mail Us</h4>
                                        <p class="mb-2">info@example.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="rounded p-4">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                        style="width: 70px; height: 70px;">
                                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4>Telephone</h4>
                                        <p class="mb-2">(+012) 3456 7890</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                                <div class="rounded p-4">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                                        style="width: 70px; height: 70px;">
                                        <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h4>Yoursite@ex.com</h4>
                                        <p class="mb-2">(+012) 3456 7890</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contuct End --> --}}
@endsection