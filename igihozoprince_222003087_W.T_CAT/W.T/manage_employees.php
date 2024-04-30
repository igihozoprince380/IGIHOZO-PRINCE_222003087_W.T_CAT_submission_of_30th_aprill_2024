<?php
// Check if the form is submitted for adding a new worker
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_worker"])) {
    // Establish database connection
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $database = "petrol_sales";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data if available
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $contact = isset($_POST["contact"]) ? $_POST["contact"] : "";

    // Hash the password (if applicable)
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Prepare and execute SQL query to insert new worker into the database
    $sql = "INSERT INTO users (username, password_hash, role, full_name, email, contact_number) 
            VALUES ('$username', '$password_hash', 'worker', '$fullname', '$email', '$contact')";

    if ($conn->query($sql) === TRUE) {
        echo "New worker added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}

// Check if the form is submitted for updating a worker
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_worker"])) {
    // Establish database connection
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $database = "petrol_sales";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data if available
    $worker_id = isset($_POST["worker_id"]) ? $_POST["worker_id"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $contact = isset($_POST["contact"]) ? $_POST["contact"] : "";

    // Prepare and execute SQL query to update the worker in the database
    $sql = "UPDATE users SET username='$username', full_name='$fullname', email='$email', contact_number='$contact' WHERE user_id=$worker_id";

    if ($conn->query($sql) === TRUE) {
        echo "Worker updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}

// Check if the form is submitted for deleting a worker
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_worker"])) {
    // Establish database connection
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $database = "petrol_sales";

    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve worker ID to delete
    $worker_id = isset($_POST["worker_id"]) ? $_POST["worker_id"] : "";

    // Prepare and execute SQL query to delete the worker from the database
    $sql = "DELETE FROM users WHERE user_id=$worker_id";

    if ($conn->query($sql) === TRUE) {
        echo "Worker deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Workers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
        .action-buttons {
            display: inline;
        }
    </style>
</head>
<body>
    <h2>Add New Worker</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" required><br>
        <input type="submit" name="add_worker" value="Add Worker">
    </form>

    <h2>Existing Workers</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Action</th>
        </tr>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $database = "petrol_sales";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch existing workers from the database
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["user_id"]."</td>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["full_name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["contact_number"]."</td>";
                echo "<td>
                        <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
                            <input type='hidden' name='worker_id' value='".$row["user_id"]."'>
                            <input type='text' name='username' value='".$row["username"]."' required>
                            <input type='text' name='fullname' value='".$row["full_name"]."' required>
                            <input type='email' name='email' value='".$row["email"]."' required>
                            <input type='text' name='contact' value='".$row["contact_number"]."' required>
                            <div class='action-buttons'>
                                <input type='submit' name='update_worker' value='Update'>
                                <input type='submit' name='delete_worker' value='Delete'>
                            </div>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }

        // Close database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
