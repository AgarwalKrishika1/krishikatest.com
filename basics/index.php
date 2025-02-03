<?php
include 'database.php';
$conn = OpenCon();
echo "Connected Successfully<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS employee (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50)
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table Employee created successfully<br>";
    } else {
      echo "Error creating table: " . $conn->error . "<br>";
    }

//insert 
$sql = "INSERT INTO employee (firstname, lastname, email)
VALUES ('k', 'a', 'k@gmail.com')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully in employee<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
//last id
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

//update 
$sql = "UPDATE employee SET lastname='Agarwal' WHERE id=2";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully<br>";
} else {
  echo "Error updating record: " . $conn->error . "<br>";
}

//select
$sql = "SELECT * FROM user_profile";
$result = $conn->query($sql);
echo "User Profile table     ";
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. " City- " . $row["city"]. 
    " age- " . $row["age"]."<br>";
  }
} else {
  echo "0 results";
}
// to select particular number of row 
//enter LIMIT
//and to start from particular entry number
// enter OFFSET (before start)

CloseCon($conn);
?>