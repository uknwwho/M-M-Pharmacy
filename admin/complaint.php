<?php
session_start();
require_once('includes/functions.php');

// Fetch all complaints
$complaints = get_all_complaints();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .table {
            background-color: white;
            border-radius: 5px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-home {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">All Submitted Complaints</h2>

        <!-- Check if there are any complaints -->
        <?php if (!empty($complaints)) : ?>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>User ID</th>
                        <th>Subject</th>
                        <th>Details</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($complaints as $complaint) : ?>
                        <tr>
                            <td><?php echo $complaint['complaint_id']; ?></td>
                            <td><?php echo $complaint['user_id']; ?></td>
                            <td><?php echo $complaint['complaint_subject']; ?></td>
                            <td><?php echo $complaint['complaint_details']; ?></td>
                            <td><?php echo $complaint['complaint_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-info text-center">
                No complaints found.
            </div>
        <?php endif; ?>

        <a href="index.php" class="btn btn-primary btn-home">Go back to Home</a> <!-- Optional -->
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>