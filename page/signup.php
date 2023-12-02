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
          <form id="RegisForm">
            <div class="field input-field">
              <input
                id="name-signup"
                type="text"
                class="input"
                placeholder="Display Name"
              />
            </div>

            <div class="field input-field">
              <input
                id="email-signup"
                type="email"
                class="input"
                placeholder="Email"
              />
            </div>

            <div class="field input-field">
              <input
                id="password-signup"
                type="password"
                class="password"
                placeholder="Create new password"
              />
              <i class="bx bx-hide eye-icon"></i>
            </div>

            <div class="field input-field">
              <input
                id="passwordConf-signup"
                type="password"
                class="password"
                placeholder="Confirm password"
              />
            </div>

            <div class="field button-field">
              <!-- add type="submit"-->
              <!-- add onclick="RegisterUser(evt)"-->
              <button id="btnConfirm" type="submit">Signup</button>
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
