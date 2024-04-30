<?php
session_start();

// Check if user is logged in and their role is worker
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "worker") {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #3498db; /* Set background color to blue */
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center; /* Center the links */
        }
        .navbar a {
            display: inline-block; /* Display links in a line */
            color: #3498db; /* Set link color to blue */
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: #000; /* Change link color on hover */
        }
        .content {
            padding: 20px;
            color: #fff; /* Set text color to white */
            text-align: center; /* Center content */
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Worker Dashboard</h1>
</div>

<div class="navbar">

    <a href="worker_sales.php">Sales</a>
    <a href="worker_history.php">history</a>
    <a href="worker_profile.php">Profile</a>
     <a href="inventory.php">inventory</a>
     <li><a href="manage_customers.php">add customers</a></li>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <p>This is your worker dashboard.</p>
    <!-- Add more content here based on worker's functionalities -->
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Worker Dashboard</p>
</div>

</body>
</html>
