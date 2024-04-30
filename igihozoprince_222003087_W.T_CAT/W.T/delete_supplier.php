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

// Function to delete a supplier by ID
function deleteSupplier($supplier_id) {
    $conn = connectDatabase();
    $sql = "DELETE FROM supplier WHERE supplier_id=$supplier_id";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    closeDatabase($conn);
    return $success;
}

// Handling delete supplier request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $supplier_id = $_GET['id'];
    $success = deleteSupplier($supplier_id);
    if ($success) {
        header("Location: manage_supplier.php");
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supplier</title>
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

        .button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Supplier</h2>
        <p>Are you sure you want to delete this supplier?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button class="button" type="submit">Delete</button>
            <a class="button" href="manage_supplier.php">Cancel</a>
        </form>
    </div>
</body>
</html>
