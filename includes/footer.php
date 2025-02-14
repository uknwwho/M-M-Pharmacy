<footer class="footer-section" style="background: linear-gradient(90deg, #964734, #7a3626); padding: 40px 0; color: #fff;">
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="footer-heading">Contact Us</h2>
            <div class="row g-4 mt-4">
                <!-- Social Media Section -->
                <div class="col-md-4">
                    <div class="footer-card">
                        <i class="fas fa-share-alt fa-3x mb-3" style="color: #fff;"></i>
                        <h4 class="footer-title">Follow Us</h4>
                        <div class="social-icons mt-3">
                            <a href="#" class="social-icon" target="_blank">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                            <a href="#" class="social-icon" target="_blank">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                            <a href="#" class="social-icon" target="_blank">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="col-md-4">
                    <div class="footer-card">
                        <i class="fas fa-question-circle fa-3x mb-3" style="color: #fff;"></i>
                        <h4 class="footer-title">Have Questions?</h4>
                        <a href="#" class="footer-link">FAQ's</a>
                    </div>
                </div>

                <!-- Delivery Section -->
                <div class="col-md-4">
                    <div class="footer-card">
                        <i class="fas fa-truck fa-3x mb-3" style="color: #fff;"></i>
                        <h4 class="footer-title">Fast Delivery</h4>
                        <p class="footer-text">We deliver products within 30 minutes!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom text-center mt-5 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> M&M Pharmacy. All rights reserved.</p>
    </div>
</footer>

<style>
    /* Footer Styling */
    .footer-section {
        background: linear-gradient(90deg, #964734, #7a3626);
        color: #fff;
        padding: 40px 0;
    }

    .footer-heading {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    .footer-heading::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #fff;
        margin: 10px auto;
    }

    .footer-card {
        padding: 20px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .footer-card:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-5px);
    }

    .footer-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .footer-text {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .footer-link {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: #f8f9fa;
        text-decoration: underline;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .social-icon {
        color: #fff;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        color: #f8f9fa;
        transform: translateY(-3px);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        font-size: 0.9rem;
        opacity: 0.8;
    }
</style>
