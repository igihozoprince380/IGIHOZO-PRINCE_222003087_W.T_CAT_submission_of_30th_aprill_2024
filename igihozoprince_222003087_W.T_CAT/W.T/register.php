<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .login-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="fullname">Full Name:</label><br>
            <input type="text" id="fullname" name="fullname" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="contact_number">Contact Number:</label><br>
            <input type="text" id="contact_number" name="contact_number"><br>

            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="manager">Manager</option>
                <option value="worker">Worker</option>
            </select><br>

            <input type="submit" value="Register">
        </form>

        <a href="login.php" class="login-button">Already have an account? Login here</a>

        <?php
        // Include database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "petrol_sales";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Initialize variables
            $username = $password = $fullname = $email = $contact_number = $role = "";

            // Check if the necessary form fields are set
            if (isset($_POST['username'], $_POST['password'], $_POST['fullname'], $_POST['email'], $_POST['role'])) {
                // Retrieve form data and sanitize
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $role = mysqli_real_escape_string($conn, $_POST['role']);
                
                // Check if optional field is set
                if (isset($_POST['contact_number'])) {
                    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
                }

                // Hash the password
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                // Check if the username already exists
                $sql_check = "SELECT * FROM users WHERE username='$username'";
                $result_check = mysqli_query($conn, $sql_check);
                if (mysqli_num_rows($result_check) > 0) {
                    // Username already exists, update the existing entry
                    $sql_update = "UPDATE users SET password_hash='$password_hash', role='$role', full_name='$fullname', email='$email', contact_number='$contact_number' WHERE username='$username'";
                    if (mysqli_query($conn, $sql_update)) {
                        echo "User updated successfully.";
                    } else {
                        echo "Error updating user: " . mysqli_error($conn);
                    }
                } else {
                    // Username doesn't exist, insert a new entry
                    $sql_insert = "INSERT INTO users (username, password_hash, role, full_name, email, contact_number) 
                            VALUES ('$username', '$password_hash', '$role', '$fullname', '$email', '$contact_number')";
                    if (mysqli_query($conn, $sql_insert)) {
                        echo "User registered successfully.";
                    } else {
                        echo "Error inserting user: " . mysqli_error($conn);
                    }
                }
            } else {
                // If required fields are not set
                echo "Error: Required form fields are not set.";
            }
        }

        // Close database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
