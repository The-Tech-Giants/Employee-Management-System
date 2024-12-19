<?php
// Database connection
$host = 'localhost'; // database host
$dbname = 'users1'; // database name
$username = 'root'; // database username
$password = ''; // database password

// Use the correct variable names for database connection
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM manage_employee_tasks WHERE id=$delete_id");
}

// Handle edit
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $task_name = $_POST['task_name'];
    $assigned_to = $_POST['assigned_to'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $conn->query("UPDATE manage_employee_tasks SET task_name='$task_name', assigned_to='$assigned_to', task_date='$date', status='$status' WHERE id=$edit_id");
    $confirmation_message = "Task updated successfully!";
}

// Handle create
if (isset($_POST['create_task'])) {
    $task_name = $_POST['task_name'];
    $assigned_to = $_POST['assigned_to'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $conn->query("INSERT INTO manage_employee_tasks (task_name, assigned_to, task_date, status) VALUES ('$task_name', '$assigned_to', '$date', '$status')");
    $confirmation_message = "New task created successfully!";
}

// Handle profile image upload
if (isset($_FILES['profile_image'])) {
    $file_name = $_FILES['profile_image']['name'];
    $file_tmp = $_FILES['profile_image']['tmp_name'];
    $file_path = 'uploads/' . $file_name;  // Specify the folder to store the images

    // Move the uploaded file to the 'uploads' folder
    move_uploaded_file($file_tmp, $file_path);

    // Save the file path to the database
    $conn->query("UPDATE users SET profile_image='$file_path' WHERE id=1"); // Adjust the query as needed
}


// Fetch tasks
$result = $conn->query("SELECT * FROM manage_employee_tasks");
$tasks = $result->fetch_all(MYSQLI_ASSOC);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Manage_Employee_Tasks.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            max-width: 90%;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-header h2 {
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
        .modal form {
            display: flex;
            flex-direction: column;
        }
        .modal form input,
        .modal form select,
        .modal form button {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .modal form button {
            background-color: #ff9500;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .modal form button:hover {
            background-color: #FFA500;
        }

        
        .confirmation-message {
            display: none;
            color: white;
            background-color: #28a745;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
            text-align: center;
        }



        
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100%;
            position: fixed; /* Keep sidebar fixed */
            top: 0;
            left: 0;
            background-color: #ff9500;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            z-index: 1000; 
            overflow-y: auto; 
            transform: translateX(0); 
        }

        /* Ensure that main content doesn't overlap the sidebar */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f4f4f4;
            margin-left: 250px; 
            overflow-y: auto; 
        }


        /* Sidebar Links */
        nav a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #ff7a00;
        }

        /* For mobile devices */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                height: 100%;
                transform: translateX(-250px); 
                z-index: 9999;
            }

            .sidebar.open {
                transform: translateX(0); 
            }

            .main-content {
                margin-left: 0; 
                padding: 20px;
            }

            .toggle-btn {
                display: block; 
            }

            .task-table h2 {
                margin-top: 20px; 
                margin-bottom: 10px; 
                font-size: 20px; 
                text-align: center; 
            }

            .task-table {
                padding-top: 5px; 
                padding-bottom: 50px; 
            }

            .tabular--wrapper {
                padding-top: 3rem; 
                padding-bottom: 1rem; 
            }

            .table-container {
                overflow-x: auto; 
                -webkit-overflow-scrolling: touch; 
            }

            table {
                width: 100%; 
                border-collapse: collapse; 
            }

            th, td {
                font-size: 12px; 
                padding: 10px; 
                text-align: left; 
            }

            .create-task-btn {
                width: 100%;
                padding: 10px 20px;
            }

            .btn {
                font-size: 12px;
                padding: 6px 15px;
            }

            .main-content {
                padding: 54px;
                justify-content: flex-start;
            }

        }

        /* For desktop devices (Ensure no scrollbar when switching back) */
        @media (min-width: 769px) {
            .main-content {
                margin-left: 250px; 
                padding: 30px;
            }

            .sidebar {
                transform: translateX(0); 
            }

            .dashboard-container {
                display: flex;
            }
        }
        
    </style>


