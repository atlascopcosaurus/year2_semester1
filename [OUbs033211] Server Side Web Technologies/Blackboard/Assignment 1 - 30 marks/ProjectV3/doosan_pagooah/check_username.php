<?php
// Include your database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection using the database object

if (isset($_POST['username'])) { // Check if the 'username' field is set in the POST request
    $username = $_POST['username']; // Get the username value from the form

    // Prepare the SQL statement to check if the username exists in the 'users' table
    $query = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $query->bind_param('s', $username); // Bind the username parameter to the query (type 's' for string)
    $query->execute(); // Execute the query
    $result = $query->get_result(); // Get the result of the query

    if ($result->num_rows > 0) { // If the number of rows is greater than 0, the username is already taken
        echo '<span style="color:red">Username already taken</span>'; // Display a red message indicating the username is taken
    } else { // If no rows were found, the username is available
        echo '<span style="color:green">Username available</span>'; // Display a green message indicating the username is available
    }
}
?>
