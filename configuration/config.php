<?php

    $username ="root";
    $password ="";
    $servername="localhost";
    $dbname="library";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection Error: ".$conn->connect_error);
    }
?>