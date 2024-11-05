<?php
include('php/header.php'); // Include the common header here (e.g., navigation or logo)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding for the HTML document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure proper scaling on mobile devices -->
    <title>Search Products</title> <!-- Set the page title -->

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Link to custom stylesheet -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Google Fonts preconnection for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Import custom font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">
</head>
<body>

<div class="container"> <!-- Main container for content -->
    <h2 class="text-center mt-4">Search Products</h2> <!-- Page heading, centered with margin -->

    <form method="GET" action="search.php" class="mt-3 mb-5"> <!-- Form for product search, GET method sends data to search.php -->
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="product_name" class="form-control" placeholder="Product Name"> <!-- Input for product name -->
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control"> <!-- Dropdown for category selection -->
                    <option value="">Select Category</option> <!-- Default option -->
                    <option value="Best Seller">Best Seller</option> <!-- Option: Best Seller -->
                    <option value="Featured">Featured</option> <!-- Option: Featured -->
                    <option value="Main">Main</option> <!-- Option: Main -->
                </select>
            </div>
            <div class="col-md-4">
                <div class="row"> <!-- Row for price range inputs -->
                    <div class="col-md-6">
                        <input type="number" name="min_price" class="form-control" placeholder="Min Price"> <!-- Input for minimum price -->
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="max_price" class="form-control" placeholder="Max Price"> <!-- Input for maximum price -->
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Search</button> <!-- Submit button for the form -->
        </div>
    </form>

    <div class="row">
        <?php include 'search_results.php'; ?> <!-- Include the search results file to display products after search -->
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> <!-- jQuery for Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->

</body>
</html>
