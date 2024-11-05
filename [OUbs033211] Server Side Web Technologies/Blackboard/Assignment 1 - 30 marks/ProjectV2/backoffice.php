<?php
session_start(); // Start the session

// Include the database connection file
include 'db.php';

// Check if the user is logged in and is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index_1.php'); // Redirect to the homepage if not a superuser
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2>Welcome to the Backoffice, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        </div>
        <div class="card-body text-center">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="product_management.php" method="GET">
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Product Management</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="dashboard.php" method="GET">
                        <button type="submit" class="btn btn-outline-success btn-lg btn-block">User Management</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form action="order_management.php" method="GET">
                        <button type="submit" class="btn btn-outline-warning btn-lg btn-block">Order Management</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="index_1.php" class="btn btn-secondary">Return to Home</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
