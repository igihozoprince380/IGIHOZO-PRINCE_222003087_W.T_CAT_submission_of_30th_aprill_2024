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

// Function to fetch all suppliers
function getAllSuppliers() {
    $conn = connectDatabase();
    $sql = "SELECT * FROM supplier";
    $result = mysqli_query($conn, $sql);
    $suppliers = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    }
    closeDatabase($conn);
    return $suppliers;
}

// Function to add a new supplier
function addSupplier($supplier_name, $contact_number, $email_address, $diesel_quantity, $premium_quantity) {
    $conn = connectDatabase();
    $sql = "INSERT INTO supplier (supplier_name, contact_number, email_address, diesel_quantity_delivered, premium_quantity_delivered) 
            VALUES ('$supplier_name', '$contact_number', '$email_address', '$diesel_quantity', '$premium_quantity')";
    $success = false;
    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
    // Add the supplier's data to the inventory management system
    if ($success) {
        $inventory_conn = connectDatabase();
        $sql_inventory = "INSERT INTO inventory (product_name, description, price_per_unit) 
                          VALUES ('$supplier_name', 'Supplier: $supplier_name', 0)";
        mysqli_query($inventory_conn, $sql_inventory);
        closeDatabase($inventory_conn);
    }
    closeDatabase($conn);
    return $success;
}

// Handling add supplier form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $supplier_name = $_POST['supplier_name'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $diesel_quantity = $_POST['diesel_quantity'];
    $premium_quantity = $_POST['premium_quantity'];
    addSupplier($supplier_name, $contact_number, $email_address, $diesel_quantity, $premium_quantity);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
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
        <h2>Manage Suppliers</h2>
        <a class="button" href="add_supplier.php">Add New Supplier</a>
        <br><br>
        <table>
            <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Diesel Quantity Delivered</th>
                <th>Premium Quantity Delivered</th>
                <th>Action</th>
            </tr>
            <?php
            $suppliers = getAllSuppliers();
            if (!empty($suppliers)) {
                foreach ($suppliers as $supplier) {
                    echo "<tr>";
                    echo "<td>" . $supplier["supplier_id"] . "</td>";
                    echo "<td>" . $supplier["supplier_name"] . "</td>";
                    echo "<td>" . $supplier["contact_number"] . "</td>";
                    echo "<td>" . $supplier["email_address"] . "</td>";
                    echo "<td>" . $supplier["diesel_quantity_delivered"] . "</td>";
                    echo "<td>" . $supplier["premium_quantity_delivered"] . "</td>";
                    echo "<td><a href='edit_supplier.php?id=" . $supplier["supplier_id"] . "'>Edit</a> | <a href='delete_supplier.php?id=" . $supplier["supplier_id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No suppliers found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
