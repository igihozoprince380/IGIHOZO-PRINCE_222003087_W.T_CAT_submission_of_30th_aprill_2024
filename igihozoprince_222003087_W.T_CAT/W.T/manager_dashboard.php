<?php
// Start the session
session_start();

// Check if user is not logged in or is not a manager
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "manager") {
    // Redirect to login page or show an error message
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #3498db; /* Blue background color */
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="manager_dashboard.php">Home</a></li>
                <li><a href="manage_employees.php">Manage Employees</a></li>
                <li><a href="view_sales.php">View Sales</a></li>
                <li><a href="generate_reports.php">Generate Reports</a></li>
                 <li><a href="manage_inventory.php">manage inventory</a></li>
                <li><a href="manage_supplier.php">manage supplier</a></li>
                 
                <!-- Add more navbar links as needed -->
                <li style="float:right"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Manager Dashboard</h2>
        <!-- Dashboard content goes here -->
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Manager Dashboard</p>
    </footer>
</body>
</html>
