<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Initialize variables
    $username = $password = "";

    // Check if the necessary form fields are set
    if (isset($_POST['username'], $_POST['password'])) {
        // Retrieve form data and sanitize
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query database for user
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password_hash'])) {
                // Password is correct, start session
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $row['role']; // Set user's role in session

                // Redirect to appropriate dashboard
                if ($row['role'] == 'manager') {
                    header("Location: manager_dashboard.php");
                    exit;
                } elseif ($row['role'] == 'worker') {
                    header("Location: worker_dashboard.php");
                    exit;
                }
            } else {
                // Password is incorrect
                $error_message = "Invalid username or password.";
            }
        } else {
            // Username not found
            $error_message = "Invalid username or password.";
        }
    } else {
        // If required fields are not set
        $error_message = "Error: Required form fields are not set.";
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
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
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>

        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>
        
        <a href="register.php" class="register-link">Register</a>
    </div>
</body>
</html>
