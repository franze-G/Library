<?php
    include('../configuration/config.php');

    // Fetch user details from the database
    $sql = "SELECT * FROM borrow";
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

        <li>
          <a href="../admin/student.php">
            <i class="fa-solid fa-chess-board"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="../admin/STInventory.php">
            <i class="fa-solid fa-book"></i>
            <span>Book Inventory</span>
          </a>
        </li>

        <li>
          <a href="STduedate.php">
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


    <div class="main-content">
      <div class="table">
        <div class="table--header">
          <h1>Due Date</h1>
        </div>
        <div class="table--body">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Version</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Borrow Date</th>
                <th>Return Date</th> 
                <th>Status</th>
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
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['fullname'] . '</td>';
                        echo '<td>' . $row['book_id'] . '</td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['author'] . '</td>';
                        echo '<td>' . $row['genre'] . '</td>';
                        echo '<td>' . $row['version'] . '</td>';
                        echo '<td>' . $row['type'] . '</td>';
                        echo '<td>' . $row['quantity'] . '</td>';
                        echo '<td>' . date('M d, Y', strtotime($row['borrow_date'])) . '</td>';
                        echo '<td>' . date('M d, Y', strtotime($row['return_date'])) . '</td>';
                        echo '<td>' . $row['status'] . '</td>';

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
