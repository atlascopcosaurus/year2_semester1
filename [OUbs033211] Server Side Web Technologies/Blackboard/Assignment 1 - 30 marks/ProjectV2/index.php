<?php
session_start(); // Start the session

// Check if the user is logged in by verifying the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Use the logged-in username
    $role = $_SESSION['role'];  // Fetch the user role from session
} else {
    $username = 'Guest'; // Default to 'Guest' if not logged in
    $role = null; // No role for guest users
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<!-- Greet the user -->
<h1>Hello, <?php echo htmlspecialchars($username); ?>! Welcome to the homepage.</h1>

<!-- Navigation Bar -->
<nav>
    <a href="home.php">Home</a>

    <!-- Show the Backoffice link if the user is a superuser -->
    <?php if ($role === 'superuser'): ?>
        <a href="backoffice.php">Backoffice</a>
    <?php endif; ?>

    <?php if ($username !== 'Guest'): ?>
        <!-- If user is logged in, show logout link -->
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <!-- If user is not logged in, show login link -->
        <a href="login.html">Login</a>
    <?php endif; ?>
</nav>
</body>
</html>
