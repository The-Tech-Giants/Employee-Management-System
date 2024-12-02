<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['employee_id'])) {
    // If not logged in, redirect to the login page
    header("Location: Login.php");
    exit();
}

// Retrieve the user's name and profile picture from the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$profile_picture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'default-profile.png';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="updatedetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">

        <!-- Just added this (I will add on other pages as well)     NB!! to revist -->
        <div class="sidebar">
        <div class="profile-section">
        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="User Profile" class="profile-picture">
        <p>@<?php echo htmlspecialchars($user_name); ?></p> <!-- Dynamically display the username -->
    </div>
            <nav>
                <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
                <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
                <a href="timeOff.php"><i class="fas fa-calendar-alt"></i> Time Off</a>
                <a href="leave_balance.php"><i class="fas fa-calculator-alt"></i> leave Balance</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </nav>
        </div>
        
        <div class="main-content">
            <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($user_name); ?></h1>
            <div class="announcement">
                <p>Here are the latest updates for today.</p>
            </div>
        </div>
    </div>
</body>
</html>

