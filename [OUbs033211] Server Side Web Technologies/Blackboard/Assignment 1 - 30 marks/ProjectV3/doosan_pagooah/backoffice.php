<?php
session_start(); // Start the session to access session variables

// Include the database connection file
include 'db.php';

// Check if the user is logged in and is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index.php'); // Redirect to the homepage if not a superuser
    exit(); // Ensure no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding for the HTML document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure proper scaling on mobile devices -->
    <title>Backoffice</title> <!-- Set the title of the webpage -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> <!-- Include Bootstrap CSS for styling -->
</head>
<body>
<div class="container mt-5"> <!-- Create a container with a top margin -->
    <div class="card shadow"> <!-- Add a shadowed card for content -->
        <div class="card-header bg-primary text-white text-center"> <!-- Add a card header with background color and text centering -->
            <h2>Welcome to the Backoffice, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2> <!-- Display a welcome message with the username from the session, using htmlspecialchars to prevent XSS attacks -->
        </div>
        <div class="card-body text-center"> <!-- Create the main content area and center the text -->
            <div class="row justify-content-center"> <!-- Create a row with centered columns -->
                <div class="col-md-4"> <!-- Create a column for Product Management -->
                    <form action="product_management.php" method="GET"> <!-- Form for redirecting to the Product Management page -->
                        <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Product Management</button> <!-- Submit button for Product Management -->
                    </form>
                </div>
                <div class="col-md-4"> <!-- Create a column for User Management -->
                    <form action="dashboard.php" method="GET"> <!-- Form for redirecting to the User Management page -->
                        <button type="submit" class="btn btn-outline-success btn-lg btn-block">User Management</button> <!-- Submit button for User Management -->
                    </form>
                </div>
                <div class="col-md-4"> <!-- Create a column for Order Management -->
                    <form action="order_management.php" method="GET"> <!-- Form for redirecting to the Order Management page -->
                        <button type="submit" class="btn btn-outline-warning btn-lg btn-block">Order Management</button> <!-- Submit button for Order Management -->
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer text-center"> <!-- Create a footer for the card with centered text -->
            <a href="index.php" class="btn btn-secondary">Return to Home</a> <!-- Link back to the homepage -->
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> <!-- Include jQuery for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> <!-- Include Popper.js for Bootstrap tooltips -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- Include Bootstrap JS -->
</body>
</html>
