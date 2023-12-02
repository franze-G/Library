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
          <a href="#">
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
          <a href="#">
            <i class="fa-solid fa-book"></i>
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

    
    <h2 class="title">Inventory</h2>
        <table class="items" id="table">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                    //php for book items display
                ?>
            </tbody>
        </table>

          <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>

    <!-- fontawesome icons -->
    <script
      src="https://kit.fontawesome.com/64d29af423.js"
      crossorigin="anonymous"
    ></script>

  </body>

  
  <script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>

</html>
