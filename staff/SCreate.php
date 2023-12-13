<?php
include('../configuration/config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fullname'];
    $studentno = $_POST['studentnum'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $type = 3; // Default user type for student
    $pass = md5($_POST['password']); // Replace with more secure password hashing

    // Default status for a new user is 'pending'
    $approvalStatus = 'pending';

    $checkSql = "SELECT * FROM `user` 
                  WHERE (`fullname` = '$fname' OR `student_number` = '$studentno')";

    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "Account Already Exists.";
    } else {
        // Insert user data into 'user' table with 'pending' status and default user type
        $userSql = "INSERT INTO `user` (`fullname`, `student_number`, `email`, `course`, `approval_status`, `user_type`)
                      VALUES ('$fname', '$studentno', '$email', '$course', '$approvalStatus', '$type')";

        $userResult = $conn->query($userSql);

        // Assuming you have a userId variable that you need to use here
        $userId = $conn->insert_id;

        $accountSql = "INSERT INTO `account` (`id`, `username`, `pass`, `user_type`, `approval_status`)
                       VALUES ('$userId', '$studentno', '$pass', '$type', '$approvalStatus')";

        $accountResult = $conn->query($accountSql);

        if (!$accountResult) {
            echo "Error: " . $accountSql . "<br>" . $conn->error;
        } else {
            echo "Account Created Successfully!";
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
                placeholder="Enter Student Email"
              />
            </div>

            <div class="field input-field">
              <input
                id="email-signup"
                type="number"
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
