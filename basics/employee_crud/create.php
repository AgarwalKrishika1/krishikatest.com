<?php
include 'db.php'; 
$conn = OpenConn();
echo "Connected Successfully<br>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (name, position, salary) VALUES ('$name', '$position', '$salary')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
