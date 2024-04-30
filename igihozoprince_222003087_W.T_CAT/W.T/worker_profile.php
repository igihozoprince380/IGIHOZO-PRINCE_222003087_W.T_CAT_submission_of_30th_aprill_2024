<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:blueviolet; /* Light green background */
        }

        .container {
            max-width: 400px; /* Reduced width of the container */
            margin: 50px auto;
            padding: 10px;
            background-color: #ffffff; /* White container background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #007bff; /* Blue heading color */
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center align the form elements */
        }

        label {
            margin-bottom: 3px;
            font-weight: bold;
            color: #333; /* Dark gray label color */
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 20px); /* Adjusted width */
            padding: 3px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        .profile-info {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and display form data
            echo "<h2>User Profile</h2>";
            echo "<div class='profile-info'>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($_POST['location']) . "</p>";
            echo "<p><strong>Interests:</strong> " . htmlspecialchars($_POST['interests']) . "</p>";
            echo "<p><strong>About:</strong> " . htmlspecialchars($_POST['about']) . "</p>";
            echo "</div>";
        }
        ?>
        <h2>EDIT PROFILE</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location">
            
            <label for="interests">Interests:</label>
            <input type="text" id="interests" name="interests">
            
            <label for="about">About:</label>
            <textarea id="about" name="about" rows="4"></textarea>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>