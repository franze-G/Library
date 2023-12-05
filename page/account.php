<?php
    
    include('../configuration/config.php');

    // Handle approval or decline actions
    if (isset($_GET['action']) && isset($_GET['user_id'])) {
        $action = $_GET['action'];
        $userId = $_GET['user_id'];

        if ($action === 'approve') {
            // Get user details from the 'user' table
            $userQuery = "SELECT * FROM user WHERE id = $userId";
            $userResult = $conn->query($userQuery);

            if ($userResult->num_rows > 0) {
                $userData = $userResult->fetch_assoc();
                $studentNumber = $userData['student_number'];
                $password = md5($userData['password']); // Securely hash the password using MD5
                $userType = $userData['user_type']; // Assuming 'user_type' is the column in 'user' table indicating user type

                // Update the approval status to 'approved'
                $updateSql = "UPDATE user SET approval_status = 'approved' WHERE id = $userId";
                $conn->query($updateSql);

                // Insert user data into 'account' table with the username as student_number, user type from signup, and approval status
                $insertAccountSql = "INSERT INTO account (username, pass, user_type, approval_status) VALUES ('$studentNumber', '$password', '$userType', 'approved')";
                $conn->query($insertAccountSql);

                // You may perform additional actions if needed
            }
        } elseif ($action === 'decline') {
            // Update the approval status to 'declined'
            $updateSql = "UPDATE user SET approval_status = 'declined' WHERE id = $userId";
            $conn->query($updateSql);
        }

        // Redirect back to the user list page
        header("Location: account.php");
        exit();
    }

    // Fetch only pending user details from the database
    $sql = "SELECT * FROM user WHERE approval_status = 'Pending'";
    $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- confirm css -->
    <link rel="stylesheet" href="confirm.css" />
    <link rel="stylesheet" href="../style/dashboard.css" />

    <!-- jquery datatable -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <title>User</title>
  </head>
  <body>
    <!-- dito mag reredirect yung user after login -->

    <!-- sidebar -->

    <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
          <a href="UserProfile.html">
            <i class="fa-solid fa-address-book"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="Dashboard.php">
            <i class="fa-solid fa-chess-board"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="Inventory.php">
            <i class="fa-solid fa-square-plus"></i>
            <span>Book Inventory</span>
          </a>
        </li>
        <li>
          <a href="account.php">
            <i class="fa-solid fa-book"></i>
            <span>Account Management</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa-solid fa-calendar-day"></i>
            <span>Due Dates</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa-solid fa-toolbox"></i>
            <span>Settings</span>
          </a>
        </li>
        <li class="logout" id="SignoutBtn">
          <a href="Logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="content">
        <h1>Account Management</h1>

        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Student Number</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['fullname'] . '</td>';
                        echo '<td>' . $row['student_number'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['course'] . '</td>';
                        echo '<td>' . ($row['user_type'] == 1 ? 'Admin' : ($row['user_type'] == 2 ? 'Student' : 'unknown')) . '</td>';
                        echo '<td>' . $row['approval_status'] . '</td>';
                        echo '<td><a class="approve-btn" href="?action=approve&user_id=' . $row['id'] . '">Approve</a>';
                        echo ' <a class="decline-btn" href="?action=decline&user_id=' . $row['id'] . '">Decline</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">No pending accounts.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>


          <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>

    <!-- fontawesome icons -->
    <script
      src="https://kit.fontawesome.com/64d29af423.js"
      crossorigin="anonymous"
    ></script>

    <script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });
    </script>

</body>
</html>
