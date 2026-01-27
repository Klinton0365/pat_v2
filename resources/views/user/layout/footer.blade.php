{{-- <!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h4 class="text-primary mb-4">Newsletter</h4>
                        <p class="text-white mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum
                            dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
                        <div class="position-relative mx-auto rounded-pill">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Enter your email">
                            <button type="button"
                                class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Customer Service</h4>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Returns</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Order History</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Site Map</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Testimonials</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> My Account</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Unsubscribe
                        Notification</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Information</h4>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> About Us</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Delivery infomation</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Warranty</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> FAQ</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Seller Login</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Extras</h4>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Brands</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Gift Vouchers</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Affiliates</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Wishlist</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Order History</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                    <a href="#" class=""><i class="fas fa-angle-right me-2"></i> Track Your Order</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-start mb-md-0">
                <span class="text-white"><a href="#" class="border-bottom text-white"><i
                            class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right
                    reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end text-white">

                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a>.
                Distributed By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a> --}}
<style>
    /* Footer Styles */
    .footer {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: #ffffff;
        padding: 60px 0 0;
        position: relative;
        overflow: hidden;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-section h4 {
        color: #ffffff;
        font-size: 1.2rem;
        margin-bottom: 20px;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h4::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #4ecdc4, #45b7d1);
        border-radius: 2px;
    }

    .footer-section p {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .newsletter-form {
        position: relative;
        margin-top: 20px;
    }

    .newsletter-form input {
        width: 100%;
        padding: 14px 120px 14px 20px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .newsletter-form input:focus {
        outline: none;
        border-color: #4ecdc4;
        background: rgba(255, 255, 255, 0.15);
    }

    .newsletter-form input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .newsletter-form button {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        padding: 10px 25px;
        background: linear-gradient(135deg, #4ecdc4, #45b7d1);
        border: none;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-form button:hover {
        background: linear-gradient(135deg, #45b7d1, #4ecdc4);
        transform: translateY(-50%) scale(1.05);
    }

    .footer-links {
        list-style: none;
        padding-left: 0px;
    }

    .footer-links li {

        margin-bottom: 12px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .footer-links a:hover {
        color: #4ecdc4;
        padding-left: 5px;
    }

    .footer-links a i {
        margin-right: 10px;
        font-size: 0.8rem;
        opacity: 0.6;
    }

    /* Social Section */
    .social-section {
        text-align: center;
    }

    .social-icons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-icon:hover {
        background: linear-gradient(135deg, #4ecdc4, #45b7d1);
        border-color: transparent;
        transform: translateY(-5px);
    }

    .payment-badges {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .payment-badge {
        background: white;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #333;
    }

    .security-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 15px;
        border-radius: 8px;
        border: 2px solid rgba(78, 205, 196, 0.5);
        color: #4ecdc4;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 15px;
    }

    .security-badge i {
        margin-right: 5px;
    }

    /* Copyright Section */
    .footer-bottom {
        background: rgba(0, 0, 0, 0.2);
        padding: 25px 0;
        margin-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-bottom-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .copyright {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }

    .copyright a {
        color: #4ecdc4;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .copyright a:hover {
        color: #45b7d1;
    }

    .footer-credits {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
    }

    .footer-credits a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .footer-credits a:hover {
        color: #4ecdc4;
        border-bottom-color: #4ecdc4;
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #4ecdc4, #45b7d1);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-to-top:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(78, 205, 196, 0.6);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer {
            padding: 40px 0 0;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-bottom-content {
            flex-direction: column;
            text-align: center;
        }

        .newsletter-form input {
            padding: 12px 100px 12px 15px;
            font-size: 0.9rem;
        }

        .newsletter-form button {
            padding: 8px 20px;
            font-size: 0.85rem;
        }

        .social-icons {
            justify-content: center;
        }

        .back-to-top {
            width: 45px;
            height: 45px;
            bottom: 20px;
            right: 20px;
        }
    }

    @media (max-width: 480px) {
        .footer-section h4 {
            font-size: 1.1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .payment-badge {
            font-size: 0.75rem;
            padding: 6px 12px;
        }
    }
</style>

<!-- Footer Start -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Newsletter Section -->
            <div class="footer-section">
                <h4>Newsletter</h4>
                <p>Stay updated with our latest offers and news. Subscribe to our newsletter for exclusive deals and
                    updates.</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your email">
                    <button type="button">Get It</button>
                </div>
            </div>

            <!-- Customer Service Section -->
            <div class="footer-section">
                <h4>Customer Service</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i>Contact Us</a></li>
                    {{-- <li><a href="#"><i class="fas fa-angle-right"></i>Returns</a></li> --}}
                    {{-- <li><a href="#"><i class="fas fa-angle-right"></i>Order History</a></li> --}}
                    <li><a href="#"><i class="fas fa-angle-right"></i>Site Map</a></li>
                    <li><a href="#"><i class="fas fa-angle-right"></i>Testimonials</a></li>

                    @auth
                        <li>
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fas fa-angle-right"></i> My Account
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>

            <!-- Information Section -->
            <div class="footer-section">
                <h4>Information</h4>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-angle-right"></i>About Us</a></li>
                    {{-- <li><a href="#"><i class="fas fa-angle-right"></i>Delivery Information</a></li> --}}
                    <li><a href="{{ route('user.privacy') }}"><i class="fas fa-angle-right"></i>Privacy Policy</a></li>
                    <li><a href="{{ route('user.terms') }}"><i class="fas fa-angle-right"></i>Terms & Conditions</a>
                    </li>
                    {{-- <li><a href="#"><i class="fas fa-angle-right"></i>Warranty</a></li> --}}
                    <li><a href="{{ route('user.faq') }}"><i class="fas fa-angle-right"></i>FAQ</a></li>
                </ul>
            </div>

            <!-- Connect With Us Section -->
            <div class="footer-section social-section">
                <h4>Connect With Us</h4>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/pureaquatech.in?igsh=Y296cTI3YWtuc3Fm" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i> Verified Payment
                </div>
                <div class="payment-badges">
                    <span class="payment-badge">💳 MasterCard</span>
                    <span class="payment-badge">💳 VISA</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                {{-- <div class="copyright">
                    <i class="fas fa-copyright"></i> 2024 <a href="#">Pure Aqua Tech</a>. All rights reserved.
                </div> --}}
                <div class="copyright">
                    © 2025 Pure Aqua Tech. All rights reserved.
                    <span style="color:#aaa;"> | Designed & Developed by
                        <a href="https://wa.me/917339047488" target="_blank" style="color:#4facfe;">Klinton A</a>

                    </span>
                </div>


                {{-- <div class="footer-credits">
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a> |
                    Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

<!-- Back to Top Button -->
<a href="#" class="back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

<script>
    // Smooth scroll for back to top
    document.querySelector('.back-to-top').addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Show/hide back to top button
    window.addEventListener('scroll', function() {
        const backToTop = document.querySelector('.back-to-top');
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });
</script>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
