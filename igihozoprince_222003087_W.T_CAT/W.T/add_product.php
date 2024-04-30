<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 40px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
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
    <h1>Product Management</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="productName">Product Name:</label><br>
        <input type="text" id="productName" name="productName" required><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br>
        <label for="price">Price per Unit:</label><br>
        <input type="text" id="price" name="price" required><br><br>
        <input type="submit" value="Add Product">
    </form>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petrol_sales";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // If form is submitted, insert values into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $productName = $_POST['productName'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Prepare and bind the parameters
        $stmt = $conn->prepare("INSERT INTO product (product_name, description, price_per_unit) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $productName, $description, $price);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p>New product added successfully</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
