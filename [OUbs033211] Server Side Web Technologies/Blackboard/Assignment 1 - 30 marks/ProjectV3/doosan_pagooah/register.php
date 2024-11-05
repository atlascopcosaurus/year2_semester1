<?php
// Include the database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if the username or email already exists in the database
    $query = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $query->bind_param('ss', $username, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // If a user with the same username or email already exists
        echo "<script>
                alert('Username or Email already exists! Please try again with different credentials.');
                window.location.href = 'registration.html'; // Redirect back to registration form
              </script>";
    } else {
        // Default role for all users is 'user' (normal user)
        $role = 'user';

        // Proceed with the registration if username or email doesn't exist
        $query = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('sssssss', $firstName, $lastName, $username, $email, $phone, $password, $role);

        if ($query->execute()) {
            // Upon successful registration, redirect to login.html
            echo "<script>
                    alert('Registration successful! You will be redirected to the login page.');
                    window.location.href = 'login.html';
                  </script>";
        } else {
            // Display error in case of any issue
            echo "Error: " . $conn->error;
        }
    }
}
?>
