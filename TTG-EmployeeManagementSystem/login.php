<?php

// login.php - Login Page

// Include the database connection
require 'db.php';

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $employee_id = $_POST['employee_id'];
    $password = $_POST['password'];

    // Retrieve user data from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE employee_id = :employee_id");
    $stmt->execute(['employee_id' => $employee_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['employee_id'] = $user['employee_id'];
            $_SESSION['user_name'] = $user['name']; // Set the user's name in the session
            $_SESSION['profile_picture'] = isset($user['profile_picture']) ? $user['profile_picture'] : 'default-profile.png';

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Invalid Employee ID. Please try again.";
    }
}

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User LOGIN</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <img src="unsplash.jpeg" alt="Login Image"> <!-- Image for the left side -->
        </div>
        <div class="login-form">
            <img src="TTG-Logo.png" alt="The Tech Giants Logo" class="login-logo"> <!-- TTG Logo -->
            <h2>LOGIN</h2>
            <form method="POST" action="login.php">
                <label for="employee_id">Employee ID</label>
                <input type="text" name="employee_id" placeholder="Employee ID" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="LOGIN">
            </form>
        </div>
    </div>
</body>
</html>
