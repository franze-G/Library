<?php
    include('../configuration/config.php');

    
    if(isset($_COOKIE['token'])){
        $id=$_COOKIE['token'];

        $sql ="SELECT account.*, user.fullname
               FROM account 
               JOIN user ON account.id = user.id 
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
                    header("location:login.php");
                }
                }
                else{
                    echo $conn->error;
                }
            }else{
                header("location:login.php");
            }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- confirm css -->
    <link rel="stylesheet" href="confirm.css" />
    <link rel="stylesheet" href="../style/dashboard.css" />
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
          <a href="#">
            <i class="fa-solid fa-chess-board"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="Inventory.php">
            <i class="fa-solid fa-book"></i>
            <span>Book Inventory</span>
          </a>
        </li>
        <li>
          <a href="Register.php">
            <i class="fa-solid fa-square-plus"></i>
            <span>Register Book</span>
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

    <div class="main--content">
      <div class="header--wrapper">
        <div class="header--title">
          <span>Primary</span>
          <h2>Dashboard</h2>
        </div>

      <div class="header">
        <p><?php echo strtoupper($fname); ?> </p>
        </div>

      <div class="lostitems">
            <h1 class="lost">Borrowed Books</h1>
        </div>

        <div class="returned">
            <h1 class="rbook">Returned Books</h1>
        </div>

        <div class="available">
        <h1 class="avail">Available Books</h1>
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
</div>


    <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>

    <!-- fontawesome icons -->
    <script
      src="https://kit.fontawesome.com/64d29af423.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
