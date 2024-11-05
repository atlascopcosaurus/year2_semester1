<?php
session_start(); // Start the session

// Include the database connection file
include 'db.php';

// Check if the user is logged in and is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index.php'); // Redirect to the homepage if not a superuser
    exit(); // Stop further script execution
}

$database = new CreateDb();
$conn = $database->con; // Initialize the database connection

// Fetch all users from the database
$query = $conn->prepare("SELECT id, username, role FROM users");
$query->execute(); // Execute the query
$result = $query->get_result(); // Get the result of the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure responsiveness -->
    <title>Admin Dashboard</title> <!-- Set the page title -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- Bootstrap navigation bar -->
    <a class="navbar-brand" href="#">Admin Dashboard</a> <!-- Brand name for the navigation bar -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> <!-- Toggler button for mobile view -->
    </button>
    <div class="collapse navbar-collapse" id="navbarNav"> <!-- Collapse navigation menu -->
        <ul class="navbar-nav ml-auto"> <!-- Align navigation items to the right -->
            <li class="nav-item">
                <a class="nav-link" href="backoffice.php">Back Office</a> <!-- Link to Back Office page -->
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout</a> <!-- Link to logout -->
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5"> <!-- Main container with top margin -->
    <h2 class="text-center mb-4">User Management</h2> <!-- Section heading -->
    <table class="table table-striped"> <!-- Create a Bootstrap table with striped rows -->
        <thead class="thead-dark"> <!-- Dark header for the table -->
        <tr>
            <th scope="col">Username</th> <!-- Table column for username -->
            <th scope="col">Role</th> <!-- Table column for user role -->
            <th scope="col">Actions</th> <!-- Table column for actions (promote/demote) -->
        </tr>
        </thead>
        <tbody>
        <?php while ($user = $result->fetch_assoc()): ?> <!-- Loop through each user fetched from the database -->
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td> <!-- Display the username, escape output with htmlspecialchars -->
                <td><?php echo htmlspecialchars($user['role']); ?></td> <!-- Display the user role, escape output -->
                <td>
                    <?php if ($user['role'] !== 'superuser'): ?> <!-- Check if the user is not already a superuser -->
                        <form action="promote_user.php" method="POST" class="d-inline"> <!-- Form for promoting a user -->
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"> <!-- Hidden input field to send the user ID -->
                            <button type="submit" class="btn btn-success btn-sm">Promote to Superuser</button> <!-- Button to promote the user -->
                        </form>
                    <?php else: ?> <!-- If the user is already a superuser -->
                        <form action="demote_user.php" method="POST" class="d-inline"> <!-- Form for demoting a user -->
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"> <!-- Hidden input field to send the user ID -->
                            <button type="submit" class="btn btn-warning btn-sm">Demote to User</button> <!-- Button to demote the user -->
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?> <!-- End the loop -->
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- Include jQuery for Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <!-- Include Popper.js for Bootstrap tooltips -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Include Bootstrap JS -->
</body>
</html>
