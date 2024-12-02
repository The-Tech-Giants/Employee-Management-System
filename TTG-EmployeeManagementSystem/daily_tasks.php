<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: Login.php");
    exit();
}

require 'db.php';

try {
    $employee_id = $_SESSION['employee_id'];
    $stmt = $conn->prepare("SELECT * FROM daily_tasks WHERE employee_id = :employee_id");
    $stmt->execute(['employee_id' => $employee_id]);
    $dailyTasks_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Tasks</title>
    <link rel="stylesheet" href="daily_tasks.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<!-- sidebar -->
<div class="dashboard-container">
        <div class="sidebar">
            <div class="profile-section">
                <img src="profile-placeholder.png" alt="User Profile" class="profile-picture">
                <p>@User</p>
            </div>
            <nav>
                <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
                <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
                <a href="timeOff.php"><i class="fas fa-calendar-alt"></i> Time Off</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </nav>
        </div>
        

    
    <!-- Main Content -->
    <div class="main-content dailyTasks_content">
        <h1>Daily Tasks</h1>
        <?php if (count($dailyTasks_tasks) > 0): ?>
            <div class="dailyTasks_tasksTable">
                <div class="dailyTasks_tasksHeader">
                    <span>#</span>
                    <span>Task Name</span>
                    <span>Description</span>
                    <span>Due Date</span>
                </div>
                <?php foreach ($dailyTasks_tasks as $dailyTasks_task): ?>
                    <div class="dailyTasks_taskRow">
                        <span><?php echo htmlspecialchars($dailyTasks_task['id']); ?></span>
                        <span><?php echo htmlspecialchars($dailyTasks_task['task_name']); ?></span>
                        <span><?php echo htmlspecialchars($dailyTasks_task['description']); ?></span>
                        <span><?php echo htmlspecialchars($dailyTasks_task['due_date']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="announcement">
                <p>No tasks found for today.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
