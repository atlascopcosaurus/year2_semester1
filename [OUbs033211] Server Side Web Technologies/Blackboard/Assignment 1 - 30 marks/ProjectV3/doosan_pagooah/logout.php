<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_destroy();

// Redirect to index.php after logging out
header('Location: index.php');
exit();
?>
