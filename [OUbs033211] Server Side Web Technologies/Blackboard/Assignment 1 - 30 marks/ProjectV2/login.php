<?php
session_start(); // Start the session

// Include your database connection file
include 'db.php';

// Create a new instance of the CreateDb class and initialize the connection
$database = new CreateDb();
$conn = $database->con; // Initialize the connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from the database, including the role
    $query = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store the user ID, username, and role in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];  // Save user role in session

            // Redirect to index.php with a success message
            echo "<script>
                    alert('Login successful! You will be redirected to the homepage.');
                    window.location.href = 'index_1.php';
                  </script>";
            exit();
        } else {
            // If password is incorrect, alert and redirect back to login.html
            echo "<script>
                    alert('Invalid password! Please try again.');
                    window.location.href = 'login.html';
                  </script>";
            exit();
        }
    } else {
        // If username is incorrect, alert and redirect back to login.html
        echo "<script>
                alert('Invalid username! Please try again.');
                window.location.href = 'login.html';
              </script>";
        exit();
    }
}
?>
