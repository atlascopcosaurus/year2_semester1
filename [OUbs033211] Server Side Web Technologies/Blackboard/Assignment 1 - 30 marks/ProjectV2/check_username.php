<?php
// Include your database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Prepare the SQL statement to check if the username exists
    $query = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        echo '<span style="color:red">Username already taken</span>';
    } else {
        echo '<span style="color:green">Username available</span>';
    }
}
?>
