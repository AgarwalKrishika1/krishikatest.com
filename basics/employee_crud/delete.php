<?php
include 'db.php';
$conn = OpenConn();
echo "Connected Successfully<br>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM employees WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
