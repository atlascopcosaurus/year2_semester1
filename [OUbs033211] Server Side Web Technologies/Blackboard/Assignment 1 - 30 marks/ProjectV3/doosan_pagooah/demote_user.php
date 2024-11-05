<?php
session_start(); // Start the session

// Include the database connection file
include 'db.php';

// Check if the user is logged in and is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index.php'); // Redirect to the homepage if not a superuser
    exit();
}

$database = new CreateDb();
$conn = $database->con; // Initialize the connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id']; // The user ID you want to demote

    // Update the user's role to 'user'
    $query = $conn->prepare("UPDATE users SET role = 'user' WHERE id = ?");
    $query->bind_param('i', $userId);

    if ($query->execute()) {
        echo "<script>
                alert('User demoted to Normal User successfully!');
                window.location.href = 'dashboard.php'; // Redirect to the dashboard
              </script>";
    } else {
        echo "Error demoting user: " . $conn->error;
    }
}
?>
