<?php
require_once('connection.php');

function post_redirect($url)      //for redirecting to a page
{
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

function get_redirect($url)
{
    echo " <script> 
    window.location.href = '" . $url . "'; 
    </script>";
}

function query($query)        //For any kind of login
{
    global $connection;
    $run = mysqli_query($connection, $query);
    if ($run) {
        while ($row = $run->fetch_assoc()) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            return "";
        }
    } else {
        return 0;
    }
}

function login()
{
    if (isset($_POST['login'])) {

        $userEmail = $_POST['userEmail'];
        $password = $_POST['password'];

        if (empty($userEmail) or empty($password)) {
            post_redirect("login.php");
        }

        $query = "SELECT  user_email , user_id , user_password FROM user WHERE user_email= '$userEmail' ";
        $data = query($query);

        if (empty($data)) {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        } elseif ($password == $data[0]['user_password'] and  $userEmail == $data[0]['user_email']) {
            $_SESSION['user_id'] = $data[0]['user_id'];

            if ($userEmail == "mamun.admin@gmail.com" or $userEmail == "khan.admin@gmail.com") {
                post_redirect("admin/admin.php");
            } else {
                post_redirect("index.php");
            }
        } else {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        }
    }
}

function singUp()
{
    if (isset($_POST['singUp'])) {
        $email  = $_POST['email'];
        $fname  = $_POST['Fname'];
        $lname = $_POST['Lname'];
        $address = $_POST['address'];
        $passwd = $_POST['passwd'];
        if (empty($email) or empty($passwd) or empty($address) or empty($fname) or empty($lname)) {
            $_SESSION['message'] = "empty_err";
            post_redirect("signUp.php");
        }

        $query = "SELECT user_email FROM user ";
        $data = query($query);
        $count = sizeof($data);
        for ($i = 0; $i < $count; $i++) {
            if ($email == $data[$i]['user_email']) {
                $_SESSION['message'] = "usedEmail";
                post_redirect("signUp.php");
            }
        }

        $query = "INSERT INTO user (user_email ,user_fname ,user_lname , user_address,user_password ) VALUES('$email', '$fname' ,'$lname','$address' ,'$passwd')";
        $queryStatus = single_query($query);
        $query = "SELECT user_id FROM user WHERE user_email='$email' ";
        $data = query($query);
        $_SESSION['user_id'] = $data[0]['user_id'];
        if ($queryStatus == "done") {
            post_redirect("index.php");
        } else {
            $_SESSION['message'] = "wentWrong";
            post_redirect("signUp.php");
        }
    }
}

function single_query($query)
{
    global $connection;
    if (mysqli_query($connection, $query)) {
        return "done";
    } else {
        die("no data" . mysqli_connect_error($connection));
    }
}

function search()
{
    if (isset($_GET['search'])) {
        $search_text = $_GET['search_text'];
        if ($search_text == "") {
            return;
        }
        $query = "SELECT * FROM product WHERE pdt_name LIKE '%$search_text%'";
        $data = query($query);
        return $data;
    } elseif (isset($_GET['cat'])) {
        $cat = $_GET['cat'];
        $query = "SELECT * FROM product WHERE pdt_ctg='$cat' ORDER BY RAND()";
        $data = query($query);
        return $data;
    }
}

function all_products()
{
    $query = "SELECT * FROM product ORDER BY RAND()";
    $data = query($query);
    return $data;
}

function total_price($data)
{
    $sum = 0;
    $num = sizeof($data);
    for ($i = 0; $i < $num; $i++) {
        $sum += ($data[$i][0]['pdt_cost'] * $_SESSION['cart'][$i]['quantity']);
    }
    return $sum;
}

function get_item()
{
    if (isset($_GET['product_id'])) {
        $_SESSION['pdt_id'] = $_GET['product_id'];
        $id = $_GET['product_id'];
        $query = "SELECT * FROM product WHERE pdt_id='$id'";
        $data = query($query);
        return $data;
    }
}

