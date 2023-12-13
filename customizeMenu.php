<?php
// Database connection
include '../includes/db_connection.php';
include '../includes/database_functions.php'; // Include your functions file

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get all products
$products = getMenu(1); // Assuming 1 is the owner_id, replace it with the actual owner_id
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Menu</h2>

        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
            Add Product
        </button>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if $products is not null before looping
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <tr>
                            <td><?= isset($product['id']) ? $product['id'] : '' ?></td>
                            <td><?= isset($product['name']) ? $product['name'] : '' ?></td>
                            <td><?= isset($product['description']) ? $product['description'] : '' ?></td>
                            <td><?= isset($product['price']) ? $product['price'] : '' ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= isset($product['id']) ? $product['id'] : '' ?>">Edit</a> |
                                <a href="delete_product.php?id=<?= isset($product['id']) ? $product['id'] : '' ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    // Handle the case when there are no products
                    echo '<tr><td colspan="4">No products available</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Modal for adding a new product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form for adding a new product here -->
                    <form action="../restaurant/add_product.php" method="post">
                        <!-- Include the necessary input fields for adding a product -->
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product Description:</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Product Price:</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Product Image:</label>
                            <input type="file" class="form-control-file mb-5" id="productImage" name="productImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close the connection
mysqli_close($connection);
?>
