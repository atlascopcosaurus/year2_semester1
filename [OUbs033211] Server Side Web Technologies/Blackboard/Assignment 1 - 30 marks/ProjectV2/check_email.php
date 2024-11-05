<?php
// Include your database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare the SQL statement to check if the email exists
    $query = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo '<span style="color:red">Email already registered</span>';
    } else {
        echo '<span style="color:green">Email available</span>';
    }
}
?>