function get_user($id)
{
    $query = "SELECT user_id ,user_fname ,user_lname ,user_email ,user_address FROM user WHERE user_id=$id";
    $data = query($query);
    return $data;
}


function add_cart($item_id)
{
    $user_id = $_SESSION['user_id'];
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : null;
    //$quantity = $_GET['quantity'];
    if (empty($user_id)) {
        get_redirect("login.php");
    } else {
        if (isset($_GET['cart'])) {
            if (isset($_SESSION['cart'])) {
                $num = sizeof($_SESSION['cart']);
                $_SESSION['cart'][$num]['user_id'] = $user_id;
                $_SESSION['cart'][$num]['pdt_id'] = $item_id;
                $_SESSION['cart'][$num]['quantity'] = $quantity;
                get_redirect("product.php?product_id=" . $item_id);
            } else {
                $_SESSION['cart'][0]['user_id'] = $user_id;
                $_SESSION['cart'][0]['pdt_id'] = $item_id;
                $_SESSION['cart'][0]['quantity'] = $quantity;
                get_redirect("product.php?pdt_id=" . $item_id);
            }
        } elseif (isset($_GET['buy'])) {
            if (isset($_SESSION['cart'])) {
                $num = sizeof($_SESSION['cart']);
                $_SESSION['cart'][$num]['user_id'] = $user_id;
                $_SESSION['cart'][$num]['pdt_id'] = $item_id;
                $_SESSION['cart'][$num]['quantity'] = $quantity;
                get_redirect("cart.php");
            } else {
                $_SESSION['cart'][0]['user_id'] = $user_id;
                $_SESSION['cart'][0]['pdt_id'] = $item_id;
                $_SESSION['cart'][0]['quantity'] = $quantity;
                get_redirect("cart.php");
            }
        }
        if (isset($_SESSION['cart'])) {
            $num = sizeof($_SESSION['cart']);
            for ($i = 0; $i < $num; $i++) {
                for ($j = $i + 1; $j < $num; $j++) {

                    if ($_SESSION['cart'][$i]['pdt_id'] == $_SESSION['cart'][$j]['pdt_id']) {
                        $_SESSION['cart'][$i]['quantity'] += $_SESSION['cart'][$j]['quantity'];
                        unset($_SESSION['cart'][$j]);
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                    }
                }
            }
        }
    }
}


function get_cart()
{
    $num = sizeof($_SESSION['cart']);
    if (isset($num)) {
        for ($i = 0; $i < $num; $i++) {
            $item_id = $_SESSION['cart'][$i]['pdt_id'];
            $query = "SELECT pdt_id, pdt_img ,pdt_name ,pdt_quantity ,pdt_cost ,pdt_company FROM product WHERE pdt_id='$item_id'";
            $data[$i] = query($query);
        }
        return $data;
    }
}


