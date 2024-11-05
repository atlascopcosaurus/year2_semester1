<?php
session_start(); // Start the session to manage user data across pages

require_once ('php/CreateDb.php'); // Include the file for database creation and connection
require_once ('php/component.php'); // Include the file for reusable components (e.g., cart elements)

$db = new CreateDb("shop", "Producttb"); // Create a new instance of the database class, connecting to 'shop' and 'Producttb' table

// Handle Remove Product
if (isset($_POST['remove'])){ // Check if the 'remove' button is pressed
    if ($_GET['action'] == 'remove'){ // Check if the action parameter is 'remove'
        foreach ($_SESSION['cart'] as $key => $value){ // Loop through the cart items in the session
            if ($value["product_id"] == $_GET['id']){ // If the product ID matches the one in the URL, remove it
                unset($_SESSION['cart'][$key]); // Remove the product from the cart
                echo "<script>alert('Product has been removed from the cart!')</script>"; // Display an alert
                echo "<script>window.location = 'cart.php'</script>"; // Redirect to the cart page
            }
        }
    }
}

// Handle Increase/Decrease Product Quantity
if (isset($_POST['increase'])){ // Check if the 'increase' button is pressed
    foreach ($_SESSION['cart'] as $key => $value){ // Loop through the cart items
        if ($value['product_id'] == $_GET['id']){ // Check if the product ID matches the one in the URL
            $_SESSION['cart'][$key]['quantity'] += 1; // Increase the product quantity by 1
        }
    }
}

if (isset($_POST['decrease'])){ // Check if the 'decrease' button is pressed
    foreach ($_SESSION['cart'] as $key => $value){ // Loop through the cart items
        if ($value['product_id'] == $_GET['id'] && $_SESSION['cart'][$key]['quantity'] > 1){ // Check if product ID matches and quantity is greater than 1
            $_SESSION['cart'][$key]['quantity'] -= 1; // Decrease the product quantity by 1
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding for the page -->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0"> <!-- Ensure responsive scaling on different devices -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Compatibility setting for Internet Explorer -->
    <title>Cart</title> <!-- Title of the page -->

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css"> <!-- Link to custom stylesheet -->

    <link rel="stylesheet" href="css/styles.css"> <!-- Link to additional custom styles -->

    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect to Google Fonts (with CORS) -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet"> <!-- Import custom font -->
</head>
<body class="bg-light"> <!-- Set background color -->

<?php require_once ('php/header.php'); ?> <!-- Include the header -->

<div class="container-fluid">
    <div class="row px-5"> <!-- Define a row with padding -->
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
                $total = 0; // Initialize the total cost

                // Ensure the cart is initialized
                if (!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array(); // Initialize the cart session if not set
                }

                if (!empty($_SESSION['cart'])){ // Check if the cart is not empty
                    $product_id = array_column($_SESSION['cart'], 'product_id'); // Get all product IDs from the cart

                    $result = $db->getData(); // Fetch data from the database
                    while ($row = mysqli_fetch_assoc($result)){ // Loop through each product from the database
                        foreach ($product_id as $id){ // Check each product ID in the cart
                            if ($row['id'] == $id){ // If the product ID matches

                                // Get the product quantity
                                $key = array_search($id, array_column($_SESSION['cart'], 'product_id')); // Find the key for the product in the cart

                                // Check if the product exists in the cart and fetch the quantity
                                if (isset($_SESSION['cart'][$key])) {
                                    $quantity = $_SESSION['cart'][$key]['quantity']; // Set quantity from session data
                                } else {
                                    $quantity = 1; // Default to 1 if not set
                                }

                                // Determine the category: Best Seller, Featured, or Neither
                                if ($row['is_best_seller']) {
                                    $category = "Best Seller"; // Assign Best Seller category
                                } elseif ($row['is_featured']) {
                                    $category = "Featured"; // Assign Featured category
                                } else {
                                    $category = "Main"; // Default category
                                }

                                // Pass additional attributes to the cartElement function
                                cartElement(
                                    $row['product_image'], // Product image
                                    $row['product_name'], // Product name
                                    $row['product_price'], // Product price
                                    $row['id'], // Product ID
                                    $quantity, // Quantity in cart
                                    $row['product_description'], // Product description
                                    $row['author'], // Product author (if applicable)
                                    $row['date_of_publication'], // Publication date (if applicable)
                                    $category, // Product category
                                    $row['quantity']  // Available stock quantity
                                );
                                $total += (int)$row['product_price'] * $quantity; // Calculate the total cost
                            }
                        }
                    }
                }else{
                    echo "<h5>Your cart is empty</h5>"; // Message if the cart is empty
                }
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25"> <!-- Cart summary section -->

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if (isset($_SESSION['cart'])){ // Check if the cart session is set
                            $count  = count($_SESSION['cart']); // Count the number of items in the cart
                            echo "<h6>Price ($count items)</h6>"; // Display the number of items
                        }else{
                            echo "<h6>Price (0 items)</h6>"; // Display 0 if the cart is empty
                        }
                        ?>
                        <h6>Delivery Charges</h6> <!-- Display delivery charges -->
                        <hr>
                        <h6>Amount Payable</h6> <!-- Display the total amount payable -->
                    </div>
                    <div class="col-md-6">
                        <h6>MUR <?php echo $total; ?></h6> <!-- Display the total price -->
                        <h6 class="text-success">FREE</h6> <!-- Display free delivery -->
                        <hr>
                        <h6>MUR <?php echo $total; ?></h6> <!-- Display the total amount payable -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
