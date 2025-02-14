<?php
session_start();
include "includes/functions.php";
login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M&M Pharmacy - Admin Login</title>
    <link rel="icon" href="../images/logofile.jpg" type="image/icon type">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2A5C82;
            --secondary-color: #5DA9E9;
            --accent-color: #FF7E67;
            --light-bg: #F8F9FA;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }

        .login-card .card-header {
            background: var(--primary-color);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-bottom: none;
        }

        .login-card .card-header h4 {
            font-weight: 600;
            margin: 0;
        }

        .login-card .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            color: var(--primary-color);
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group .input-group-text {
            background: var(--light-bg);
            border: none;
            color: var(--primary-color);
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .btn-login {
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .forgot-password {
            color: var(--accent-color);
            font-weight: 500;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .regular-user-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }

        .regular-user-link:hover {
            text-decoration: underline;
        }

        .text-center p {
            margin: 10px 0;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="card-header">
            <h4>Admin Sign In</h4>
        </div>
        <div class="card-body">
            <?php message(); ?>
            <form id="loginform" role="form" method="post" action="login.php">

                <!-- Email Input -->
                <div class="form-group">
                    <label for="login-username">Email Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="login-username" type="text" class="form-control" name="adminEmail" placeholder="Enter your email" required>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="login-password" type="password" class="form-control" name="adminPassword" placeholder="Enter your password" required>
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div class="form-group text-right">
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <!-- Login Button -->
                <div class="form-group">
                    <button id="btn-login" class="btn btn-login btn-block" type="submit" name="login">Login</button>
                </div>

                <!-- Regular User Link -->
                <div class="form-group text-center">
                    <p>Regular user? <a href="../login.php" class="regular-user-link">Sign In Here</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>