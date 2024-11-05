<?php
session_start(); // Start the session

// Ensure the user is a superuser
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superuser') {
    header('Location: index.php'); // Redirect if not superuser
    exit();
}

include 'db.php'; // Include database connection
$database = new CreateDb();
$conn = $database->con;

$errors = []; // Array to hold validation errors

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_best_seller = isset($_POST['is_best_seller']) ? 1 : 0;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    // Check for exclusive categories (can't be both bestseller and featured)
    if ($is_best_seller && $is_featured) {
        $errors[] = "A product cannot be both a bestseller and featured. Please select only one or none.";
    }

    if (empty($errors)) {
        if (isset($_POST['create'])) {
            // Create new product
            $name = $_POST['product_name'];
            $price = $_POST['product_price'];
            $description = $_POST['product_description'];
            $quantity = $_POST['quantity'];
            $author = $_POST['author'];
            $date_of_publication = $_POST['date_of_publication'];

            // Handle image upload
            $image = $_FILES['product_image']['name'];
            $target = "./images/books/" . basename($image);
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
                // Insert product with image
                $stmt = $conn->prepare("INSERT INTO Producttb (product_name, product_price, product_description, product_image, quantity, author, date_of_publication, is_best_seller, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                // Bind author as a string ('s')
                $stmt->bind_param("sdssissii", $name, $price, $description, $target, $quantity, $author, $date_of_publication, $is_best_seller, $is_featured);
                $stmt->execute();
            }
        } elseif (isset($_POST['update'])) {
            // Update product
            $id = $_POST['product_id'];
            $name = $_POST['product_name'];
            $price = $_POST['product_price'];
            $description = $_POST['product_description'];
            $quantity = $_POST['quantity'];
            $author = $_POST['author'];
            $date_of_publication = $_POST['date_of_publication'];
            $is_best_seller = isset($_POST['is_best_seller']) ? 1 : 0;
            $is_featured = isset($_POST['is_featured']) ? 1 : 0;

            // Handle image update
            if (!empty($_FILES['product_image']['name'])) {
                $image = $_FILES['product_image']['name'];
                $target = "./images/books/" . basename($image);
                move_uploaded_file($_FILES['product_image']['tmp_name'], $target);

                // Update query with image
                $stmt = $conn->prepare("UPDATE Producttb SET product_name=?, product_price=?, product_description=?, product_image=?, quantity=?, author=?, date_of_publication=?, is_best_seller=?, is_featured=? WHERE id=?");
                $stmt->bind_param("sdsssssiii", $name, $price, $description, $target, $quantity, $author, $date_of_publication, $is_best_seller, $is_featured, $id);
            } else {
                // Update without image
                $stmt = $conn->prepare("UPDATE Producttb SET product_name=?, product_price=?, product_description=?, quantity=?, author=?, date_of_publication=?, is_best_seller=?, is_featured=? WHERE id=?");
                $stmt->bind_param("sdsssssii", $name, $price, $description, $quantity, $author, $date_of_publication, $is_best_seller, $is_featured, $id);
            }

            $stmt->execute();
        } elseif (isset($_POST['delete'])) {
            // Delete product
            $id = $_POST['product_id'];
            $stmt = $conn->prepare("DELETE FROM Producttb WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
}

// Fetch products
$products = $conn->query("SELECT * FROM Producttb");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                <a class="nav-link" href="backoffice.php">Backoffice</a> <!-- Link to Dashboard -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a> <!-- Logout -->
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Product Management</h2>

    <!-- Display Errors -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Create Product Form -->
    <div class="card mb-5">
        <div class="card-header">Create Product</div>
        <div class="card-body">
            <form action="product_management.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Product Name:</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Price:</label>
                        <input type="number" step="0.01" name="product_price" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description:</label>
                        <textarea name="product_description" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Author:</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date of Publication:</label>
                        <input type="date" name="date_of_publication" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Product Image:</label>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Best Seller:</label>
                        <input type="checkbox" name="is_best_seller" value="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Featured:</label>
                        <input type="checkbox" name="is_featured" value="1">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="create" class="btn btn-success">Create Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product List -->
    <h4>Manage Products</h4>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Author</th>
            <th>Date of Publication</th>
            <th>Best Seller</th>
            <th>Featured</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($product = $products->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['product_price']); ?></td>
                <td><?php echo htmlspecialchars($product['product_description']); ?></td>
                <td><img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" style="width: 100px;"></td>
                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                <td><?php echo htmlspecialchars($product['author']); ?></td> <!-- Author displayed correctly -->
                <td><?php echo htmlspecialchars($product['date_of_publication']); ?></td>
                <td><?php echo $product['is_best_seller'] ? 'Yes' : 'No'; ?></td>
                <td><?php echo $product['is_featured'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <form action="product_management.php" method="POST" class="d-inline">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal<?php echo $product['id']; ?>">Edit</button>
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?php echo $product['id']; ?>">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="product_management.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Product Name:</label>
                                        <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Price:</label>
                                        <input type="number" step="0.01" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Description:</label>
                                        <textarea name="product_description" class="form-control" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Quantity:</label>
                                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Author:</label> <!-- Ensure the author value is being updated -->
                                        <input type="text" name="author" value="<?php echo htmlspecialchars($product['author']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Date of Publication:</label>
                                        <input type="date" name="date_of_publication" value="<?php echo htmlspecialchars($product['date_of_publication']); ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Product Image:</label>
                                        <input type="file" name="product_image" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Best Seller:</label>
                                        <input type="checkbox" name="is_best_seller" value="1" <?php echo $product['is_best_seller'] ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Featured:</label>
                                        <input type="checkbox" name="is_featured" value="1" <?php echo $product['is_featured'] ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
