<?php
include('../configuration/config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fullname'];
    $studentno = $_POST['studentnum'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $type = $_POST['type'];
    $pass = md5($_POST['password']); // Replace with more secure password hashing

    // Default status for a new user is 'pending'
    $approvalStatus = 'pending';

    $checkSql = "SELECT * FROM `user` 
                WHERE (`fullname` = '$fname' AND `student_number` != '$studentno') 
                AND (`fullname` != '$fname' AND `student_number` = '$studentno')";

    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "Account Already Exist.";
    } else {
        // Insert user data into 'user' table with 'pending' status
        $userSql = "INSERT INTO `user` (`fullname`, `student_number`, `email`, `course`, `approval_status`,`user_type`)
                    VALUES ('$fname', '$studentno', '$email', '$course', '$approvalStatus','$type')";

        $userResult = $conn->query($userSql);

        if ($userResult === TRUE) {
            echo "User record successfully submitted. Awaiting admin approval.";
        } else {
            echo "Error: " . $userSql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/tunesc-vs/styles/login-sign.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- confirm css -->
    <link rel="stylesheet" href="../style/signup.css" />
    <title>Signup</title>
  </head>
  <body>
    <section class="container formuh">
      <!-- signup -->
      <div class="cont-form signup">
        <div class="form-content">
          <header>Create Account</header>
          <form id="" action="" method="post">
            <div class="field input-field">
              <input
                id="name-signup"
                name="fullname"
                type="text"
                class="input"
                placeholder="Enter Fullname"
              />
            </div>

            <div class="field input-field">
              <input
                id="email-signup"
                type="email"
                name="email"
                class="input"
                placeholder="Enter Email"
              />
            </div>

            <div class="field input-field">
              <input
                id="email-signup"
                type="text"
                name="studentnum"
                class="input"
                placeholder="Enter Student number"
              />
            </div>

            <div class="field input-field">
              <input
                id="email-signup"
                type="text"
                name="course"
                class="input"
                placeholder="Enter course"
              />
            </div>

            <div class="field input-field">
              <select name="type"  placeholder="Category of item">
                    <option value="" disabled selected>Select type of user</option>
                    <option value="1">ADMIN</option>
                    <option value="2">STUDENT</option>
                </select>
            </div>

            <div class="field input-field">
              <input
                id="passwordConf-signup"
                type="password"
                name="password"
                class="password"
                placeholder="Enter password"
              />
            </div>

            <div class="field button-field">
              <!-- add type="submit"-->
              <!-- add onclick="RegisterUser(evt)"-->
              <input type="submit" name="submit" value="REGISTER">

            </div>
          </form>
          <div class="form-link">
            <span
              >Already have an account?
              <a href="Login.php" class="link signup-link">Signin</a>
            </span>
          </div>
        </div>
      </div>
    </section>

    <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>

    <!-- show-hide pwd -->
    <script src="/tunesc-vs/components/showPass.js"></script>
  </body>
</html>
