<?php
    $username = "root";
    $password = "";
    $servername = "localhost";
    $dbname = "library";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Display connection success message for testing purpose
?>
