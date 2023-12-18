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
    <!-- css -->
    <link rel="stylesheet" href="../style/account.css">

    <title>Inventory</title>
  </head>
  <body>

    
  <div class="sidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
          <a href="Staff.php">
            <i class="fa-solid fa-chess-board"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="SInventory.php">
            <i class="fa-solid fa-book"></i>
            <span>Inventory</span>
          </a>
        </li>
        <li >
          <a href="../staff/SAccount.php">
            <i class="fa-solid fa-image-portrait"></i>
            <span>Accounts</span>
          </a>
        </li>
        <li>
          <a href="../staff/SCreate.php">
            <i class="fa-solid fa-user-plus"></i>
            <span>Create Account</span>
          </a>
        </li>
        <li>
          <a href="Sduedate.php">
            <i class="fa-solid fa-calendar-day"></i>
            <span>Due Dates</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa-solid fa-square-plus"></i>
            <span>Register Book</span>
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
          <h1>Book Inventory</h1>
        </div>
        <div class="table--body">
          <table>
            <thead>
              <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Version</th>
                <th>Type</th>
                <th>Publish Date</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
              </tr>
            </thead>
            <tbody>
        <!-- Dynamically populate this tbody with book data -->
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Determine the class based on status for styling

                        echo '<tr>';
                        echo '<td><img src="' . $row['image'] . '" alt="Book Image" height="50"></td>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['author'] . '</td>';
                        echo '<td>' . $row['genre'] . '</td>';
                        echo '<td>' . $row['version'] . '</td>';
                        echo '<td>' . $row['type'] . '</td>';
                        echo '<td>' . date('M d, Y', strtotime($row['date_publish'])) . '</td>';
                        echo '<td>' . $row['quantity'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';

                        // Check if the quantity is greater than 0 before allowing borrowing
                        if ($row['quantity'] > 0) {
                            echo '<td><a class="approve-btn" href="SBorrow.php?id=' . $row['id'] . '">Borrow</a></td>';
                        } else {
                            echo '<td>Not Available</td>';
                        }

                        echo '</tr>';
                    }
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
