<?php
session_start();
include "includes/functions.php";
singUp();
?>

<head>
    <title>M&M Pharmacy - Sign Up</title>
    <link rel="icon" href="images/logofile.jpg" type="image/icon type">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body style="background-color: #f7f9fc;">
    <div class="container">
        <div id="signupbox" style="margin-top:80px;" class="mainbox col-md-6 col-lg-5 col-sm-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create Your M&M Pharmacy Account</h4>
                </div>
                <div class="card-body p-4">
                    <?php message(); ?>
                    <form id="signupform" class="form-horizontal" role="form" method="post" action="signUp.php">

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="glyphicon glyphicon-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <!-- First Name Input -->
                        <div class="form-group">
                            <label for="firstname" class="font-weight-bold">First Name</label>
                            <input type="text" class="form-control" name="Fname" placeholder="Enter your first name" required>
                        </div>

                        <!-- Last Name Input -->
                        <div class="form-group">
                            <label for="lastname" class="font-weight-bold">Last Name</label>
                            <input type="text" class="form-control" name="Lname" placeholder="Enter your last name" required>
                        </div>

                        <!-- Address Input -->
                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter your address" required>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password" class="font-weight-bold">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="glyphicon glyphicon-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="passwd" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <!-- Sign Up Button -->
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" name="singUp">Sign Up</button>
                        </div>

                        <!-- Login Link -->
                        <div class="form-group text-center">
                            <p>Already have an account? <a href="login.php" class="font-weight-bold">Sign In Here</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>