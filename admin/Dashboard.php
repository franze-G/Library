  <?php
      include('../configuration/config.php');

      
      if(isset($_COOKIE['token'])){
          $id=$_COOKIE['token'];

          $sql ="SELECT account.*, admin.fullname
                FROM account 
                JOIN `admin` ON account.id = admin.id 
                WHERE account.id=$id";

              if($rs=$conn->query($sql)){
                  if($rs->num_rows>0){
                      $row=$rs->fetch_assoc();
                      $usertype=$row['user_type'];
                      $userid=$row['id'];
                      $fname=$row['fullname']; // Add this line to get the user's first name
              // Add this line to get the user's last name
                      switch($usertype){
                      case 1 : header("location:"); break;

                      //case 2 : header("location:../student/user.php"); break;
                      }
                  }else{
                      //token not exist
                      header("location:");
                  }
                  }
                  else{
                      echo $conn->error;
                  }
              }else{
                  header("location:");
              }
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/Staff.css" />
    <link rel="stylesheet" href="../style/">
    <!-- boxicons -->
        <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Dashboard</title>
  </head>
  <body>
    <!-- dito mag reredirect yung user after login -->

    <!-- sidebar -->

    <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
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
        <li >
          <a href="account.php">
            <i class="fa-solid fa-book"></i>
            <span>Accounts</span>
          </a>
        </li>
        <li>
          <a href="create.php">
            <i class="fa-solid fa-user-plus"></i>
            <span>Create Account</span>
          </a>
        </li>
        <li>
          <a href="duedate.php">
            <i class="fa-solid fa-calendar-day"></i>
            <span>Due Dates</span>
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

    <div class="main--content">
      <div class="header--wrapper">
        <div class="header--title">
          <span>Admin</span>
          <p><?php echo strtoupper($fname); ?></p>
        </div>
      </div>

      <div class="top--cards">
        <div class="card card--content lost">
          <div class="card--textholder">
          <?php
              $sql = "SELECT COUNT(*) AS bookCount FROM `borrow`";
              $result = $conn->query($sql);

              if ($result !== false && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $bookCount = $row['bookCount'];
                  echo "<p class='count'>$bookCount</p>";
              } else {
                  echo "Error fetching book count: " . $conn->error;
              }
          ?>

            <p class="statement">Borrowed Books</p>
          </div>
          <div class="image--inside-the-card"></div>
        </div>
        <div class="card card--content returned">
          <div class="card--textholder">
          <?php
              $sql = "SELECT COUNT(*) AS returnedBookCount FROM `borrow` WHERE `status` = 'Returned'";
              $result = $conn->query($sql);

              if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $returnedBookCount = $row['returnedBookCount'];
                  echo "<p class='count'>$returnedBookCount</p>";
              } else {
                  echo "Error fetching returned book count: " . $conn->error;
              }
          ?>

            <p class="statement">Returned Books</p>
          </div>
          <div class="image--inside-the-card"></div>
        </div>
        <div class="card card--content available">
          <div class="card--textholder">
          <?php
              $sql = "SELECT COUNT(*) AS bookCount FROM `book` WHERE `status` = 'registered'";
              $result = $conn->query($sql);
              if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $bookCount = $row['bookCount'];
                  echo "<p class='count'>$bookCount</p>";
              } else {
                  echo "Error fetching book count: " . $conn->error;
              }
            ?>
            <p class="statement">Available Books</p>
          </div>
          <div class="image--inside-the-card"></div>
        </div>
      </div>
      
      <div class="tabular--wrapper">
        <h3 class="main-title">Preview</h3>
        <div class="table-container">
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
              </tr>
            </thead>
            <tbody>
              <?php
                $userQuery = "SELECT * FROM `admin` WHERE approval_status = 'pending'";
                $result = $conn->query($userQuery);

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
