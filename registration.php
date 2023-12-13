<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registration and Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container mt-5 vh-100">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-3 shadow">
                    <h2 class="bg-primary text-white p-2 rounded text-center">User Registration</h2>
                    <form action="../users/register.php" method="post">
                        <!-- Existing registration form fields with icons -->
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>

                        <div class="form-group">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="form-group">
                            <label for="store_name">Store Name:</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" required>
                        </div>

                        <div class="form-group">
                            <label for="store_address">Store Address (Google Maps):</label>
                            <input type="text" class="form-control" id="store_address" name="store_address" required>
                        </div>

                        <div class="form-group">
                            <label for="owner_address_street_number">Owner Address - Street Number:</label>
                            <input type="text" class="form-control" id="owner_address_street_number"
                                name="owner_address_street_number">
                        </div>

                        <div class="form-group">
                            <label for="owner_address_barangay">Owner Address - Barangay:</label>
                            <input type="text" class="form-control" id="owner_address_barangay"
                                name="owner_address_barangay">
                        </div>
                        <div class="form-group">
                            <label for="owner_address_municipality">Owner Address - Municipality:</label>
                            <input type="text" class="form-control" id="owner_address_municipality"
                                name="owner_address_municipality">
                        </div>
                        <div class="form-group">
                            <label for="owner_address_province">Owner Address - Province:</label>
                            <input type="text" class="form-control" id="owner_address_province"
                                name="owner_address_province">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password"
                                name="confirm_password" required>
                            <small id="passwordMatchError" class="text-danger d-none">Passwords do not match</small>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3 w-100">Register</button>
                            <p class="mt-2">Already have an account? <a href="../users/userLogin.php">Login here</a></p>
                        </div>
                        <?php
                        // Display error message if registration failed
                        if (isset($errorMessage)) {
                            echo '<div class="alert alert-danger mt-3" role="alert">' . $errorMessage . '</div>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>