<?php
// Start the session (if not already started)
session_start();

// Database connection details
include '../includes/db_connection.php';

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize user input
function sanitizeInput($input)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($input));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $last_name = sanitizeInput($_POST["last_name"]);
    $first_name = sanitizeInput($_POST["first_name"]);
    $middle_name = sanitizeInput($_POST["middle_name"]);
    $age = sanitizeInput($_POST["age"]);
    $store_name = sanitizeInput($_POST["store_name"]);
    $store_address = sanitizeInput($_POST["store_address"]);
    $owner_address_street_number = sanitizeInput($_POST["owner_address_street_number"]);
    $owner_address_barangay = sanitizeInput($_POST["owner_address_barangay"]);
    $owner_address_municipality = sanitizeInput($_POST["owner_address_municipality"]);
    $owner_address_province = sanitizeInput($_POST["owner_address_province"]);
    $email = sanitizeInput($_POST["email"]);
    $phone_number = sanitizeInput($_POST["phone_number"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Use prepared statement to insert user data into the database with 'approved' set to 0
    $stmt = $connection->prepare("INSERT INTO owners (last_name, first_name, middle_name, age, store_name, store_address, owner_address_street_number, owner_address_barangay, owner_address_municipality, owner_address_province, email, phone_number, password, approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssssssssssss", $last_name, $first_name, $middle_name, $age, $store_name, $store_address, $owner_address_street_number, $owner_address_barangay, $owner_address_municipality, $owner_address_province, $email, $phone_number, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Registration successful 
        // Redirect to a page indicating that the registration is pending approval
        header("Location: ../users/userLogin.php");
        exit();
    } else {
        // Registration failed
        $errorMessage = "Registration failed. Please try again later.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($connection);
?>
