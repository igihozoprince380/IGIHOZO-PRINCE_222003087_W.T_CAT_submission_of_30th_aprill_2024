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

// Function to fetch supplier details by ID
function getSupplierByID($supplier_id) {
    $conn = connectDatabase();
    $sql = "SELECT * FROM supplier WHERE supplier_id = $supplier_id";
    $result = mysqli_query($conn, $sql);
    $supplier = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $supplier = mysqli_fetch_assoc($result);
    }
    closeDatabase($conn);
    return $supplier;
}

// Function to update supplier information
function updateSupplier($supplier_id, $supplier_name, $contact_number, $email_address, $diesel_quantity, $premium_quantity) {
    $conn = connectDatabase();
    $sql = "UPDATE supplier SET supplier_name='$supplier_name', contact_number='$contact_number', email_address='$email_address', diesel_quantity_delivered='$diesel_quantity', premium_quantity_delivered='$premium_quantity' WHERE supplier_id=$supplier_id";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    closeDatabase($conn);
    return $success;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $diesel_quantity = $_POST['diesel_quantity'];
    $premium_quantity = $_POST['premium_quantity'];
    $success = updateSupplier($supplier_id, $supplier_name, $contact_number, $email_address, $diesel_quantity, $premium_quantity);
    if ($success) {
        header("Location: manage_supplier.php");
        exit;
    }
}

// Retrieve supplier details if ID is provided
$supplier_id = isset($_GET['id']) ? $_GET['id'] : null;
if ($supplier_id) {
    $supplier = getSupplierByID($supplier_id);
    if (!$supplier) {
        echo "Supplier not found.";
        exit;
    }
} else {
    echo "Supplier ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
</head>
<body>
    <h2>Edit Supplier</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="supplier_id" value="<?php echo $supplier['supplier_id']; ?>">
        <label for="supplier_name">Supplier Name:</label>
        <input type="text" id="supplier_name" name="supplier_name" value="<?php echo $supplier['supplier_name']; ?>" required><br><br>
        
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $supplier['contact_number']; ?>"><br><br>
        
        <label for="email_address">Email Address:</label>
        <input type="email" id="email_address" name="email_address" value="<?php echo $supplier['email_address']; ?>"><br><br>
        
        <label for="diesel_quantity">Diesel Quantity Delivered:</label>
        <input type="number" id="diesel_quantity" name="diesel_quantity" step="0.01" value="<?php echo $supplier['diesel_quantity_delivered']; ?>"><br><br>
        
        <label for="premium_quantity">Premium Quantity Delivered:</label>
        <input type="number" id="premium_quantity" name="premium_quantity" step="0.01" value="<?php echo $supplier['premium_quantity_delivered']; ?>"><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
