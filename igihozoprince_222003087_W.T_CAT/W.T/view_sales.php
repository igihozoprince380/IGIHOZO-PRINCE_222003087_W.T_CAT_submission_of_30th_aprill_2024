<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "petrol_sales";

// Initialize variables
$error_message = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all sales records
$sql = "SELECT * FROM sales";
$result = mysqli_query($conn, $sql);

// Check if there are any sales records
if (mysqli_num_rows($result) > 0) {
    // Display sales records in a table
    echo "<h2>Sales History</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Quantity Sold</th><th>Price per Liter ($)</th><th>Sale Date Time</th><th>Payment Method</th><th>Total Amount</th><th>Product Type</th></tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["quantity_sold"] . "</td>";
        echo "<td>" . $row["price_per_liter"] . "</td>";
        echo "<td>" . $row["sale_date_time"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["total_amount"] . "</td>";
        echo "<td>" . $row["product_type"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    $error_message = "No sales records found";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: greenyellow; /* Green-yellow background color */
        }

        table {
            width: 80%;
            margin: 20px auto;
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

        h2 {
            text-align: center;
            margin-top: 50px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <?php
    if ($error_message) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
</body>
</html>
