<?php
include 'databasee.php';
$conn = OpenConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check for required fields (if applicable)
    if (empty($_POST['fullName']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing.']);
        exit();
    }



    // Get the POST data from the AJAX request and escape them
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $maritalStatus = $conn->real_escape_string($_POST['maritalStatus']);
    $spouseName = $conn->real_escape_string($_POST['spouseName']);
    $yearsSinceDivorce = (int) $_POST['yearsSinceDivorce'];
    $employmentStatus = $conn->real_escape_string($_POST['employmentStatus']);
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $instituteName = $conn->real_escape_string($_POST['instituteName']);
    $country = $conn->real_escape_string($_POST['country']);
    $state = $conn->real_escape_string($_POST['state']);
    $city = $conn->real_escape_string($_POST['city']);
    $username = $conn->real_escape_string($_POST['username']);
    $referralCode = $conn->real_escape_string($_POST['referralCode']);
    $terms = (int) $_POST['terms'];

    // Check for existing email
    $checkEmailQuery = "SELECT * FROM registration_form WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'The email address is already taken.']);
        exit();
    }

    // Check for existing username
    $checkUsernameQuery = "SELECT * FROM registration_form WHERE username = '$username'";
    $result = $conn->query($checkUsernameQuery);
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'The username is already taken.']);
        exit();
    }

    // Construct the SQL query to insert the data
    $sql = "INSERT INTO registration_form (full_name, email, password, phone, dob, gender, marital_status, spouse_name, years_since_divorce, employment_status, company_name, institute_name, country, state, city, username, referral_code, terms) 
            VALUES ('$fullName', '$email', '$password', '$phone', '$dob', '$gender', '$maritalStatus', '$spouseName', $yearsSinceDivorce, '$employmentStatus', '$companyName', '$instituteName', '$country', '$state', '$city', '$username', '$referralCode', $terms)";

    // Run the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
    }

    // Close the connection
    CloseConn($conn);
}
?>
