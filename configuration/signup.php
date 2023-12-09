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
                  WHERE (`fullname` = '$fname' OR `student_number` = '$studentno')";

      $checkResult = $conn->query($checkSql);

      if ($checkResult->num_rows > 0) {
          echo "Account Already Exists.";
      } else {
          // Insert user data into 'user' table with 'pending' status
          $userSql = "INSERT INTO `user` (`fullname`, `student_number`, `email`, `course`, `approval_status`, `user_type`)
                      VALUES ('$fname', '$studentno', '$email', '$course', '$approvalStatus', '$type')";

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