<?php
include 'database.php';
$conn = OpenCon();
echo "Connected Successfully<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS order_item (
    order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    quantity INT,
    created_at TIMESTAMP,
    deleted_at TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table User created successfully<br>";
    } else {
      echo "Error creating table: " . $conn->error . "<br>";
    }

CloseCon($conn);
?>