<?php
// delete_owner.php

// Include your database connection file
include '../includes/db_connection.php';

// Check if ownerId is set in POST data
if (isset($_POST['ownerId'])) {
    // Get ownerId from POST data
    $ownerId = $_POST['ownerId'];

    // Create a query to delete the owner with the specified ID
    $query = "DELETE FROM owners WHERE id = $ownerId";

    // Perform the query
    $result = mysqli_query($connection, $query);

    // Check if the deletion was successful
    if ($result) {
        echo "Owner deleted successfully.";
    } else {
        echo "Error deleting owner: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo "Invalid request. 'ownerId' not provided in POST data.";
}
?>
