<?php
    
    include('../configuration/config.php');
    // Handle approval or decline actions
    if (isset($_GET['action']) && isset($_GET['user_id'])) {
        $action = $_GET['action'];
        $userId = $_GET['user_id'];
        if ($action === 'approve') {
            // Get user details from the 'user' table
            $userQuery = "SELECT * FROM `admin` WHERE id = $userId";
            $userResult = $conn->query($userQuery);
            if ($userResult->num_rows > 0) {
                $userData = $userResult->fetch_assoc();
                $idnumber = $userData['id_number'];
                $password = md5($userData['password']); // Securely hash the password using MD5
                $userType = $userData['user_type']; // Assuming 'user_type' is the column in 'user' table indicating user type
                // Update the approval status to 'approved'
                $updateSql = "UPDATE `admin` SET approval_status = 'approved' WHERE id = $userId";
                $conn->query($updateSql);
                // Insert user data into 'account' table with the username as student_number, user type from signup, and approval status
                $insertAccountSql = "INSERT INTO account (username, pass, user_type, approval_status) VALUES ('$idnumber', '$password', '$userType', 'approved')";
                $conn->query($insertAccountSql);
                // You may perform additional actions if needed
            }
        } elseif ($action === 'decline') {
            // Update the approval status to 'declined'
            $updateSql = "UPDATE `admin` SET approval_status = 'declined' WHERE id = $userId";
            $conn->query($updateSql);
        }
        // Redirect back to the user list page
        header("Location: Account.php");
        exit();
    }
    // Fetch only pending user details from the database
    $sql = "SELECT * FROM `admin` WHERE approval_status = 'Pending'";
    $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="../style/account.css">

    <title>Accounts</title>
  </head>
  <body>

    <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li>
          <a href="Dashboard.php">
            <i class="fa-solid fa-chess-board"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="Inventory.php">
            <i class="fa-solid fa-book"></i>
            <span>Inventory</span>
          </a>
        </li>
        <li class="active">
          <a href="account.php">
            <i class="fa-solid fa-book"></i>
            <span>Accounts</span>
          </a>
        </li>
        <li>
          <a href="create.php">
            <i class="fa-solid fa-user-plus"></i>
            <span>Create</span>
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

    <div class="main-content">

      <div class="table">
        <div class="table--header">
          <h1>Account Management</h1>
        </div>
        <div class="table--body">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Student Number</th>
                <th>Email</th>
                <th>Department</th>
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
                        echo '<td>'. '<strong>' . $row['id'] . '</strong>' . '</td>';
                        echo '<td>' . $row['fullname'] . '</td>';
                        echo '<td>' . $row['id_number'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['department'] . '</td>';
                        echo '<td>' . ($row['user_type'] == 1 ? 'Admin' : ($row['user_type'] == 2 ? 'Student' : 'unknown')) . '</td>';
                        echo '<td>'. '<div class="status">' . $row['approval_status'] . '</div>' . '</td>';
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
      </div>
    </div>

    <!-- fontawesome icons -->
    <script
      src="https://kit.fontawesome.com/64d29af423.js"
      crossorigin="anonymous"
    ></script>

</body>
</html>
