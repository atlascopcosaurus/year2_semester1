<?php
// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already started
}


// Check if the user is logged in by verifying the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Use the logged-in username
    $role = $_SESSION['role'];  // Fetch the user role from session
} else {
    $username = 'Guest'; // Default to 'Guest' if not logged in
    $role = null; // No role for guest users
}

// Cart count logic
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    $cart_count = count($_SESSION['cart']); // Count the number of items in the cart
}
?>

<header>
    <nav class="no-dark-mode">
        <div class="logo">CloudNext</div>
        <ul>
            <li>Hello, <?php echo htmlspecialchars($username); ?>!</li>
            <li><a href="index_1.php" class="active">Home/</a></li>
            <li><a href="search.php">Ebooks.Catalogue/</a></li>
            <!-- Display the cart count next to the My.Cart link -->
            <li><a href="cart.php">My.Cart (<?php echo $cart_count; ?>)/</a></li>

            <!-- Display login/logout based on session -->
            <?php if ($username !== 'Guest'): ?>
                <li><a href="logout.php">Sign.Out/</a></li>
            <?php else: ?>
                <li><a href="login.html">Sign.In/</a></li>
            <?php endif; ?>

            <!-- Display back office link for superuser -->
            <?php if ($role === 'superuser'): ?>
                <li><a href="backoffice.php" class="back-office"></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
