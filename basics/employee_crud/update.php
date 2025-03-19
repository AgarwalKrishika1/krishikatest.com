<?php
include 'db.php';
$conn = OpenConn();
echo "Connected Successfully<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name='$name', position='$position', salary='$salary' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
