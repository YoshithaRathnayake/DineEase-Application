<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_profile'])) {
        $newName = $_POST['new_name'];
        $newMobileNumber = $_POST['new_mobile_number'];
        // $newEmail = $_POST['new_email'];

        // Update the database with the new data
        $updateQuery = "UPDATE users SET name='$newName', mobile_number='$newMobileNumber' WHERE email='{$_SESSION['SESSION_EMAIL']}'";
        
        if (mysqli_query($conn, $updateQuery)) {
            // Successfully updated the data
            // You can redirect the user to a success page or refresh the current page
            header("Location: welcome.php"); // Change 'profile.php' to your desired destination
            exit();
        } else {
            // Handle the case where the update query fails
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
