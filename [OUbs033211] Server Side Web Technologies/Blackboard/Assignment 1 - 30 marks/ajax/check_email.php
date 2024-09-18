<?php
// Assuming you have a database connection established
include 'connect.php';
if (isset($_POST['email'])) {
  $email = $_POST['email'];

  // Perform a query to check if the email already exists in the database
  $query = "SELECT * FROM student WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  $response1 = array();
if ($result->num_rows > 0) {
    $response1["exists"] = true;
	
} else {
    $response1["exists"] = false;
}

$conn->close();
echo json_encode($response1);
}
?>