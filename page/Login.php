<?php   
    //default account:
    //202119379 - username
    //admin - password

    //binago ko structure ng table dreiii kaya drop mo yung recent tas import mo yung mga bago pero same parin ng DB name "library". inupload ko sa SQL folder

    // current function (LOGIN, SIGNUP, ACCOUNT MANAGEMENT, ADD BOOK, BORROW - la pa backend hehe)
    // test mo yung sign up tas login ka gamit yung default account

    include('../configuration/config.php');

    $msg = '';

    if (isset($_COOKIE['token'])) {
    $id = $_COOKIE['token'];
    $sql = "SELECT * FROM account WHERE id=$id";
    if ($rs = $conn->query($sql)) {
        $row = $rs->fetch_assoc();
        $usertype = $row['user_type'];
        $userid = $row['id'];
        switch ($usertype) {
            case 1:
                header("location:Dashboard.php");
                break;
            case 2:
                header("location:");
                break;
        }
    } else {
        header("location:logout.php");
    }
} else {
    echo $conn->error;
}

    if (isset($_POST['idnum'], $_POST['password'])) {
    $UN = $_POST['idnum'];

    $sql = "SELECT * FROM account WHERE username=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $UN);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (md5($_POST['password']) === $row['pass']) {
                    $usertype = $row['user_type'];
                    $userid = $row['id'];
                    setcookie('token', $userid);
                    switch ($usertype) {
                        case 1:
                            header("location:Dashboard.php");
                            exit();
                        case 2:
                            header("location:");
                            exit();
                    }
                } else {
                    $msg = 'Invalid password';
                }
            } else {
                $msg = 'Invalid username';
            }
        } else {
            echo $conn->error;
        }
        $stmt->close();
    } else {
        echo $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/login.css" />
    <!-- icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Signin</title>
  </head>
  <body>
    <section class="container formuh">
      <!-- sign in -->
      <div class="cont-form login">
        <div class="form-content">
          <header>Aklat-Aklatan</header>
          <form id="" action="#" method="post">
            <div class="field input-field">
              <input
                id="idnum"
                type="text"
                class="input"
                name="idnum"
                placeholder="ID Number"
              />
            </div>

            <div class="field input-field">
              <input
                id="password-login"
                type="password"
                class="password"
                name ="password"
                placeholder="Password"
              />
              <i class="bx bx-hide eye-icon"></i>
            </div>

            <div class="form-link">
              <a class="forgot-pass">Forgot password?</a>
            </div>

            <div class="field button-field">
              <!-- type="submit"-->
              <button type="submit">Signin</button>
            </div>
          </form>
          <div class="form-link">
            <span
              >Not registered?
              <a href="signup.php" class="link signup-link">
                Signup
              </a>
            </span>
          </div>
        </div>
      </div>
    </section>
    <!-- firebase -->
    <script type="module" src="/tunesc-vs/auth/signin.js"></script>
    <script type="module" src="/tunesc-vs/auth/signup.js"></script>
    <!-- showpass -->
    <script src="/tunesc-vs/components/showPass.js"></script>
  </body>
</html>
