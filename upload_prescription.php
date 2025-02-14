<?php
require_once('includes/functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // File handling code goes here (same as earlier)
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Prescription</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Include Bootstrap CSS -->
</head>

<body>
    <form class="d-flex ms-3" action="prescription.php" method="POST" enctype="multipart/form-data">
        <input class="form-control me-2" type="file" name="prescription" accept=".jpg,.jpeg,.png,.pdf" required>
        <button class="btn btn-outline-light" type="submit">Upload </button>
    </form>
</body>

</html>