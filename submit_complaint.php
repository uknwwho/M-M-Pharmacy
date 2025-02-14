<?php
session_start();
require_once('includes/functions.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    post_redirect("login.php");  // Redirect to login if not logged in
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Call the function to handle the complaint form submission
    submit_complaint();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-primary {
            width: 100%;
        }

        .btn-home {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Submit a Complaint</h2>

        <!-- Display any messages (error/success) -->
        <?php message(); ?>

        <form action="submit_complaint.php" method="POST">
            <div class="form-group">
                <label for="complaint_subject">Complaint Subject:</label>
                <input type="text" name="complaint_subject" id="complaint_subject" class="form-control" placeholder="Enter the subject" required>
            </div>

            <div class="form-group">
                <label for="complaint_details">Complaint Details:</label>
                <textarea name="complaint_details" id="complaint_details" rows="5" class="form-control" placeholder="Describe your complaint" required></textarea>
            </div>

            <button type="submit" name="submit_complaint" class="btn btn-primary">Submit Complaint</button>
        </form>

        <a href="index.php" class="btn btn-link btn-home">Go back to Home</a> <!-- Optional -->
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>