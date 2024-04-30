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
        .logout-link {
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
        <?php if(isset($_SESSION['username'])) { ?>
            <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
            <a href="logout.php" class="logout-link">Logout</a>
        <?php } else { ?>
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
        <?php } ?>
    </div>
</body>
</html>
