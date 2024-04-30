User
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
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .footer {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Add New Sale</h1>
</div>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="quantity_sold">Quantity Sold:</label><br>
        <input type="number" id="quantity_sold" name="quantity_sold" required><br>

        <label for="price_per_liter">Price per Liter ($):</label><br>
        <input type="number" id="price_per_liter" name="price_per_liter" step="0.01" min="0" required oninput="calculateTotalAmount()"><br>

        <label for="sale_date_time">Sale Date Time:</label><br>
        <input type="datetime-local" id="sale_date_time" name="sale_date_time" required><br>

        <label for="payment_method">Payment Method:</label><br>
        <select id="payment_method" name="payment_method">
            <option value="momo">Mobile Money</option>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
        </select><br>

        <label for="total_amount">Total Amount:</label><br>
        <input type="text" id="total_amount" name="total_amount" readonly><br>

        <label for="product_type">Product Type:</label><br>
        <select id="product_type" name="product_type">
            <option value="premium">Premium</option>
            <option value="diesel">Diesel</option>
        </select><br>

        <input type="submit" value="Add Sale">
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

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Worker Sales</p>
</div>

<script>
    function calculateTotalAmount() {
        var quantitySold = parseFloat(document.getElementById("quantity_sold").value);
        var pricePerLiter = parseFloat(document.getElementById("price_per_liter").value);
        var totalAmount = (quantitySold * pricePerLiter).toFixed(2);
        document.getElementById("total_amount").value = totalAmount;
    }
</script>

</body>
</html>