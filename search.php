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

        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--light-bg);
        }

        .product-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-5px);
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

        .no-results {
            text-align: center;
            margin: 50px 0;
        }

        .no-results img {
            max-width: 100%;
            height: auto;
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
    </style>
</head>

<body>

    <?php include "includes/header.php"; ?>

    <div class="container-fluid py-5">
        <div class="row">
            <?php
            $data = search();
            if (!empty($data)) {
                $num = sizeof($data);
                for ($i = 0; $i < $num; $i++) {
            ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="product-card">
                            <img src="product_images/<?php echo $data[$i]['pdt_img'] ?>" class="product-image w-100">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $data[$i]['pdt_name'] ?></h5>
                                <div class="price-tag my-3">৳<?php echo $data[$i]['pdt_cost'] ?></div>
                                <small class="text-muted"><?php echo $data[$i]['pdt_meterial'] ?></small>
                                <div class="mt-3">
                                    <a href="product.php?product_id=<?php echo $data[$i]['pdt_id'] ?>" class="btn btn-custom btn-sm">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                unset($data);
                if ($num < 8) {
                    $data = all_products();
                    $num = sizeof($data);
                ?>
                    <h2 class="section-title">You Might Also Like</h2>
                    <?php
                    for ($i = 0; $i < $num; $i++) {
                    ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="product-card">
                                <img src="product_images/<?php echo $data[$i]['pdt_img'] ?>" class="product-image w-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $data[$i]['pdt_name'] ?></h5>
                                    <div class="price-tag my-3">৳<?php echo $data[$i]['pdt_cost'] ?></div>
                                    <small class="text-muted"><?php echo $data[$i]['pdt_meterial'] ?></small>
                                    <div class="mt-3">
                                        <a href="product.php?product_id=<?php echo $data[$i]['pdt_id'] ?>" class="btn btn-custom btn-sm">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        if ($i == 3) {
                            break;
                        }
                    }
                }
            } else {
                ?>
                <div class="no-results">
                    <img src="images/1.gif" alt="No Results Found">
                    <!--h2 class="section-title">No Results Found</h2-->
                    <h2 class="section-title">You Might Also Like</h2>
                </div>
                <?php
                $data = all_products();
                $num = sizeof($data);
                for ($i = 0; $i < $num; $i++) {
                ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="product-card">
                            <img src="product_images/<?php echo $data[$i]['pdt_img'] ?>" class="product-image w-100">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $data[$i]['pdt_name'] ?></h5>
                                <div class="price-tag my-3">৳<?php echo $data[$i]['pdt_cost'] ?></div>
                                <small class="text-muted"><?php echo $data[$i]['pdt_meterial'] ?></small>
                                <div class="mt-3">
                                    <a href="product.php?product_id=<?php echo $data[$i]['pdt_id'] ?>" class="btn btn-custom btn-sm">More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    if ($i == 3) {
                        break;
                    }
                }
            }
            ?>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include "includes/footer.php"; ?>
</body>

</html>