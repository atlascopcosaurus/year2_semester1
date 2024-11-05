<?php
// Include your database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection using the database object

if (isset($_POST['email'])) { // Check if the email field is set in the POST request
    $email = $_POST['email']; // Get the email value from the form

    // Prepare the SQL statement to check if the email exists in the 'users' table
    $query = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $query->bind_param('s', $email); // Bind the email parameter to the query (type 's' for string)
    $query->execute(); // Execute the query
    $result = $query->get_result(); // Get the result of the query

    if ($result->num_rows > 0) { // If the number of rows is greater than 0, the email is already registered
        echo '<span style="color:red">Email already registered</span>'; // Display a red message indicating email is taken
    } else { // If no rows were found, the email is available
        echo '<span style="color:green">Email available</span>'; // Display a green message indicating email is available
    }
}
?>
