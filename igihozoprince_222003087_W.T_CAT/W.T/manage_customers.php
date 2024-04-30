<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px 0;
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
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
            margin-top: 20px;
            color: green;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Add New Customer</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="customer_name">Customer Name:</label><br>
        <input type="text" id="customer_name" name="customer_name" required><br>
        <label for="contact_number">Contact Number:</label><br>
        <input type="text" id="contact_number" name="contact_number" required><br>
        <label for="email_address">Email Address:</label><br>
        <input type="text" id="email_address" name="email_address" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "petrol_sales";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $customer_name = $_POST['customer_name'];
        $contact_number = $_POST['contact_number'];
        $email_address = $_POST['email_address'];

        // Prepare and execute SQL statement to insert data into 'customer' table
        $sql = "INSERT INTO customer (customer_name, contact_number, email_address) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $customer_name, $contact_number, $email_address);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p class='success'>New customer added successfully</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $stmt->error . "</p>";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
