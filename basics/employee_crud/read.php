<?php
include 'db.php';
$conn = OpenConn();

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    
    $employees = array();
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
    echo json_encode($employees);
} else {
    echo json_encode([]);
}

$conn->close();
?>
