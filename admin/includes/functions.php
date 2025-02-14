<?php
$connection = mysqli_connect("localhost", "root", "", "m&m pharmacy");
// query functions (start)
function query($query)
{
    global $connection;
    $run = mysqli_query($connection, $query);
    $data = [];
    if ($run && mysqli_num_rows($run) > 0) {  // Check if there are rows returned
        while ($row = $run->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return [];  // Return an empty array if no data is found
    }
}

function single_query($query)
{
    global $connection;
    $run = mysqli_query($connection, $query);
    if ($run) {
        return 1;
    } else {
        return 0;
    }
}
// query functions (end)
// redirect functions (start)
function post_redirect($url)
{
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}
function get_redirect($url)
{
    echo " <script> 
    window.location.href = '$url'; 
    </script>";
}
// redirect functions (end)
// messages function (start)
function message()
{
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] == "loginErr") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is no account with this email !!!
                </div>";
        } elseif ($_SESSION['message'] == "emailErr") {
            echo "   <div class='alert alert-danger' role='alert'>
                The email address is already taken.  Please choose another.
                </div>";
        } elseif ($_SESSION['message'] == "loginErr1") {
            echo "   <div class='alert alert-danger' role='alert'>
                The email or password is wrong!
                </div>";
        } elseif ($_SESSION['message'] == "noResult") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is no user with this email address.
                </div>";
        } elseif ($_SESSION['message'] == "itemErr") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is a product with the same name.
                </div>";
        } elseif ($_SESSION['message'] == "noResultOrder") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is no order with this ID !!!
                </div>";
        } elseif ($_SESSION['message'] == "noResultItem") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is no product with this name !!!
                </div>";
        } elseif ($_SESSION['message'] == "noResultAdmin") {
            echo "   <div class='alert alert-danger' role='alert'>
                There is no admin with this email !!!
                </div>";
        } elseif ($_SESSION['message'] == "empty_err") {
            echo "   <div class='alert alert-danger' role='alert'>
                Please don't leave anything empty !!!
                </div>";
        }
        unset($_SESSION['message']); // Clear the message after displaying it
    }
}