function delete_from_cart()
{
    if (isset($_GET['delete'])) {
        $item_id = $_GET['delete'];
        $num = sizeof($_SESSION['cart']);
        for ($i = 0; $i < $num; $i++) {
            if ($_SESSION['cart'][$i]['pdt_id'] == $item_id) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
        get_redirect("cart.php");
    } elseif (isset($_GET['delete_all'])) {
        unset($_SESSION['cart']);
        get_redirect("cart.php");
    }
}

function add_order()
{
    if (isset($_GET['order'])) {
        $num = sizeof($_SESSION['cart']);
        date_default_timezone_set("Asia/dhaka");
        $date = date("Y-m-d");
        for ($i = 0; $i < $num; $i++) {
            $item_id = $_SESSION['cart'][$i]['pdt_id'];
            $user_id = $_SESSION['cart'][$i]['user_id'];
            $quantity = $_SESSION['cart'][$i]['quantity'];
            if ($quantity == 0) {
                return;
            } else {
                $query = "INSERT INTO orders (user_id,pdt_id,order_quantity,order_date) 
                VALUES('$user_id','$item_id','$quantity','$date')";
                $data =   single_query($query);
                $item = get_pdt_id($item_id);
                $new_quantity = $item[0]['pdt_quantity'] - $quantity;
                $query = "UPDATE product SET pdt_quantity='$new_quantity' WHERE pdt_id = '$item_id'";
                single_query($query);
            }
        }
        unset($_SESSION['cart']);
        get_redirect("final.php");
    }
}

function check_user($id)
{
    $query = "SELECT user_id FROM user where user_id='$id'";
    $row = query($query);
    if (empty($row)) {
        return 0;
    } else {
        return 1;
    }
}


function get_pdt_id($id)
{
    $query = "SELECT * FROM product WHERE pdt_id= '$id'";
    $data = query($query);
    return $data;
}

function message()
{
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] == "signup_err_password") {
            echo "   <div class='alert alert-danger' role='alert'>
        please enter the password in correct form !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "loginErr") {
            echo "   <div class='alert alert-danger' role='alert'>
        The email or the password is incorrect !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "usedEmail") {
            echo "   <div class='alert alert-danger' role='alert'>
        This email is already used !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "wentWrong") {
            echo "   <div class='alert alert-danger' role='alert'>
        Something went wrong !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "empty_err") {
            echo "   <div class='alert alert-danger' role='alert'>
        please don't leave anything empty !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "signup_err_email") {
            echo "   <div class='alert alert-danger' role='alert'>
        please enter the email in the correct form !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "empty_complaint") {
            echo "   <div class='alert alert-danger' role='alert'>
            Please fill out all the fields for the complaint!
            </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "complaint_success") {
            echo "   <div class='alert alert-success' role='alert'>
            Your complaint has been successfully submitted!
            </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "complaint_error") {
            echo "   <div class='alert alert-danger' role='alert'>
            There was an error submitting your complaint. Please try again.
            </div>";
            unset($_SESSION['message']);
        }
    }
}
// function message()
// {
//     if ($_SESSION['message'] == "loginErr") {
//         echo "   <div class='alert alert-danger' role='alert'>
//         The email or the password is incorrect !!!
//       </div>";
//         unset($_SESSION['message']);
//     } elseif ($_SESSION['message'] == "usedEmail") {
//         echo "   <div class='alert alert-danger' role='alert'>
//         This email is already used !!!
//       </div>";
//         unset($_SESSION['message']);
//     } elseif ($_SESSION['message'] == "wentWrong") {
//         echo "   <div class='alert alert-danger' role='alert'>
//         Something went wrong !!!
//       </div>";
//         unset($_SESSION['message']);
//     } elseif ($_SESSION['message'] == "empty_err") {
//         echo "   <div class='alert alert-danger' role='alert'>
//         please don't leave anything empty !!!
//       </div>";
//         unset($_SESSION['message']);
//     }
// }

function submit_complaint()
{
    if (isset($_POST['submit_complaint'])) {
        $user_id = $_SESSION['user_id'];  // Ensure the user is logged in
        $subject = $_POST['complaint_subject'];
        $details = $_POST['complaint_details'];

        if (empty($subject) || empty($details)) {
            $_SESSION['message'] = "empty_complaint";
            post_redirect("submit_complaint");
        }

        // Insert complaint into the database
        $query = "INSERT INTO complaints (user_id, complaint_subject, complaint_details) 
                  VALUES ('$user_id', '$subject', '$details')";
        $queryStatus = single_query($query);

        if ($queryStatus == "done") {
            $_SESSION['message'] = "complaint_success";
            post_redirect("complaint.php");
        } else {
            $_SESSION['message'] = "complaint_error";
            post_redirect("submit_complaint");
        }
    }
}

// Fetch complaints submitted by a specific user
function get_user_complaints($user_id)
{
    $query = "SELECT * FROM complaints WHERE user_id = '$user_id' ORDER BY complaint_date DESC";
    return query($query);  // This will return only this user's complaints
}
