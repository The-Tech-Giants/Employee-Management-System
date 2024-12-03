

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Off</title>
    <link rel="stylesheet" href="timeOff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="dashboard-container">
    <div class="hamburger" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>
    <div class="sidebar" id="sidebar">
        <img src="UserIcon.jpg" alt="User Icon" class="user-icon">
        <p>@User</p>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
            <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
            <a href="timeOff.php"><i class="fas fa-calendar-alt"></i> Time Off</a>
            <a href="leave_balance.php"><i class="fas fa-calculator-alt"></i> Leave Balance</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </nav>
    </div>
    <div class="main-content">
        <h2>Request Time Off</h2>
        <div class="dashboard-content">
            <form action="time_off_action.php" method="post" class="vertical-form">
                <label for="leave_type">Leave Type:</label>
                <select name="leave_type" id="leave_type">
                    <option value="casual">Casual</option>
                    <option value="sick">Sick</option>
                    <option value="annual">Annual</option>
                </select>
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date">
                <label for="reason">Reason:</label>
                <textarea name="reason" id="reason" rows="4"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
  }
</script>
</body>
</html>
