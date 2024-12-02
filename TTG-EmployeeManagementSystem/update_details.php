<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: Login.php");
    exit();
}

require 'db.php';

$employee_id = $_SESSION['employee_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $data = [
        'full_name' => htmlspecialchars($_POST['full_name']),
        'title' => htmlspecialchars($_POST['title']),
        'role' => htmlspecialchars($_POST['role']),
        'employee_id' => htmlspecialchars($_POST['employee_id']),
        'dob' => htmlspecialchars($_POST['dob']),
        'nationality' => htmlspecialchars($_POST['nationality']),
        'gender' => htmlspecialchars($_POST['gender']),
        'race' => htmlspecialchars($_POST['race']),
        'start_date' => htmlspecialchars($_POST['start_date']),
        'mobile' => htmlspecialchars($_POST['mobile']),
        'email' => htmlspecialchars($_POST['email']),
        'emergency_name' => htmlspecialchars($_POST['emergency_name']),
        'emergency_number' => htmlspecialchars($_POST['emergency_number'])
    ];

    // Update user details in the 'users' table
    $stmt = $conn->prepare("
        UPDATE users 
        SET full_name = :full_name, 
            title = :title, 
            role = :role, 
            dob = :dob, 
            nationality = :nationality, 
            gender = :gender, 
            race = :race, 
            start_date = :start_date, 
            mobile = :mobile, 
            email = :email, 
            emergency_name = :emergency_name, 
            emergency_number = :emergency_number 
        WHERE employee_id = :employee_id
    ");

    try {
        $stmt->execute($data);
        if ($stmt->rowCount() > 0) {
            $message = "Details updated successfully.";
        } else {
            $message = "No changes made or record not found.";
        }
    } catch (PDOException $e) {
        $message = "Error updating details: " . $e->getMessage();
    }
}

// Retrieve current user details from the 'users' table
$stmt = $conn->prepare("SELECT * FROM users WHERE employee_id = :employee_id");
$stmt->execute(['employee_id' => $employee_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Set default values if no user data is found
$user = $user ?: [
    'full_name' => '',
    'title' => '',
    'role' => '',
    'dob' => '',
    'nationality' => '',
    'gender' => '',
    'race' => '',
    'start_date' => '',
    'mobile' => '',
    'email' => '',
    'emergency_name' => '',
    'emergency_number' => ''
];
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
        <div class="sidebar">
            <div class="profile-section">
                <img src="profile-placeholder.png" alt="User Profile" class="profile-picture">
                <p>@User</p>
            </div>
            <nav>
                <a href="update_details.php"><i class="fas fa-user"></i> Update Details</a>
                <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
                <a href="timeOff"><i class="fas fa-calendar-alt"></i> Time Off</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </nav>
        </div>
        
        <div class="main-content">
            <div class="update-details">
                <h1>Update Details</h1>
                <form method="POST" action="update-details.php" class="update-form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($user['title']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nationality</label>
                        <input type="text" name="nationality" value="<?php echo htmlspecialchars($user['nationality']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Race</label>
                        <input type="text" name="race" value="<?php echo htmlspecialchars($user['race']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="<?php echo htmlspecialchars($user['start_date']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Emergency Name</label>
                        <input type="text" name="emergency_name" value="<?php echo htmlspecialchars($user['emergency_name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Emergency Number</label>
                        <input type="text" name="emergency_number" value="<?php echo htmlspecialchars($user['emergency_number']); ?>" required>
                    </div>

                    <button type="submit" class="save-button">Save</button>
                </form>

                <?php if (!empty($message)) : ?>
                    <p class="success-message"><?php echo $message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
