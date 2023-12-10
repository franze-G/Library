<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
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
          <form id="" action="../configuration/register.php" method="post" enctype="multipart/form-data">
            <div class="field input-field">
              <input
                id=""
                type="text"
                class="input"
                name="title"
                placeholder="Book Title"
              />
            </div>

            <div class="field input-field">
              <input
                id=""
                type="text"
                name="Author"
                class="input"
                placeholder="Author"
              />
            </div>

            <div class="field input-field">
              <input
                id=""
                type="text"
                name="genre"
                class=""
                placeholder="Genre"
              />
            </div>

            <div class="field input-field">
              <input
                id=""
                type="text"
                name="version"
                class=""
                placeholder="Version"
              />
            </div>
            <div class="field input-field">
              <select name="type"  placeholder="Select type of Book">
                    <option value="" disabled selected>Select type of book</option>
                    <option value="Original">Original</option>
                    <option value="Softcopy">Softcopy</option>
                </select>
            </div>

            <div class="field input-field">
              <input
                id="passwordConf-signup"
                type="date"
                name="pdate"
                class=""
                placeholder="Date of Publish"
              />
            </div>

            <div class="field input-field">
              <input
                id="passwordConf-signup"
                type="number"
                name="qty"
                class=""
                placeholder="Quantity"
              />
            </div>

            <div class="field input-field">
              <input
              type="file"
              name="image"
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
