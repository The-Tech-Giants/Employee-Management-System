<?php
// register.php - Registration Page

// Include the database connection
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $employee_id = $_POST['employee_id'];
    $password = $_POST['password'];
    $department = $_POST['department'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if employee ID or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE employee_id = :employee_id OR email = :email");
    $stmt->execute(['employee_id' => $employee_id, 'email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "Employee ID or Email already exists. Please try a different one.";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (name, email, employee_id, password, department) VALUES (:name, :email, :employee_id, :password, :department)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt->execute([
            'name' => $name,
            'email' => $email,
            'employee_id' => $employee_id,
            'password' => $hashed_password,
            'department' => $department
        ])) {
            // Redirect to the login page upon successful registration
            header("Location: login.php");
            exit();
        } else {
            echo "Error: Could not register user.";
        }
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User REGISTER</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="login-container">
        <div class="login-image">
            <img src="unsplash.jpeg" alt="Register Image"> <!-- Image for the left side -->
        </div>
        <div class="login-form">
            <img src="TTG-Logo.png" alt="The Tech Giants Logo" class="login-logo"> <!-- TTG Logo -->
            <h2>REGISTER</h2>
            <form method="POST" action="register.php" autocomplete="off"> <!-- Disable autofill for the entire form -->
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Name" required autocomplete="off">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required autocomplete="off">
                <label for="employee_id">Employee ID</label>
                <input type="text" name="employee_id" placeholder="Employee ID" required autocomplete="off">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required autocomplete="off">
                <label for="department">Department</label>
                <input type="text" name="department" placeholder="Department" required autocomplete="off">
                <input type="submit" value="REGISTER">
            </form>
        </div>
    </div>
</body>
</html>