</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-card">
                    
                <div class="profile-image">
                 <img id="profileImg" src="<?= isset($profile_image) ? $profile_image : 'profile-placeholder.png' ?>" alt="User Profile">
                    

                    </div>
                    <button class="profile-button" onclick="document.getElementById('imageUpload').click()">Change Picture</button>
                    <input type="file" id="imageUpload" style="display: none;" accept="image/*" onchange="updateProfileImage(event)">
                    <div class="profile-info">
                        <p>@Sibusiso Ndabezitha - Admin</p>
                    </div>
                </div>
            </div>
            <nav>
                <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                <a href="#" class="active-underline"><i class="fas fa-tasks"></i> Manage Employee Tasks</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Manage Leaves</a>
                <a href="#"><i class="fas fa-users"></i> View Employee Profiles</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Manage Employee Tasks</h1>
            <section class="task-table">
                <h2>Assigning of tasks</h2>
                <div class="tabular--wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Assigned to</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td><?= $task['id'] ?></td>
                                    <td><?= $task['task_name'] ?></td>
                                    <td><?= $task['assigned_to'] ?></td>
                                    <td><?= $task['task_date'] ?></td>
                                    <td class="status <?= strtolower($task['status']) ?>"><?= $task['status'] ?></td>
                                    <td>
                                        <button class="btn btn-edit" onclick="openEditModal(<?= $task['id'] ?>, '<?= $task['task_name'] ?>', '<?= $task['assigned_to'] ?>', '<?= $task['task_date'] ?>', '<?= $task['status'] ?>')">Edit</button>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="delete_id" value="<?= $task['id'] ?>">
                                            <button type="submit" class="btn btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Button to create new task -->
                <button class="create-task-btn" onclick="openModal()">+ Create Task</button>
            </section>

            <!-- Confirmation Message -->
            <?php if (isset($confirmation_message)): ?>
                <div class="confirmation-message">
                    <?= $confirmation_message ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Modal for Create Task Form -->
        <div class="modal" id="createTaskModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Create New Task</h2>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <form method="POST">
                    <input type="hidden" name="create_task" value="1">
                    <input type="text" name="task_name" placeholder="Task Name" required>
                    <select name="assigned_to" required>
                        <option value="">Assign to</option>
                        <option value="Sibusiso">Sibusiso</option>
                        <option value="Bonolo">Bonolo</option>
                        <option value="Kgaugelo">Kgaugelo</option>
                    </select>
                    <input type="date" name="date" required>
                    <select name="status" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Incomplete">Incomplete</option>
                    </select>
                    <button type="submit">Save Task</button>
                </form>
            </div>
        </div>

        <!-- Modal for Edit Task Form -->
        <div class="modal" id="editTaskModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Task</h2>
                    <button class="modal-close" onclick="closeEditModal()">&times;</button>
                </div>
                <form method="POST">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="text" name="task_name" id="edit_task_name" placeholder="Task Name" required>
                    <select name="assigned_to" id="edit_assigned_to" required>
                        <option value="">Assign to</option>
                        <option value="Sibusiso">Sibusiso</option>
                        <option value="Bonolo">Bonolo</option>
                        <option value="Kgaugelo">Kgaugelo</option>
                    </select>
                    <input type="date" name="date" id="edit_date" required>
                    <select name="status" id="edit_status" required>
                        <option value="">Select Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Incomplete">Incomplete</option>
                    </select>
                    <button type="submit">Update Task</button>
                    <!-- <div class="confirmation-message" style="display:show"></div> -->
                </form>
            </div>
        </div>

        <!-- Toggle Button -->
        <button class="toggle-btn">☰</button>


        <script>

            // Update Profile Image Function
            function updateProfileImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                const profileImg = document.getElementById('profileImg');
                profileImg.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

            function openModal() {
                document.getElementById('createTaskModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('createTaskModal').style.display = 'none';
            }

            function openEditModal(id, name, assignedTo, date, status) {
                // Populate and show edit modal
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_task_name').value = name;
                document.getElementById('edit_assigned_to').value = assignedTo;
                document.getElementById('edit_date').value = date;
                document.getElementById('edit_status').value = status;
                document.getElementById('editTaskModal').style.display = 'flex';
            }

            function closeEditModal() {
                document.getElementById('editTaskModal').style.display = 'none';
            }

        </script>

<script src="Manage_Employee_Tasks.js"></script>
</body>
</html>
