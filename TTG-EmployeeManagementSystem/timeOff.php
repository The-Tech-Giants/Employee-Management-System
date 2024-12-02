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

<!-- Just added this (I will add on other pages as well)     NB!! to revist -->
<div class="sidebar">
<div class="profile-section">
<img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="User Profile" class="profile-picture">
<p>@User</p> <!-- Dynamically display the username -->
</div>
    <nav>
        <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
        <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
        <a href="timeOff.php"><i class="fas fa-calendar-alt"></i> Time Off</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
    </nav>
</div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="update-details">
        <h1>TIME OFF</h1>
        <form class="update-form">
          <div class="form-group">
            <label for="leave-type">Leave Type:</label>
            <select id="leave-type">
              <option value="sick">Sick Leave</option>
              <option value="annual">Annual Leave</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date">
          </div>
          <div class="form-group">
            <label for="end-date">End Date:</label>
            <input type="date" id="end-date">
          </div>
          <div class="form-group">
            <label for="reason">Reason for Leave:</label>
            <textarea id="reason" rows="4"></textarea>
          </div>
          <button type="submit" class="save-button">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
