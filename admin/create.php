<?php
  include('../configuration/config.php');

  if (isset($_POST['submit'])) {
      $fname = $_POST['fullname'];
      $idnumber = $_POST['idnumber'];
      $email = $_POST['email'];
      $department = $_POST['department'];
      $type = $_POST['type'];
      $pass = md5($_POST['password']); // Replace with more secure password hashing

      // Default status for a new user is 'pending'
      $approvalStatus = 'pending';

      $checkSql = "SELECT * FROM `user` 
                  WHERE (`fullname` = '$fname' OR `student_number` = '$idnumber')";

      $checkResult = $conn->query($checkSql);

      if ($checkResult->num_rows > 0) {
          echo "Account Already Exists.";
      } else {
          // Insert user data into 'user' table with 'pending' status
          $adminSql = "INSERT INTO `admin` (`fullname`, `id_number`, `email`, `department`, `approval_status`, `user_type` )
                      VALUES ('$fname', '$idnumber', '$email', '$department', '$approvalStatus', '$type')";

          $adminResult = $conn->query($adminSql);

          if ($adminResult === TRUE) {
              echo "User record successfully submitted. Awaiting admin approval.";

              $userId = $conn->insert_id;

              $accountSql = "INSERT INTO 'account' (`id`,`username`,`pass`,`user_type`,`approval_status`)
              VALUES ('$userId','$idnumber','$pass','$type','$approvalStatus')";
          } else {
              echo "Error: " . $adminSql . "<br>" . $conn->error;
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
                type="number"
                name="idnumber"
                class="input"
                placeholder="Enter ID number"
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
                name="department"
                class="input"
                placeholder="Enter Department"
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

            <div class="field input-field">
              <select name="type"  placeholder="Category of item">
                    <option value="" disabled selected>Select type of user</option>
                    <option value="1">ADMIN</option>
                    <option value="2">STAFF</option>
                </select>

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


