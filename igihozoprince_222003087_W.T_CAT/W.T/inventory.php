<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Inventory</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price per Unit</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "petrol_sales";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to select all data from the product table
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"]. "</td>";
                echo "<td>" . $row["product_name"]. "</td>";
                echo "<td>" . $row["description"]. "</td>";
                echo "<td>$" . $row["price_per_unit"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
