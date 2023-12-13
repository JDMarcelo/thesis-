<?php
// login.php - Handle user login

// Database connection details
include '../includes/db_connection.php';

// Create connection
$connection = new mysqli($host, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];

    // Verify login credentials
    $stmt = $connection->prepare("SELECT * FROM owners WHERE email = ?");
    $stmt->bind_param("s", $login_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($login_password, $user['password'])) {
            // Check if the user is approved
            if ($user['approved'] == 1) {
                // Start session and store user data if needed
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];

                header("Location: ../restaurant/customizeMenu.php");  // Change 'customize_menu.php' to the desired page
                exit();
            } else {
                echo "Your account is pending approval.";
            }
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
}

$connection->close();
?>