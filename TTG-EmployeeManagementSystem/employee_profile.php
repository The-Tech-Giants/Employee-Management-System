
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
    $dbname = "users1";
    $username = "root";
    $password = "";

    // Establish database connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection error: " . mysqli_connect_error());
    }

    // SQL query to insert data into the table
    $sql = "INSERT INTO employee_details (full_name, title, role, employee_id, dob, nationality, gender, race, start_date, mobile, email, emergency_name, emergency_number)
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
    <title>Employee Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="dashboard-container">
   <!-- Hamburger Menu -->
   <div class="hamburger" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <form method="POST" enctype="multipart/form-data" id="profileForm">
            <label for="profilePic">
                <img src="UserIcon.jpg" alt="User Icon" class="user-icon" id="profileImage">
            </label>
            <input type="file" id="profilePic" name="profilePic" accept="image/*" style="display: none;" onchange="updateProfilePicture(event)">
        </form>
        <p>@EmployeeName</p>
        <nav>
            <a href="dashboard.php"><i class="fas fa-gauge"></i>Dashboard</a>
            <a href="profile.php"><i class="fas fa-user"></i> Employee Profile</a>
            <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Employee Tasks</a>
            <a href="leave_balance.php"><i class="fas fa-calculator"></i> Manage Leaves</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="main-content">
            

        <h2>Employee Profile</h2>
        <div class="dashboard-content">
            <form action="profile.php" method="post" class="vertical-form">
                <div class="form-section-container">
                    <!-- Personal Information -->
                    <div class="form-section">
                        <h3>Personal Information</h3>
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="" required>

                        <label>Title</label>
                        <input type="text" name="title" value="" required>
                        
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="" required>
                        
                        <label>Gender</label>
                        <input type="text" name="gender" value="" required>

                        <label>Nationality</label>
                        <input type="text" name="nationality" value="" required>
                        
                        <label>Race</label>
                        <input type="text" name="race" value="" required>
                        
                       <label>Mobile Number</label>
                        <input type="text" name="mobile" value="" required>
                        
                        
                        <label>Emergency Name</label>
                        <input type="text" name="emergency_name" value="" required>
                      
    
                        
                       <label>Emergency Number</label>
                            <input type="text" name="emergency_number" value="" required>

                    </div>
        
                    <!-- Employment Information -->
                    <div class="form-section">
                        <h3>Employment Information</h3>
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="" required>

                        <label>Email Address</label>
                        <input type="email" name="email" value="" required>
                        
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="" required>

                        <label>Role</label>
                        <input type="text" name="role" value="" required>
                        
                        
                        
                        
                    </div>
                </div>
                <button type="submit">Update</button>
            </form>

            <div class="profile-header">
                <img src="UserIcon.jpg" alt="User Icon" class="user-icon" id="profileImage">
               <div class="info">
                   <h3>Makgwale Kgaogelo</h3>
                   <p>Full Stack Developer</p>
                   <p>Department: Information Technology</p>
                   <p>Employee ID: 123456</p>
               </div>
        </div>
        
        <?php if (!empty($message)) : ?>
                    <p class="success-message"><?php echo $message; ?></p>
                <?php endif; ?>
        
    </div>
</div>

<script>
  // Toggle sidebar
  document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.querySelector(".hamburger"); // Your hamburger menu button
    const sidebar = document.querySelector(".sidebar"); // Sidebar element
    
    // Sidebar toggle functionality
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener("click", (event) => {
            event.stopPropagation(); // Prevent click from propagating to document
            sidebar.classList.toggle("open");
        });
    }

    // Close sidebar when clicking outside it (only on mobile view)
    document.addEventListener("click", (event) => {
        const isMobile = window.innerWidth <= 768; // Adjust the breakpoint as per your design
        if (isMobile && sidebar && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
        }
    });
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
