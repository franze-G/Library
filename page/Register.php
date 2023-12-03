<?php
include('../configuration/config.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['Author'];
    $genre = $_POST['genre'];
    $quantity = $_POST['qty'];
    $pdate = $_POST['pdate'];

    // Check if the "image" key is set in the $_FILES array
    if (isset($_FILES["image"])) {
        // File Upload Handling
        $uploadDirectory = "../Image/";
        $uploadedFilename = "image" . uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetPath = $uploadDirectory . $uploadedFilename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            // Image uploaded successfully, you can now use $targetPath in your database query
            $sql = "INSERT INTO `book`(`title`, `author`, `genre`, `date_publish`, `quantity`, `status`, `image`)
                    VALUES ('$title', '$author', '$genre', '$pdate', '$quantity', 'registered', '$targetPath')";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                echo "Record successfully submitted.";
                // Optionally, you can redirect after a delay
                // or provide a link/button to go back to the inventory page
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "No image selected.";
    }
}
?>


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
          <form id="" action="" method="post">
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
                type="text"
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
