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
          <a href="#">
            <i class="fa-solid fa-calendar-day"></i>
            <span>Calendar</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa-solid fa-chart-area"></i>
            <span>Statistics</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa-solid fa-toolbox"></i>
            <span>Settings</span>
          </a>
        </li>
        <li class="logout" id="SignoutBtn">
          <a href="#">
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
        <div class="user--info">
          <div class="search--box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search" />
          </div>
          <!-- lagay galing firebase yung user image or sa spotify -->
          <img src="spot_picture" alt="" />
        </div>
      </div>

      <div class="card--container">
        <h3 class="main--title">Today's mood</h3>
        <div class="card--wrapper">
          <!-- puro placeholder lang muna -->
          <div class="payment--card">
            <div class="card--header">
              <div class="amount">
                <span class="title">Happy</span>
                <span class="amount-value">Test</span>
              </div>
              <i class="fa-solid fa-face-smile-beam"></i>
            </div>
            <span class="card-detail">Click Me</span>
          </div>
        </div>
      </div>
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
