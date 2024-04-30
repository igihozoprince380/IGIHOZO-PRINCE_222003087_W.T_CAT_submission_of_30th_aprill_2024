<?php
session_start();

// Check if user is logged in and their role is worker
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "worker") {
    header("Location: login.php");
    exit;
}

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "petrol_sales";

// Initialize variables
$success_message = $error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $quantity_sold = $_POST["quantity_sold"];
    $price_per_liter = $_POST["price_per_liter"];
    $sale_date_time = $_POST["sale_date_time"];
    $payment_method = $_POST["payment_method"];
    $product_type = $_POST["product_type"];
    $total_amount = $quantity_sold * $price_per_liter;

    // Insert data into sales table
    $sql = "INSERT INTO sales (quantity_sold, price_per_liter, sale_date_time, payment_method, product_type, total_amount)
            VALUES ('$quantity_sold', '$price_per_liter', '$sale_date_time', '$payment_method', '$product_type', '$total_amount')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Sale record inserted successfully.";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Sale</title>
    <style>
        /* CSS styles */
        body {
            background-color: #6495ED; /* Blue background color */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            margin: 0 auto;
            width: 80%;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sales-history {
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Sale history</h1>
</div>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Your form fields here -->
    </form>

    <?php
    if ($success_message) {
        echo "<p>$success_message</p>";
    }
    if ($error_message) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>
</div>

<div class="sales-history">
    <?php
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
        echo "<div class='container'>";
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
        echo "</div>";
    } else {
        echo "No sales records found";
    }

    mysqli_close($conn);
    ?>
</div>

<div class="footer" style="background-color: #6495ED;">
    <p>&copy; <?php echo date("Y"); ?> Worker Sales</p>
</div>

<script>
    // Your JavaScript code here
</script>

</body>
</html>
