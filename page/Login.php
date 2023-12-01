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
          <form id="LoginForm" action="#">
            <div class="field input-field">
              <input
                id="email-login"
                type="text"
                class="input"
                placeholder="Email"
              />
            </div>

            <div class="field input-field">
              <input
                id="password-login"
                type="password"
                class="password"
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
              >Already have an account?
              <a href="/tunesc-vs/pages/Register.html" class="link signup-link">
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
