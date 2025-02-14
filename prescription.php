<?php
require_once('includes/functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];  // Ensure the user is logged in

    // Check if a file was uploaded
    if (isset($_FILES['prescription']) && $_FILES['prescription']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['prescription']['tmp_name'];
        $fileName = $_FILES['prescription']['name'];
        $fileSize = $_FILES['prescription']['size'];
        $fileType = $_FILES['prescription']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file extension
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Define the upload path
            $uploadFileDir = 'C:\xampp\htdocs\M&M Pharmacy\Prescriptions';
            $dest_path = $uploadFileDir . $fileName;

            // Move the uploaded file to the destination
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the user's prescription path in the database
                $query = "UPDATE user SET user_prescription = '$dest_path' WHERE user_id = '$user_id'";
                $status = single_query($query);

                if ($status == "done") {
                    $_SESSION['message'] = "Prescription uploaded successfully!";
                    post_redirect("index.php");
                } else {
                    $_SESSION['message'] = "Error updating prescription in the database!";
                    post_redirect("index.php");
                }
            } else {
                $_SESSION['message'] = "Error moving the uploaded file!";
                post_redirect("index.php");
            }
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: jpg, jpeg, png, pdf.";
            post_redirect("index.php");
        }
    } else {
        $_SESSION['message'] = "No file uploaded or there was an upload error.";
        post_redirect("index.php");
    }
}
