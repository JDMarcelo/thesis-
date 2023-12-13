<?php
// admin_authorize.php

// Database connection details
include '../includes/db_connection.php';

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted using GET method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the "user_id" parameter is set in the URL
    if (isset($_GET["user_id"])) {
        // Get the user ID from the URL
        $user_id = $_GET["user_id"];

        // Check the current approval status
        $queryStatus = "SELECT approved FROM owners WHERE id = $user_id";
        $resultStatus = mysqli_query($connection, $queryStatus);

        if ($resultStatus) {
            $row = mysqli_fetch_assoc($resultStatus);
            $currentStatus = $row['approved'];

            // Toggle the approval status
            $newStatus = $currentStatus == 1 ? 0 : 1;

            // Update the user's approval status
            $query = "UPDATE owners SET approved = $newStatus WHERE id = $user_id";
            $result = mysqli_query($connection, $query);

            // Update the status based on the new approval status
            $newStatusText = $newStatus == 1 ? 'approved' : 'pending';
            $queryUpdateStatus = "UPDATE owners SET status = '$newStatusText' WHERE id = $user_id";
            $resultUpdateStatus = mysqli_query($connection, $queryUpdateStatus);

            if ($result && $resultUpdateStatus) {
                echo "Registration status updated successfully.";
                // Reload the page after 0.5 seconds using JavaScript
                echo "<script>setTimeout(function(){ window.location.href = '../admin/admin_dashboard.php'; }, 500);</script>";
            } else {
                echo "Error updating approval status or status: " . mysqli_error($connection);
            }
        } else {
            echo "Error fetching current approval status: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid request. 'user_id' parameter not provided in the URL.";
    }
} else {
    echo "Invalid request. Please use a GET request.";
}

// Close the database connection
mysqli_close($connection);
?>
