<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5 vh-100">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="border p-3 shadow"> <!-- Added border and padding -->
                    <h2 class="bg-primary text-white p-2 rounded text-center">User Registration</h2>
                    <form action="../users/login.php" method="post">
                        <!-- Login form fields -->
                        <div class="form-group">
                            <label for="login_email">Email Address:</label>
                            <input type="email" class="form-control" id="login_email" name="login_email" required>
                        </div>
                        <div class="form-group pt-2 ">
                            <label for="login_password">Password:</label>
                            <input type="password" class="form-control" id="login_password" name="login_password"
                                required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3 w-100">Login</button>
                        <p class="mt-2">Don't have an account? <a href="registration.php">Register here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
