<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
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
        <h2>Add Supplier</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" required>
            
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number">
            
            <label for="email_address">Email Address:</label>
            <input type="email" id="email_address" name="email_address">
            
            <label for="diesel_quantity">Diesel Quantity Delivered:</label>
            <input type="number" id="diesel_quantity" name="diesel_quantity" step="0.01" value="0">
            
            <label for="premium_quantity">Premium Quantity Delivered:</label>
            <input type="number" id="premium_quantity" name="premium_quantity" step="0.01" value="0">
            
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root"; // Your MySQL username
        $password = ""; // Your MySQL password
        $dbname = "petrol_sales";

        // Check if the form is submitted
        if(isset($_POST['submit'])) {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL statement
            $sql = "INSERT INTO supplier (supplier_name, contact_number, email_address, diesel_quantity_delivered, premium_quantity_delivered)
                    VALUES (?, ?, ?, ?, ?)";

            // Bind parameters and execute the statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssd", $supplier_name, $contact_number, $email_address, $diesel_quantity, $premium_quantity);

            // Set parameters and execute
            $supplier_name = $_POST['supplier_name'];
            $contact_number = $_POST['contact_number'];
            $email_address = $_POST['email_address'];
            $diesel_quantity = $_POST['diesel_quantity'];
            $premium_quantity = $_POST['premium_quantity'];

            if ($stmt->execute()) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
