<?php
// admin_dashboard.php

// Database connection details
include '../includes/db_connection.php';

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch owners data
$query = "SELECT * FROM owners";
$result = mysqli_query($connection, $query);

// Check if there are owners
if ($result) {
    $owners = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $owners = [];
}

// Close the database connection
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Company Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .header {
            background-color: #343a40;
            padding: 20px;
            color: #ffffff;
            text-align: center;
        }

        .dashboard-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Adjust column width as needed */
        .table th,
        .table td {
            text-align: center;
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        /* Adjust column width as needed */
        .table th:nth-child(6),
        .table td:nth-child(6),
        .table th:nth-child(7),
        .table td:nth-child(7) {
            min-width: 120px;
        }

        /* Custom icons for status */
        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-pending {
            background-color: #ffc107;
            /* Bootstrap's warning color */
        }

        .status-approved {
            background-color: #28a745;
            /* Bootstrap's success color */
        }
    </style>
</head>

<body>
    <div class="header">
        <h2 class="mb-0">Company Admin Dashboard</h2>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <h4>Total Owners</h4>
                    <p>
                        <?php echo count($owners); ?>
                    </p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="dashboard-card">
                    <h4>Owners List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Age</th>
                                    <th>Store Address</th>
                                    <th>Street Number</th>
                                    <th>Barangay</th>
                                    <th>Municipality</th>
                                    <th>Province</th>
                                    <th>Store Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($owners as $owner): ?>
                                    <tr>
                                        <td>
                                            <?= $owner['id'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['last_name'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['first_name'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['middle_name'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['age'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['store_address'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['owner_address_street_number'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['owner_address_barangay'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['owner_address_municipality'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['owner_address_province'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['store_name'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['email'] ?>
                                        </td>
                                        <td>
                                            <?= $owner['email'] ?>
                                        </td>
                                        <td
                                            style="<?= !$owner['approved'] ? 'background-color: #d4edda;' : 'background-color: #ffeeba; color: #155724;' ?>">
                                            <?= !$owner['approved'] ? 'Approved' : 'Pending' ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" data-toggle="collapse"
                                                data-target="#ownerFunctions<?= $owner['id'] ?>" aria-expanded="false"
                                                aria-controls="ownerFunctions<?= $owner['id'] ?>">
                                                <i class="fas fa-cogs"></i>
                                            </a>
                                            <div class="collapse" id="ownerFunctions<?= $owner['id'] ?>">
                                                <a class="btn btn-success btn-sm btn-accept"
                                                    data-owner-id="<?= $owner['id'] ?>">
                                                    <i class="fas fa-check"></i> Accept
                                                </a>
                                                <a class="btn btn-danger btn-sm btn-delete"
                                                    data-owner-id="<?= $owner['id'] ?>">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                                <a class="btn btn-warning btn-sm btn-deactivate"
                                                    data-owner-id="<?= $owner['id'] ?>">
                                                    <i class="fas fa-ban"></i> Deactivate
                                                </a>
                                            </div>

                        </div>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Custom Script for Owner Actions -->
    <script>
        $(document).ready(function () {
            // Handle accept button click
            $('.btn-accept').on('click', function () {
                var ownerId = $(this).data('owner-id');
                acceptOwner(ownerId);
            });

            // Handle delete button click
            $('.btn-delete').on('click', function () {
                var ownerId = $(this).data('owner-id');
                deleteOwner(ownerId);
            });

            // Handle deactivate button click
            $('.btn-deactivate').on('click', function () {
                var ownerId = $(this).data('owner-id');
                deactivateOwner(ownerId);
            });
        });

        function acceptOwner(ownerId) {
            // Log to the console for debugging purposes
            console.log('Accept button clicked for owner ID:', ownerId);

            // Send a GET request to admin_authorize.php for owner approval
            $.get(`admin_authorize.php?user_id=${ownerId}`, function (response) {
                alert(response);
                // Reload the page after approval
                location.reload();
            }).fail(function (xhr, status, error) {
                console.error('Error approving owner:', error);
                alert('Error approving owner. Please try again.');
            });
        }

        function deleteOwner(ownerId) {
            if (confirm("Are you sure you want to delete this owner?")) {
                // Send an AJAX request to delete the owner
                $.ajax({
                    url: '../admin/delete_owner.php',
                    type: 'POST',
                    data: { ownerId: ownerId },
                    success: function (response) {
                        alert(response);
                        // Reload the page after deletion
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error deleting owner:', error);
                        alert('Error deleting owner. Please try again.');
                    }
                });
            }
        }

        function deactivateOwner(ownerId) {
            // Log to the console for debugging purposes
            console.log('Deactivate button clicked for owner ID:', ownerId);

            // Add logic for deactivating owner with ID ownerId
            alert("Deactivate Owner with ID: " + ownerId);
        }
    </script>
</body>

</html>