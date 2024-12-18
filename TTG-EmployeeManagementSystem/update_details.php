<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data using POST method
    $full_name = $_POST["full_name"] ?? '';
    $title = $_POST["title"] ?? '';
    $role = $_POST["role"] ?? '';
    $employee_id = $_POST["employee_id"] ?? 0; // Assuming it's an integer
    $dob = $_POST["dob"] ?? '';
    $nationality = $_POST["nationality"] ?? '';
    $gender = $_POST["gender"] ?? '';
    $race = $_POST["race"] ?? '';
    $start_date = $_POST["start_date"] ?? '';
    $mobile = $_POST["mobile"] ?? '';
    $email = $_POST["email"] ?? '';
    $emergency_name = $_POST["emergency_name"] ?? '';
    $emergency_number = $_POST["emergency_number"] ?? '';

    // Database connection variables
    $host = "localhost";
    $dbname = "update_details_db";
    $username = "root";
    $password = "";

    // Establish database connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection error: " . mysqli_connect_error());
    }

    // SQL query to insert data into the table
    $sql = "INSERT INTO update_details (full_name, title, role, employee_id, dob, nationality, gender, race, start_date, mobile, email, emergency_name, emergency_number)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare SQL statement
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL Error: " . mysqli_error($conn));
    }

    // Bind parameters for the prepared statement
    mysqli_stmt_bind_param($stmt, "ssisssssssiss",
        $full_name,
        $title,
        $role,
        $employee_id,
        $dob,
        $nationality,
        $gender,
        $race,
        $start_date,
        $mobile,
        $email,
        $emergency_name,
        $emergency_number
    );

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $message = "Record saved successfully.";
    } else {
        $message = "Error saving record: " . mysqli_stmt_error($stmt);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
    <link rel="stylesheet" href="updatedetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">

    <div class="hamburger" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

        <div class="sidebar" id="sidebar">
            <div class="profile-section">
                <img src="profile-placeholder.png" alt="User Profile" class="profile-picture">
                <p>Bonolo Mafafo</p>
            </div>
            <nav>
                <a href="update_details.php"><i class="fas fa-gauge"></i> Dashboard</a>
                <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
                <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
                <a href="timeOff"><i class="fas fa-calendar-alt"></i> Time Off</a>
                <a href="update_details.php"><i class="fa-solid fa-scale-balanced"></i> Leave Balance</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </nav>
        </div>
        
        <div class="main-content">
            <div class="update-details">
                <h1>Update Details</h1>
                <form method="POST" action="update_details.php" class="update-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Nationality</label>
                        <input type="text" name="nationality" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" name="gender" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Race</label>
                        <input type="text" name="race" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Emergency Name</label>
                        <input type="text" name="emergency_name" value="" required>
                    </div>

                    <div class="form-group">
                        <label>Emergency Number</label>
                        <input type="text" name="emergency_number" value="" required>
                    </div>

                    <button type="submit" class="save-button">Save</button>
                </form>

                <?php if (!empty($message)) : ?>
                    <p class="success-message"><?php echo $message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>



    
    <script>
  // Toggle sidebar
  function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
  }

  // Close sidebar if clicked outside
  document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.querySelector('.hamburger');

    // Check if the click is outside the sidebar or hamburger
    if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
      sidebar.classList.remove('active');
    }
  });

  // Update Profile Picture
  function updateProfilePicture(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      document.getElementById('profileImage').src = e.target.result;
    };

    if (file) {
      reader.readAsDataURL(file);
    }
  }
</script>

</body>
</html>
