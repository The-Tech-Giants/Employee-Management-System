<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leave Balance</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="leave_balance.css">
</head>



<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile">
        <div class="profile-picture"></div>
        <p>@User</p>
      </div>
      <nav>
        <a href="update_details.php"><i class="fas fa-user-edit"></i> Update Details</a>
        <a href="daily_tasks.php"><i class="fas fa-tasks"></i> Daily Tasks</a>
        <a href="timeOff.php"><i class="fas fa-calendar-alt"></i> Time Off</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a>
      </nav>
    </aside>



    <!-- Main Content -->
    <main>
      <h1>LEAVE BALANCE</h1>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Balance</th>
              <th>Used</th>
              <th>Available</th>
              <th>Allowance</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Study Leave</td>
              <td>2</td>
              <td>6</td>
              <td>8</td>
            </tr>
            <tr>
              <td>Sick Leave</td>
              <td>3</td>
              <td>5</td>
              <td>8</td>
            </tr>
            <tr>
              <td>Maternity/Paternity Leave</td>
              <td>0</td>
              <td>60</td>
              <td>60</td>
            </tr>
            <tr>
              <td>Annual Leave</td>
              <td>5</td>
              <td>16</td>
              <td>21</td>
            </tr>
            <tr>
              <td>Unpaid Leave</td>
              <td>0</td>
              <td>8</td>
              <td>8</td>
            </tr>
            <tr>
              <td>Compassionate Leave</td>
              <td>0</td>
              <td>8</td>
              <td>8</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
