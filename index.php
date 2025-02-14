<?php
include "includes/head.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2A5C82;
            --secondary-color: #5DA9E9;
            --accent-color: #FF7E67;
            --light-bg: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-image {
            height: 200px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.05);
        }

        .btn-custom {
            background: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            height: 250px;
            object-fit: contain;
            padding: 15px;
            background: white;
        }

        .price-tag {
            color: var(--accent-color);
            font-weight: 700;
            font-size: 1.4rem;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin: 40px 0;
            position: relative;
            text-align: center;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--accent-color);
            margin: 15px auto;
        }

        .complaint-section {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 30px;
            margin: 50px 0;
        }
    </style>
</head>

<body>

    <?php include "includes/header.php"; ?>

    <!-- Hero Section -->
    <div class="container-fluid py-5" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
        <div class="container text-center text-white">
            <h1 class="display-4 mb-4">Your Trusted Online Pharmacy</h1>
            <p class="lead mb-4">Get quality healthcare products delivered to your doorstep</p>
            <form class="d-flex justify-content-center mb-4" action="search.php" method="GET">
                <div class="input-group w-50">
                    <input type="search" class="form-control rounded-pill" placeholder="Search medicines and health products..." name="search_text" aria-label="Search">
                    <button class="btn btn-light rounded-pill ms-2 px-4" type="submit" value="go" name="search">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container py-5">
        <h2 class="section-title">Shop By Category</h2>
        <div class="row g-4">
            <?php
            $categories = [
                ['Medicine', '#e6b0aa', 'images/medicines.jpg', 'medicine'],
                ['Dental Care', '#a3e4d7', 'images/dentalcare.jpg', 'dental_care'],
                ['Baby Care', '#aed6f1', 'images/babycare.jpeg', 'babycare'],
                ['Women\'s Care', '#d7bde2', 'images/womenscare.jpeg', 'Womens_Care'],
                ['Sexual Wellness', '#e5e8e8', 'images/sexualawareness.png', 'Sexual_wellness']
            ];

            foreach ($categories as $category) {
                echo '
                <div class="col-md-4 col-lg-3">
                    <div class="category-card" style="background-color: ' . $category[1] . '">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-4" style="color: var(--primary-color); font-weight: 600">' . $category[0] . '</h5>
                            <a href="search.php?cat=' . $category[3] . '">
                                <img src="' . $category[2] . '" class="category-image mb-4">
                            </a>
                            <a href="search.php?cat=' . $category[3] . '" class="btn btn-custom">Shop Now</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="container py-5">
        <h2 class="section-title">Featured Products</h2>
        <div class="row g-4">
            <?php
            $data = all_products();
            $num = sizeof($data);
            for ($i = 0; $i < min(8, $num); $i++) {
                echo '
                <div class="col-md-6 col-lg-3">
                    <div class="product-card">
                        <img src="product_images/' . $data[$i]['pdt_img'] . '" class="product-image w-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . $data[$i]['pdt_name'] . '</h5>
                            <div class="price-tag my-3">৳' . $data[$i]['pdt_cost'] . '</div>
                            <small class="text-muted">' . $data[$i]['pdt_meterial'] . '</small>
                            <div class="mt-3">
                                <a href="product.php?product_id=' . $data[$i]['pdt_id'] . '" class="btn btn-custom btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Complaint Section -->
    <div class="container">
        <div class="complaint-section">
            <h3 class="mb-4" style="color: var(--primary-color); font-weight: 600">We're Here to Help</h3>
            <form action="submit_complaint.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-custom px-5">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>

</body>

</html>