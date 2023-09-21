<?php
    date_default_timezone_set('Asia/Bangkok');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chicken_farm";

    $conn = mysqli_connect(
        $servername, 
        $username, 
        $password, 
        $dbname
    );

    if(!$conn){
        die("connection feiled" .mysqli_connect_error());
 }
    //echo "Connected successfully";
