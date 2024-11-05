<?php
session_start(); // Start the session

// Include the database connection file
include 'db.php';

// Check if the user is logged in and is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index_1.php'); // Redirect to the homepage if not a superuser
    exit();
}

$database = new CreateDb();
$conn = $database->con; // Initialize the connection

// Fetch all users
$query = $conn->prepare("SELECT id, username, role FROM users");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="backoffice.php">Back Office</a> <!-- Link to Backoffice -->
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout</a> <!-- Logout Link -->
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">User Management</h2>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($user = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <?php if ($user['role'] !== 'superuser'): ?>
                        <form action="promote_user.php" method="POST" class="d-inline">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-success btn-sm">Promote to Superuser</button>
                        </form>
                    <?php else: ?>
                        <form action="demote_user.php" method="POST" class="d-inline">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-warning btn-sm">Demote to User</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
