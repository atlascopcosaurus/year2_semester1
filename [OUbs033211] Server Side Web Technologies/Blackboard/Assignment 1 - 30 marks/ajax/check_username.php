<?php
// Assuming you have a database connection established
include 'connect.php';
if (isset($_POST['username'])) {
  $username = $_POST['username'];

  // Perform a query to check if the username already exists in the database
  $query = "SELECT * FROM student WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  $response = array();
if ($result->num_rows > 0) {
    $response["exists"] = true;
	
} else {
    $response["exists"] = false;
}

$conn->close();
echo json_encode($response);
}
?>