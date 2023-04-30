<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_data";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user's registration details from the form
$name = trim($_POST['name']);
$mobile = trim($_POST['mobile']);
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);

// Validate user inputs
if (empty($name) || empty($mobile) || empty($password) || empty($repassword)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}
// Check if the mobile number has the correct length
if (strlen($mobile) != 10) {
    $error_message = "Mobile number must be 10 digits";
    $response = array("success" => false, "message" => $error_message);
} 

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters.']);
    exit;
}

if ($password !== $repassword) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    exit;
}

// Check if the mobile number already exists in the database
$sql = "SELECT * FROM users_data WHERE mobile_no=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the mobile number already exists, set an error message
    $error_message = "Mobile number already exists";
    $response = array("success" => false, "message" => $error_message);
} else {
    // If the mobile number does not exist, insert the user's details into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users_data (name, mobile_no, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $mobile, $hashed_password);

    if ($stmt->execute()) {
        // If the data is inserted successfully, set a success message
        $success_message = "New user created successfully";
        $response = array("success" => true, "message" => $success_message);
    } else {
        // If there was an error with the query, set an error message
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
        $response = array("success" => false, "message" => $error_message);
    }
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