// messages function (end)
// login function (start)
function login()
{
    if (isset($_POST['login'])) {

        $adminEmail = trim($_POST['adminEmail']);
        $password = trim(strtolower($_POST['adminPassword']));
        $query = "SELECT  admin_email , admin_id , admin_pass FROM admin WHERE admin_email= '$adminEmail' ";
        $data = query($query);
        if ($data == 0) {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        } elseif ($password == $data[0]['admin_pass'] and  $adminEmail == $data[0]['admin_email']) {
            $_SESSION['admin_id'] = $data[0]['admin_id'];
            post_redirect("index.php");
        } else {
            $_SESSION['message'] = "loginErr1";
            post_redirect("login.php");
        }
    }
}
// login function (end)
// user functions (start)
function all_users()
{
    $query = "SELECT user_id ,user_fname ,user_lname ,user_email ,user_address, user_prescription FROM user";
    $data = query($query);
    return $data;
}
function delete_user()
{
    if (isset($_GET['delete'])) {
        $userId = $_GET['delete'];
        $query = "DELETE FROM user WHERE user_id ='$userId'";
        $run = single_query($query);
        get_redirect("customers.php");
    }
}
function edit_user($id)
{
    if (isset($_POST['update'])) {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim(strtolower($_POST['email']));
        $address = trim($_POST['address']);
        if (empty($email) or empty($address) or empty($fname) or empty($lname)) {
            $_SESSION['message'] = "empty_err";
            get_redirect("customers.php");
            return;
        }
        $check = check_email_user($email);
        if ($check == 0) {
            $query = "UPDATE user SET user_email='$email' ,user_fname='$fname' ,user_lname='$lname' ,user_address='$address' WHERE user_id= '$id'";
            single_query($query);
            get_redirect("customers.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("customers.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("customers.php");
    }
}
function get_user($id)
{
    $query = "SELECT user_id ,user_fname ,user_lname ,user_email ,user_address FROM user WHERE user_id=$id";
    $data = query($query);
    return $data;
}
function check_email_user($email)
{
    $query = "SELECT user_email FROM user WHERE user_email='$email'";
    $data = query($query);
    if ($data) {
        return 1;
    } else {
        return 0;
    }
}
function search_user()
{
    if (isset($_GET['search_user'])) {
        $email = trim(strtolower($_GET['search_user_email']));
        if (empty($email)) {
            return;
        }
        $query = "SELECT user_id ,user_fname ,user_lname ,user_email ,user_address FROM user WHERE user_email='$email'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResult";
            return;
        }
    }
}
function get_user_details()
{
    if ($_GET['id']) {
        $id = $_GET['id'];
        $query = "SELECT * FROM user WHERE user_id=$id";
        $data = query($query);
        return $data;
    }
}
// user functions (end)
// item functions (start)
function all_items()
{
    $query = "SELECT * FROM product";
    $data = query($query);

    if ($data) {
        foreach ($data as &$item) {
            $item['id'] = $item['pdt_id'];  // Mapping 'pdt_id' to 'id'
        }
    }

    return $data;
}
function delete_item()
{
    if (isset($_GET['delete'])) {
        $itemID = $_GET['delete'];
        $query = "DELETE FROM product WHERE pdt_id ='$itemID'";
        $run = single_query($query);
        get_redirect("products.php");
    }
}
function edit_item($id)
{
    if (isset($_POST['update'])) {
        $name = trim($_POST['name']);
        $brand = trim($_POST['brand']);
        $cat = trim($_POST['cat']);
        $tags = trim($_POST['tags']);
        $image = trim($_POST['image']);
        $quantity = trim($_POST['quantity']);
        $price = trim($_POST['price']);
        $details = trim($_POST['details']);
        $check = check_name($name);
        if ($check == 0) {
            $query = "UPDATE product SET pdt_name='$name' ,pdt_company='$brand' ,pdt_ctg='$cat' ,
            pdt_details='$details',pdt_meterial='$tags' 
            ,pdt_img='$image' ,pdt_quantity='$quantity' ,pdt_cost='$price'  WHERE pdt_id= '$id'";
            $run = single_query($query);
            get_redirect("products.php");
        } else {
            $_SESSION['message'] = "itemErr";
            get_redirect("products.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("products.php");
    }
}
function get_item($id)
{
    $query = "SELECT * FROM product WHERE pdt_id=$id";
    $data = query($query);

    if ($data) {
        $data[0]['id'] = $data[0]['pdt_id'];  // Mapping 'pdt_id' to 'id'
    }

    return $data;
}
function check_name($name)
{
    $query = "SELECT pdt_name FROM product WHERE pdt_name='$name'";
    $data = query($query);
    if ($data) {
        return 1;
    } else {
        return 0;
    }
}
function search_item()
{
    if (isset($_GET['search_item'])) {
        $name = trim($_GET['search_item_name']);
        $query = "SELECT * FROM product WHERE pdt_name LIKE '%$name%'";
        $data = query($query);

        if ($data) {
            foreach ($data as &$item) {
                $item['id'] = $item['pdt_id'];  // Mapping 'pdt_id' to 'id'
            }
            return $data;
        } else {
            $_SESSION['message'] = "noResultItem";
            return;
        }
    }
}
function add_item()
{
    if (isset($_POST['add_item'])) {
        $name = trim($_POST['name']);
        $brand = trim($_POST['brand']);
        $cat = trim($_POST['cat']);
        $tags = trim($_POST['tags']);
        $image = trim($_POST['image']);
        $quantity = trim($_POST['quantity']);
        $price = trim($_POST['price']);
        $details = trim($_POST['details']);
        $check = check_name($name);
        if (
            empty($name) or empty($brand) or empty($cat)  or
            empty($tags) or empty($image) or empty($quantity) or empty($price) or empty($details)
        ) {
            $_SESSION['message'] = "empty_err";
            get_redirect("products.php");
            return;
        }
        if ($check == 0) {
            $query = "INSERT INTO product (pdt_name, pdt_company, pdt_ctg, pdt_details,  pdt_meterial, pdt_img, pdt_quantity, pdt_cost) VALUES
            ('$name' ,'$brand' ,'$cat' ,'$details' ,'$tags' ,'$image' ,'$quantity' ,'$price')";
            $run = single_query($query);
            get_redirect("products.php");
        } else {
            $_SESSION['message'] = "itemErr";
            get_redirect("products.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("products.php");
    }
}
function get_item_details()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM product WHERE pdt_id=$id";
        $data = query($query);

        if ($data) {
            $data[0]['id'] = $data[0]['pdt_id'];  // Mapping 'pdt_id' to 'id'
        }

        return $data;
    }
}
// item functions (end)
// admin functions (start)
function all_admins()
{
    $query = "SELECT admin_id ,admin_fname ,admin_lname ,admin_email  FROM admin";
    $data = query($query);
    return $data;
}
function get_admin($id)
{
    $query = "SELECT admin_id ,admin_fname ,admin_lname ,admin_email  FROM admin WHERE admin_id=$id";
    $data = query($query);
    return $data;
}
function edit_admin($id)
{
    if (isset($_POST['admin_update'])) {
        $fname = trim($_POST['admin_fname']);
        $lname = trim($_POST['admin_lname']);
        $email = trim(strtolower($_POST['admin_email']));
        $password = trim($_POST['admin_password']);
        $check = check_email_admin($email);
        if ($check == 0) {
            $query = "UPDATE admin SET admin_email='$email' ,admin_fname='$fname' ,admin_lname='$lname' ,admin_password='$password'  WHERE admin_id= '$id'";
            single_query($query);
            get_redirect("admin.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("admin.php");
        }
    } elseif (isset($_POST['admin_cancel'])) {
        get_redirect("admin.php");
    }
}
function check_email_admin($email)
{
    $query = "SELECT admin_email FROM admin WHERE admin_email='$email'";
    $data = query($query);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}
function add_admin()
{
    if (isset($_POST['add_admin'])) {
        $fname = trim($_POST['admin_fname']);
        $lname = trim($_POST['admin_lname']);
        $email = trim(strtolower($_POST['admin_email']));
        $password = trim($_POST['admin_password']);
        $check = check_email_admin($email);
        if ($check == 0) {
            $query = "INSERT INTO admin (admin_fname, admin_lname, admin_email, admin_password) 
            VALUES ('$fname','$lname','$email','$password')";
            single_query($query);
            get_redirect("admin.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("admin.php");
        }
    } elseif (isset($_POST['admin_cancel'])) {
        get_redirect("admin.php");
    }
}
function delete_admin()
{
    if (isset($_GET['delete'])) {
        $adminId = $_GET['delete'];
        $query = "DELETE FROM admin WHERE admin_id ='$adminId'";
        $run = single_query($query);
        get_redirect("admin.php");
    }
}
function search_admin()
{
    if (isset($_GET['search_admin'])) {
        $email = trim(strtolower($_GET['search_admin_email']));
        if (empty($email)) {
            return;
        }
        $query = "SELECT admin_id ,admin_fname ,admin_lname ,admin_email FROM admin WHERE admin_email='$email'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResultAdmin";
            return;
        }
    }
}
function check_admin($id)
{
    $query = "SELECT admin_id FROM admin where admin_id='$id'";
    $row = query($query);
    if (empty($row)) {
        return 0;
    } else {
        return 1;
    }
}
// admin functions (end)
// order functions (start)
function all_orders()
{
    $query = "SELECT * FROM orders";
    $data = query($query);
    return $data;
}
function search_order()
{
    if (isset($_GET['search_order'])) {
        $id = trim($_GET['search_order_id']);
        if (empty($id)) {
            return;
        }
        $query = "SELECT * FROM orders WHERE order_id='$id'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResultOrder";
            return;
        }
    }
}
function delete_order()
{
    if (isset($_GET['delete'])) {
        $order_id = $_GET['delete'];
        $query = "DELETE FROM orders WHERE order_id ='$order_id'";
        $run = single_query($query);
        get_redirect("orders.php");
    } elseif (isset($_GET['done'])) {
        $order_id = $_GET['done'];
        $query = "UPDATE orders SET order_status = 1 WHERE order_id='$order_id'";
        single_query($query);
        get_redirect("orders.php");
    } elseif (isset($_GET['undo'])) {
        $order_id = $_GET['undo'];
        $query = "UPDATE orders SET order_status = 0 WHERE order_id='$order_id'";
        single_query($query);
        get_redirect("orders.php");
    }
}
// order functions (end)
function get_all_complaints()
{
    $query = "SELECT * FROM complaints ORDER BY complaint_date DESC";
    return query($query);  // This will return all complaint rows
}
