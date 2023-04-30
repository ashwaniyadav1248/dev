<?php
// Start the session
session_start();

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

// Get the user's login details from the form
$mobile = $_POST['mobile'];
$password = $_POST['password'];

// Check if the mobile number exists in the database
$sql = "SELECT * FROM users_data WHERE mobile_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mobile);
$stmt->execute();
$result = $stmt->get_result();

// Check if the mobile number has the correct length
if (strlen($mobile) != 10) {
    $error_message = "Mobile number must be 10 digits";
    $response = array("success" => false, "message" => $error_message);
} 

if ($result->num_rows == 1) {
  // If the mobile number exists, check if the password is correct
  $row = $result->fetch_assoc();
  $hashed_password = $row['password'];

  if (password_verify($password, $hashed_password)) {
    // If the password is correct, set the session variables and return a JSON response
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $response = array("success" => true);
  } else {
    // If the password is incorrect, return an error message
    $error_message = "Invalid mobile number or password";
    $response = array("success" => false, "message" => $error_message);
  }
} else {
  // If the mobile number does not exist, return an error message
  $error_message = "Invalid mobile number or password";
  $response = array("success" => false, "message" => $error_message);
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$stmt->close();
$conn->close();
?>
