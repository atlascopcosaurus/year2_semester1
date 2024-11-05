<?php
include('php/header.php'); // Include the common header here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">
</head>
<body>



<div class="container">
    <h2 class="text-center mt-4">Search Products</h2>
    <form method="GET" action="search.php" class="mt-3 mb-5">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="product_name" class="form-control" placeholder="Product Name">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">Select Category</option>
                    <option value="Best Seller">Best Seller</option>
                    <option value="Featured">Featured</option>
                    <option value="Main">Main</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <input type="number" name="min_price" class="form-control" placeholder="Min Price">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="max_price" class="form-control" placeholder="Max Price">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="row">
        <?php include 'search_results.php'; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
