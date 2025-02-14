<?php
include "includes/head.php";
?>

<body>
    <?php
    include "includes/header.php"
    ?>


    <?php
    include "includes/sidebar.php";
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        message();
        ?>
        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <br>
                    <h2>Products details</h2>
                    <br>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <br>
                    <form class="d-flex" method="GET" action="products.php">
                        <input class="form-control me-2 col" type="search" name="search_item_name" placeholder="Search for product" aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit" name="search_item" value="search">Search</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <?php

        if (isset($_GET['edit'])) {
            edit_item($_SESSION['id']);
            $_SESSION['id'] = $_GET['edit'];
            $data = get_item($_SESSION['id']);

        ?>
            <br>
            <h2>Edit Product Details</h2>
            <form action="products.php" method="POST">
                <div class=" form-group mb-3">
                    <label>Product name</label>
                    <input pattern="[A-Za-z0-9_]{1,25}" id="exampleInputText1" type="text" class="form-control" placeholder="<?php echo $data[0]['pdt_name'] ?>" name="name">
                    <div class="form-text">please enter the product name in range(1-25) character/s , special character not allowed !</div>
                </div>
                <div class="form-group">
                    <label>Company name</label>
                    <input pattern="[A-Za-z0-9_]{1,25}" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['pdt_company'] ?>" name="brand">
                    <div class="form-text">please enter the Company name in range(1-25) character/s , special character not allowed !</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <label class="input-group-text" for="inputGroupSelect01">category</label>
                    <select name="cat" class="form-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="medicine">Medicine</option>
                        <option value="dental_care">Dental Care</option>
                        <option value="babycare">Baby Care</option>
                        <option value="Womens_Care">Womens Care</option>
                        <option value="Sexual_wellnes">Sexual Wellnes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Meterial</label>
                    <input pattern="^[#.0-9a-zA-Z\s,-]+$" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['pdt_meterial'] ?>" name="tags">
                    <div class="form-text">please enter meterial for the product in range(1-250) character/s , special character not allowed !</div>
                </div>
                <div class="form-group">
                    <label>Product image</label>
                    <input type="file" accept="image/*" class="form-control" placeholder="<?php echo $data[0]['pdt_img'] ?>" name="image">
                    <div class="form-text">please enter image for the product .</div>
                </div>
                <div class="form-group">
                    <label>Product quantity</label>
                    <input type="number" class="form-control" placeholder="<?php echo $data[0]['pdt_quantity'] ?>" name="quantity" min="1" max="999">
                    <div class="form-text">please enter the quantity of the product in range(1-999) .</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <span class="input-group-text">৳</span>
                    <input pattern="[0-9]+" id="validationTooltip01" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" placeholder="<?php echo $data[0]['pdt_cost'] ?>">
                    <span class="input-group-text">.00</span>
                </div>
                <div class="form-text">please enter the price of the product .</div>
                <div class="form-group">
                    <label for="inputAddress2">Product details</label>
                    <input type="text" class="form-control" placeholder="<?php echo $data[0]['pdt_details'] ?>" name="details">
                </div>
                <div class="form-text">please enter the product details .</div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="update">Submit</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Cancel</button>
                <br> <br>
            </form>
        <?php
        }
        ?>
        <?php
        add_item();
        if (isset($_GET['add'])) {
        ?>
            <br>
            <h2>Add Product</h2>
            <form action="products.php" method="POST">
                <div class=" form-group mb-3">
                    <label>Product name</label>
                    <input id="exampleInputText1" type="text" class="form-control" placeholder="product name" name="name">
                    <div class="form-text">please enter the product name in range(1-25) character/s , special character not allowed !</div>
                </div>
                <div class="form-group">
                    <label>Company name</label>
                    <input id="validationTooltip01" type="text" class="form-control" placeholder="Company brand" name="brand">
                    <div class="form-text">please enter the brand name in range(1-25) character/s , special character not allowed !</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <label class="input-group-text" for="inputGroupSelect01">category</label>
                    <select name="cat" class="form-select" id="inputGroupSelect01">
                        <option value="medicine">Medicine</option>
                        <option value="dental_care">Dental Care</option>
                        <option value="babycare">Baby Care</option>
                        <option value="Womens_Care">Womens Care</option>
                        <option value="Sexual_wellnes">Sexual Wellnes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Meterial</label>
                    <input id="validationTooltip01" type="text" class="form-control" placeholder="product tags" name="tags">
                    <div class="form-text">please enter meterial for the product in range(1-250) character/s , special character not allowed !</div>
                </div>
                <div class="form-group">
                    <label>Product image</label>
                    <input type="file" accept="image/*" class="form-control" placeholder="image" name="image">
                    <div class="form-text">please enter image for the product .</div>
                </div>
                <div class="form-group">
                    <label>Product quantity</label>
                    <input type="number" class="form-control" placeholder="product quantity" name="quantity" min="1" max="999">
                    <div class="form-text">please enter the quantity of the product in range(1-999) .</div>
                </div>
                <div class="input-group mb-3 form-group">
                    <span class="input-group-text">৳</span>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="price" placeholder="product price">
                    <span class="input-group-text">.00</span>
                </div>
                <div class="form-text">please enter the price of the product .</div>
                <div class="form-group">
                    <label for="inputAddress2">Product details</label>
                    <input type="text" class="form-control" placeholder="product details" name="details">
                </div>
                <div class="form-text">please enter the product details .</div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="add_item">Submit</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Cancel</button>
                <br> <br>
            </form>
        <?php
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Company</th>
                        <th scope="col">Category</th>
                        <th scope="col">Meterial</th>
                        <th scope="col">Image</th>
                        <th scope="col">quantity</th>
                        <th scope="col">price</th>
                        <th scope="col">details</th>
                        <th>
                        <th>
                            <button type="button" class="btn btn-outline-primary"><a style="text-decoration: none; color:black;" href="products.php?add=1"> &nbsp;&nbsp;Add&nbsp;&nbsp;</a></button>
                        </th>
                        </th>

                </thead>

                <tbody>
                    <?php
                    $data = all_items();
                    delete_item();
                    if (isset($_GET['search_item'])) {
                        $query = search_item();
                        if (isset($query)) {
                            $data = $query;
                        } else {
                            get_redirect("products.php");
                        }
                    } elseif (isset($_GET['id'])) {
                        $data = get_item_details();
                    }
                    if (isset($data)) {


                        $num = sizeof($data);
                        for ($i = 0; $i < $num; $i++) {
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $data[$i]['pdt_id'] ?></td>
                                <td><?php echo $data[$i]['pdt_name'] ?></td>
                                <td><?php echo $data[$i]['pdt_company'] ?></td>
                                <td><?php echo $data[$i]['pdt_ctg'] ?></td>
                                <td><?php echo $data[$i]['pdt_meterial'] ?></td>
                                <td><?php echo $data[$i]['pdt_img'] ?></td>
                                <td><?php echo $data[$i]['pdt_quantity'] ?></td>
                                <td><?php echo $data[$i]['pdt_cost'] ?></td>
                                <td><?php echo $data[$i]['pdt_details'] ?></td>
                                <td>
                                    <button type="button" class="btn pull-left btn-outline-warning"><a style="text-decoration: none; color:black;" href="products.php?edit=<?php echo $data[$i]['id'] ?>">Edit</a></button>
                                </td>
                                <td>
                                    <button type="button" class="btn pull-left btn-outline-danger"><a style="text-decoration: none; color:black;" href="products.php?delete=<?php echo $data[$i]['id'] ?>">Delete</a></button>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    </div>
    </div>
    <?php
    include "includes/footer.php"
    ?>