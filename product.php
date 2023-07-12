<?php
// Include the database connection file
include('database.php');

// Check if the form has been submitted
if(isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    // Insert the product into the database
    $query = "INSERT INTO products (product_name, product_price, product_description) VALUES ('$product_name', '$product_price', '$product_description')";
    $result = mysqli_query($conn, $query);

    // Check if the product was inserted successfully
    if($result) {
        $message = "Product added successfully.";
    } else {
        $error = "Error adding product.";
    }
}

// Check if a product ID was provided for editing or deleting
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if the form has been submitted for updating or deleting a product
    if(isset($_POST['update'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];

        // Update the product in the database
        $query = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_description='$product_description' WHERE product_id=$product_id";
        $result = mysqli_query($conn, $query);

        // Check if the product was updated successfully
        if($result) {
            $message = "Product updated successfully.";
        } else {
            $error = "Error updating product.";
        }
    } else if(isset($_POST['delete'])) {
        // Delete the product from the database
        $query = "DELETE FROM products WHERE product_id=$product_id";
        $result = mysqli_query($conn, $query);

        // Check if the product was deleted successfully
        if($result) {
            header('Location: product.php');
            exit;
        } else {
            $error = "Error deleting product.";
        }
    } else {
        // Fetch the product from the database
        $query = "SELECT * FROM products WHERE product_id=$product_id";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);
    }
}
 session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
      <!--  <h1>Hello again<h1><?php echo $_SESSION['user'];?></h1></h1>-->
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <?php if(isset($message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <h2>Add Product</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" name="product_name">
            </div>

            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="text" class="form-control" name="product_price">
            </div>

            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <textarea class="form-control" name="product_description"></textarea>
            </div>

            <input type="submit" class="btn btn-success" name="submit" value="Add Product">
        </form>

        <h2>Edit Product</h2>
        <?php if(isset($product)) { ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control" name="product_name" value="<?php echo $product['product_price']; ?>">
                </div>

                <div class="form-group">
                    <label for="product_description">Product Description:</label>
                    <textarea class="form-control" name="product_description"><?php echo $product['product_description']; ?></textarea>
                </div>

                <input type="submit" class="btn btn-success" name="update" value="Update Product">
                <input type="submit" class="btn btn-warning" name="delete" value="Delete Product">
            </form>
        <?php } ?>

        <h2>Products List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all products from the database
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['product_id'];?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo '$'.$row['product_price']; ?></td>
                        <td><?php echo $row['product_description']; ?></td>
                        <td>
                            <a href="product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.
</body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>