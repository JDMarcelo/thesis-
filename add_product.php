<?php
// add_product.php

// Include the database connection file
include '../includes/db_connection.php';

// User inputs from the form
$productName = mysqli_real_escape_string($connection, $_POST['productName']);
$productDescription = mysqli_real_escape_string($connection, $_POST['productDescription']);
$productPrice = $_POST['productPrice'];

// Use prepared statement to prevent SQL injection
$query = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($connection, $query);

// Bind parameters
mysqli_stmt_bind_param($stmt, "ssd", $productName, $productDescription, $productPrice);

// Execute the query
$result = mysqli_stmt_execute($stmt);

// Check if the query was successful
if ($result) {
    echo "Product added to the menu successfully!";
} else {
    echo "Error: " . mysqli_error($connection);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
