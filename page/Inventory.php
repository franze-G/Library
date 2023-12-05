<?php
    include('../configuration/config.php');

    // Fetch user details from the database
    $sql = "SELECT * FROM book";
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
          <a href="#">
            <i class="fa-solid fa-book"></i>
            <span>Book Inventory</span>
          </a>
        </li>
        <li>
          <a href="account.php">
            <i class="fa-solid fa-square-plus"></i>
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
        <h1>Book Inventory</h1>

        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publish Date</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <!-- Dynamically populate this tbody with user data -->
                <?php
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            // Determine the class based on status for styling

                            echo '<tr>';
                            echo '<td><img src="' . $row['image'] . '" alt="Book Image" height="50"></td>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['title'] . '</td>';
                            echo '<td>' . $row['author'] . '</td>';
                            echo '<td>' . $row['genre'] . '</td>';
                            echo '<td>' . date('M d, Y', strtotime($row['date_publish'])) . '</td>';
                            echo '<td>' . $row['quantity'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '<td><a class="" href="Borrow.php?id=' . $row['id'] . '">Borrow Book</a></td>';
                            // Replace this line in the table body
                            echo '</tr>';
                        }
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
