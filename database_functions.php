<?php
// includes/database_functions.php

// Include the necessary files
include '../includes/db_connection.php';

function createTables() {
    global $connection;

    // Owners table
    $ownersTable = "CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        store_name VARCHAR(255) NOT NULL,
        address TEXT NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        approved BOOLEAN DEFAULT 0
    )";

    // Menu table
    $menuTable = "CREATE TABLE IF NOT EXISTS menu (
        id INT PRIMARY KEY AUTO_INCREMENT,
        owner_id INT,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2),
        FOREIGN KEY (owner_id) REFERENCES users(id)
    )";

    // Execute queries
    $connection->query($ownersTable);
    $connection->query($menuTable);
}

//display added products
function getMenu($ownerId) {
    global $connection;
    
    // Using prepared statement to avoid SQL injection
    $query = "SELECT product_id, name, description, price FROM products WHERE name = ?";
    
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $ownerId);
    
    $stmt->execute();
    $result = $stmt->get_result();

    $menu = [];
    while ($row = $result->fetch_assoc()) {
        $menu[] = $row;
    }

    $stmt->close();

    return $menu;
}



?>
