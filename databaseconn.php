<?php

    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    $dbname  = "testdbs1";

    $conn=mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

?>