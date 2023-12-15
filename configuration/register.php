<?php
include('config.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['Author'];
    $genre = $_POST['genre'];
    $version = $_POST['version'];
    $type = $_POST['type'];
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

            // Check if a book with the same author already exists
            $checkSql = "SELECT * FROM `book` WHERE `author` = '$author'";
            $checkResult = $conn->query($checkSql);

            if ($checkResult->num_rows > 0) {
                // Author exists, check if the same title exists
                while ($row = $checkResult->fetch_assoc()) {
                    if ($row['title'] === $title) {
                        echo "Book already exist.";
                        exit(); // Exit the script if a matching record is found
                    }
                }
            }

            // Insert book data into 'book' table
            $sql = "INSERT INTO `book`(`title`, `author`, `genre`,`version`,`type`,`date_publish`, `quantity`, `status`, `image`)
                    VALUES ('$title', '$author', '$genre','$version','$type', '$pdate', '$quantity', 'registered', '$targetPath')";

            $result = $conn->query($sql);

            if ($result === TRUE) {
                echo "Record successfully submitted.";

                // Redirect to the book inventory with a delay of 3 seconds
                echo '<meta http-equiv="refresh" content="3;url=../admin/SInventory.php" />';
                exit(); // Ensure that no further code is executed after the redirect
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
