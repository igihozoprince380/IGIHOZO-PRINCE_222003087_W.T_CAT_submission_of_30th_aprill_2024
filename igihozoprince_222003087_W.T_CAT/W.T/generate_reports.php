<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History Report</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 50px;
        }

        .error {
            color: red;
            margin-top: 20px;
        }

        .download-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
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
        // Initialize CSV data
        $csv_data = "Quantity Sold,Price per Liter ($),Sale Date Time,Payment Method,Total Amount,Product Type\n";
        
        while($row = mysqli_fetch_assoc($result)) {
            // Append each row to CSV data
            $csv_data .= "{$row['quantity_sold']},{$row['price_per_liter']},{$row['sale_date_time']},{$row['payment_method']},{$row['total_amount']},{$row['product_type']}\n";
        }

        // Close database connection
        mysqli_close($conn);
        
        // Set headers for CSV file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sales_history.csv"');

        // Output CSV data to browser
        echo $csv_data;
    } else {
        $error_message = "No sales records found";
    }

    // Display error message if applicable
    if ($error_message) {
        echo "<p class='error'>$error_message</p>";
    }
    ?>

    <!-- Button to download report -->
    <a class="download-btn" href="javascript:void(0);" onclick="downloadSalesReport()">Download Sales Report</a>

    <!-- JavaScript function to trigger the download -->
    <script>
        function downloadSalesReport() {
            // Redirect to this page to trigger download
            window.location.href = "sales_report.php";
        }
    </script>
</body>
</html>
