<?php

// Database connection
require_once ('php/CreateDb.php');
$database = new CreateDb("shop", "Producttb");

// Get search inputs
$product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$min_price = isset($_GET['min_price']) && $_GET['min_price'] !== '' ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) && $_GET['max_price'] !== '' ? $_GET['max_price'] : 999999;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Current page number
$results_per_page = 10;  // Define how many results you want per page
$start_from = ($page - 1) * $results_per_page;

// SQL query to search for products
$query = "SELECT * FROM Producttb WHERE 1=1";

// Add filters to the query based on search inputs
if (!empty($product_name)) {
    $query .= " AND LOWER(product_name) LIKE LOWER('%" . $database->con->real_escape_string($product_name) . "%')";
}

// Only add category filter if a category is selected
if (!empty($category)) {
    if ($category == 'Best Seller') {
        $query .= " AND is_best_seller = TRUE";
    } elseif ($category == 'Featured') {
        $query .= " AND is_featured = TRUE";
    } else {
        $query .= " AND is_best_seller = FALSE AND is_featured = FALSE";
    }
}

// Only add price range filter if price values are provided
if ($min_price !== '' || $max_price !== '') {
    $query .= " AND product_price BETWEEN " . (float)$min_price . " AND " . (float)$max_price;
}

$query .= " LIMIT $start_from, $results_per_page";

// Debugging: output the query to check if it's correct
// echo "<pre>" . $query . "</pre>";  // Remove this line when the query is correct

// Execute the query
$result = $database->con->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display product information
        echo "<div class='col-md-4 mt-4'>";
        echo "<div class='card'>";
        echo "<img src='" . $row['product_image'] . "' class='card-img-top' alt='Product Image'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['product_name'] . "</h5>";
        echo "<p class='card-text'>" . $row['product_description'] . "</p>";
        echo "<p class='card-text'><strong>Price:</strong> MUR " . $row['product_price'] . "</p>";
        echo "<p class='card-text'><strong>Quantity Available:</strong> " . $row['quantity'] . "</p>";
        echo "<p class='card-text'><strong>Author:</strong> " . $row['author'] . "</p>";
        echo "<p class='card-text'><strong>Date of Publication:</strong> " . $row['date_of_publication'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='col-md-12'><h5>No products found.</h5></div>";
}

// Pagination logic
$total_query = "SELECT COUNT(*) FROM Producttb WHERE 1=1";

// Add the same filters to count the total number of records
if (!empty($product_name)) {
    $total_query .= " AND LOWER(product_name) LIKE LOWER('%" . $database->con->real_escape_string($product_name) . "%')";
}

if (!empty($category)) {
    if ($category == 'Best Seller') {
        $total_query .= " AND is_best_seller = TRUE";
    } elseif ($category == 'Featured') {
        $total_query .= " AND is_featured = TRUE";
    } else {
        $total_query .= " AND is_best_seller = FALSE AND is_featured = FALSE";
    }
}

if ($min_price !== '' || $max_price !== '') {
    $total_query .= " AND product_price BETWEEN " . (float)$min_price . " AND " . (float)$max_price;
}

$total_result = $database->con->query($total_query);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $results_per_page);

// Pagination Links
echo "<div class='col-md-12 text-center mt-5'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='search.php?page=$i";
    if (!empty($product_name)) echo "&product_name=$product_name";
    if (!empty($category)) echo "&category=$category";
    if (!empty($min_price)) echo "&min_price=$min_price";
    if (!empty($max_price)) echo "&max_price=$max_price";
    echo "' class='btn btn-secondary mx-1'>$i</a>";
}
echo "</div>";
?>
