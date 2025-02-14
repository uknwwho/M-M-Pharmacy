<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #3498db, #2c3e50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); position: relative; overflow: hidden;">
        <!-- Animated background elements -->
        <div class="nav-decor"></div>
        <div class="nav-decor"></div>
        <div class="nav-decor"></div>

        <div class="container-fluid">
            <!-- Logo with enhanced animation -->
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <div class="logo-container">
                    <img src="images/logofile.jpg" alt="Logo" class="logo-img" style="height: 70px; width:120px;">
                    <div class="logo-glow"></div>
                </div>
                <span class="ms-3 brand-name">M&M Pharmacy</span>
            </a>

            <!-- PHP Login/Logout Handling -->
            <div class="d-flex align-items-center">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-pulse"></span>
                            <!--<span class="cart-count">0</span>-->
                        </a>
                    </li>
                </ul>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a class='nav-link login-btn' href='login.php'>
                        <i class="fas fa-sign-in-alt me-2"></i>Log in
                    </a>
                <?php else: ?>
                    <?php $check_user_id = check_user($_SESSION['user_id']); ?>
                    <?php if ($check_user_id == 1): ?>
                        <a class="nav-link prescription-btn" href="upload_prescription.php">
                            <i class="fas fa-prescription me-2"></i>Upload
                        </a>
                        <a class='nav-link logout-btn' href='logout.php'>
                            <i class="fas fa-sign-out-alt me-2"></i>Log out
                        </a>
                    <?php else: ?>
                        <?php post_redirect("logout.php"); ?>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Enhanced Search Form -->
                <form class="d-flex ms-3 search-form" action="search.php" method="GET">
                    <div class="search-container">
                        <input class="form-control search-input" type="search" placeholder="Search medicines..." name="search_text">
                        <button class="btn search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-border"></div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <style>
        /* Modern gradient animation */
        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        nav.navbar {
            background-size: 400% 400% !important;
            animation: gradientFlow 15s ease infinite;
            padding: 0.8rem 1rem;
            min-height: 80px;
        }

        /* Animated background elements */
        .nav-decor {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            width: 150px;
            height: 150px;
            border-radius: 50%;
            filter: blur(40px);
            animation: decorFloat 20s infinite linear;
        }

        .nav-decor:nth-child(1) {
            top: -50px;
            left: -30px;
        }

        .nav-decor:nth-child(2) {
            bottom: -80px;
            right: -60px;
        }

        .nav-decor:nth-child(3) {
            top: 30%;
            right: 40%;
        }

        @keyframes decorFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Enhanced Logo Styling */
        .logo-container {
            position: relative;
            transition: transform 0.3s ease;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .logo-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(52, 152, 219, 0.3);
            border-radius: 18px;
            filter: blur(15px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .logo-container:hover .logo-glow {
            opacity: 1;
        }

        .logo-container:hover .logo-img {
            transform: rotate(-10deg) scale(1.1);
            filter: drop-shadow(0 0 8px rgba(52, 152, 219, 0.5));
        }

        .brand-name {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, #ecf0f1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: textReveal 0.8s ease;
        }

        @keyframes textReveal {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Modern Navigation Links */
        .nav-link {
            padding: 10px 20px !important;
            margin: 0 8px !important;
            font-weight: 500;
            border-radius: 12px !important;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        /* Cart Icon Enhancements */
        .cart-icon {
            position: relative;
            margin-right: 15px;
        }

        .fa-shopping-cart {
            font-size: 1.8rem;
            transition: transform 0.3s ease;
        }

        .cart-pulse {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 12px;
            height: 12px;
            background: #e74c3c;
            border-radius: 50%;
            opacity: 0;
            animation: cartPulse 2s infinite;
        }

        @keyframes cartPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }

        /* Enhanced Buttons */
        .login-btn,
        .logout-btn,
        .prescription-btn {
            padding: 10px 25px !important;
            border-radius: 15px !important;
            display: flex !important;
            align-items: center;
            transition: all 0.3s ease;
            border: none !important;
        }

        .login-btn {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(5px);
        }

        .logout-btn {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
        }

        .prescription-btn {
            background: linear-gradient(45deg, #2ecc71, #27ae60) !important;
        }

        /* Modern Search Form */
        .search-container {
            position: relative;
            margin-left: 20px;
        }

        .search-input {
            width: 280px;
            border-radius: 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            color: #fff;
            padding: 12px 45px 12px 20px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 15px rgba(52, 152, 219, 0.3);
        }

        .search-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            color: #fff;
            transform: translateY(-50%) scale(1.1);
        }

        .search-border {
            position: absolute;
            inset: 0;
            border-radius: 15px;
            pointer-events: none;
            border: 2px solid transparent;
            background: linear-gradient(45deg, #3498db, #2ecc71) border-box;
            -webkit-mask:
                linear-gradient(#fff 0 0) padding-box,
                linear-gradient(#fff 0 0);
            mask:
                linear-gradient(#fff 0 0) padding-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        /* Responsive Design Enhancements */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(10px);
                padding: 20px;
                border-radius: 15px;
                margin-top: 10px;
            }

            .search-input {
                width: 100%;
            }

            .nav-link {
                margin: 8px 0 !important;
                justify-content: center;
            }
        }
    </style>
</header>