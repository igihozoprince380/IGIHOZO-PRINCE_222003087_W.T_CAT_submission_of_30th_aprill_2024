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

// Function to fetch all products
function getAllProducts() {
    $conn = connectDatabase();
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
    $products = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    closeDatabase($conn);
    return $products;
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

// Function to add a new product
function addProduct($product_name, $description, $price_per_unit) {
    $conn = connectDatabase();
    $sql = "INSERT INTO product (product_name, description, price_per_unit) VALUES ('$product_name', '$description', '$price_per_unit')";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    closeDatabase($conn);
    return $success;
}

// Function to update an existing product
function updateProduct($product_id, $product_name, $description, $price_per_unit) {
    $conn = connectDatabase();
    $sql = "UPDATE product SET product_name='$product_name', description='$description', price_per_unit='$price_per_unit' WHERE product_id=$product_id";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    closeDatabase($conn);
    return $success;
}

// Function to delete a product by ID
function deleteProduct($product_id) {
    $conn = connectDatabase();
    $sql = "DELETE FROM product WHERE product_id=$product_id";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    closeDatabase($conn);
    return $success;
}

// Handling add product form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price_per_unit = $_POST['price_per_unit'];
    addProduct($product_name, $description, $price_per_unit);
}

// Handling update product form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_product"])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price_per_unit = $_POST['price_per_unit'];
    updateProduct($product_id, $product_name, $description, $price_per_unit);
}

// Handling delete product request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    deleteProduct($product_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 50px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Inventory</h2>
        <a class="button" href="add_product.php">Add New Product</a>
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price per Unit</th>
                <th>Action</th>
            </tr>
            <?php
            $products = getAllProducts();
            if (!empty($products)) {
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product["product_id"] . "</td>";
                    echo "<td>" . $product["product_name"] . "</td>";
                    echo "<td>" . $product["description"] . "</td>";
                    echo "<td>$" . $product["price_per_unit"] . "</td>";
                    echo "<td><a href='edit_product.php?id=" . $product["product_id"] . "'>Edit</a> | <a href='?action=delete&id=" . $product["product_id"] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
