<?php
session_start();

require_once ('php/CreateDb.php');
require_once ('php/component.php');

$db = new CreateDb("shop", "Producttb");

// Handle Remove Product
if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if ($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been removed from the cart!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}

// Handle Increase/Decrease Product Quantity
if (isset($_POST['increase'])){
    foreach ($_SESSION['cart'] as $key => $value){
        if ($value['product_id'] == $_GET['id']){
            $_SESSION['cart'][$key]['quantity'] += 1;
        }
    }
}

if (isset($_POST['decrease'])){
    foreach ($_SESSION['cart'] as $key => $value){
        if ($value['product_id'] == $_GET['id'] && $_SESSION['cart'][$key]['quantity'] > 1){
            $_SESSION['cart'][$key]['quantity'] -= 1;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
          rel="stylesheet">

</head>
<body class="bg-light">

<?php require_once ('php/header.php'); ?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>

                <?php
                $total = 0;

                // Ensure the cart is initialized
                if (!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array();
                }

                if (!empty($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');

                    $result = $db->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($product_id as $id){
                            if ($row['id'] == $id){
                                // Get the product quantity
                                $key = array_search($id, array_column($_SESSION['cart'], 'product_id'));

                                // Check if the product exists in the cart and fetch the quantity
                                if (isset($_SESSION['cart'][$key])) {
                                    $quantity = $_SESSION['cart'][$key]['quantity'];
                                } else {
                                    $quantity = 1; // Default to 1 if not set
                                }

                                // Determine the category: Best Seller, Featured, or Neither
                                if ($row['is_best_seller']) {
                                    $category = "Best Seller";
                                } elseif ($row['is_featured']) {
                                    $category = "Featured";
                                } else {
                                    $category = "Main";
                                }

                                // Pass additional attributes to the cartElement function
                                cartElement(
                                    $row['product_image'],
                                    $row['product_name'],
                                    $row['product_price'],
                                    $row['id'],
                                    $quantity,
                                    $row['product_description'],
                                    $row['author'],
                                    $row['date_of_publication'],
                                    $category,
                                    $row['quantity']  // Available quantity
                                );
                                $total += (int)$row['product_price'] * $quantity;
                            }
                        }
                    }
                }else{
                    echo "<h5>Your cart is empty</h5>";
                }
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if (isset($_SESSION['cart'])){
                            $count  = count($_SESSION['cart']);
                            echo "<h6>Price ($count items)</h6>";
                        }else{
                            echo "<h6>Price (0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>MUR <?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>MUR <?php echo $total; ?></h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
