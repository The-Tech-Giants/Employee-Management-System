<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Manage_Employee_Tasks.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-card">
                    <div class="profile-image">
                        <!-- Profile image placeholder initially -->
                        <img id="profileImg" src="profile-placeholder.png" alt="User Profile">
                    </div>
                    <!-- Button outside the .profile-image div to change picture -->
                    <button class="profile-button" onclick="document.getElementById('imageUpload').click()">Change Picture</button>
                    <input type="file" id="imageUpload" style="display: none;" accept="image/*" onchange="updateProfileImage(event)">
                    <div class="profile-info">
                        <p>@Sibusiso Ndabezitha - Admin</p>
                    </div>
                </div>
            </div>
            <nav>
                <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                <a href="#" class="active"><i class="fas fa-tasks"></i> Manage Employee Tasks</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Manage Leaves</a>
                <a href="#"><i class="fas fa-users"></i> View Employee Profiles</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Manage Employee Tasks</h1>
            <section class="task-table">
                <h2> Assigning of tasks  <span class="info-icon">i</span></h2>

                <!-- Table for tasks -->
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
                            <tr>
                                <td>1</td>
                                <td>Complete UI/UX</td>
                                <td>Sibusiso</td>
                                <td>18 October 2024</td>
                                <td class="status completed">Completed</td>
                                <td>
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Start Coding</td>
                                <td>Bonolo</td>
                                <td>05 October 2024</td>
                                <td class="status pending">Pending</td>
                                <td>
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Fix Database</td>
                                <td>Kgaugelo</td>
                                <td>12 October 2024</td>
                                <td class="status completed">Completed</td>
                                <td>
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-delete">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Launch App</td>
                                <td>Maxwell</td>
                                <td>12 October 2024</td>
                                <td class="status incomplete">Incomplete</td>
                                <td>
                                    <button class="btn btn-edit">Edit</button>
                                    <button class="btn btn-delete">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Button to create new task -->
                <button class="create-task-btn">+ Create Task</button>
            </section>
        </div>

        <!-- Toggle Button -->
        <button class="toggle-btn">☰</button>

    </div>

    <script>
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
    </script>
    <script src="Manage_Employee_Tasks.js"></script>
</body>
</html>
