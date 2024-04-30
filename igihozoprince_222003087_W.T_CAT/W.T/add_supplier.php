<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
    <style>
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
        .add-supplier {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Manage Suppliers</h2>
    <table>
        <thead>
            <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Diesel Quantity Delivered</th>
                <th>Premium Quantity Delivered</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root"; // Your MySQL username
            $password = ""; // Your MySQL password
            $dbname = "petrol_sales";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from supplier table
            $sql = "SELECT * FROM supplier";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["supplier_id"] . "</td>";
                    echo "<td>" . $row["supplier_name"] . "</td>";
                    echo "<td>" . $row["contact_number"] . "</td>";
                    echo "<td>" . $row["email_address"] . "</td>";
                    echo "<td>" . $row["diesel_quantity_delivered"] . "</td>";
                    echo "<td>" . $row["premium_quantity_delivered"] . "</td>";
                    echo "<td><a href='edit_supplier.php?id=" . $row["supplier_id"] . "'>Edit</a> | <a href='delete_supplier.php?id=" . $row["supplier_id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No suppliers found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <div class="add-supplier">
        <h2>Add Supplier</h2>
        <form action="insert_supplier.php" method="POST">
            <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" required><br><br>
            
            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number"><br><br>
            
            <label for="email_address">Email Address:</label>
            <input type="email" id="email_address" name="email_address"><br><br>
            
            <label for="diesel_quantity">Diesel Quantity Delivered:</label>
            <input type="number" id="diesel_quantity" name="diesel_quantity" step="0.01" value="0"><br><br>
            
            <label for="premium_quantity">Premium Quantity Delivered:</label>
            <input type="number" id="premium_quantity" name="premium_quantity" step="0.01" value="0"><br><br>
            
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
