<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "petrol_sales";

// Function to establish database connection
function connectDatabase() {
    global $servername, $username, $password, $database;
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Function to close database connection
function closeDatabase($conn) {
    mysqli_close($conn);
}

// Function to get product details by ID
function getProductByID($product_id) {
    $conn = connectDatabase();
    $sql = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
    closeDatabase($conn);
    return $product;
}

// Handling form submission for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_product"])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price_per_unit = $_POST['price_per_unit'];

    $conn = connectDatabase();
    $sql = "UPDATE product SET product_name='$product_name', description='$description', price_per_unit='$price_per_unit' WHERE product_id=$product_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // Redirect to product list after successful update
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
    closeDatabase($conn);
}

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $product = getProductByID($product_id);
    if (!$product) {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Product ID is missing!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 50px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>
            <label for="price_per_unit">Price per Unit:</label>
            <input type="text" id="price_per_unit" name="price_per_unit" value="<?php echo $product['price_per_unit']; ?>" required>
            <input type="submit" name="edit_product" value="Update Product">
        </form>
    </div>
</body>
</html>
