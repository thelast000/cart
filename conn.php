<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "shopcart";

    $conn = mysqli_connect($server,$user, $pass, $db);

    if(!$conn){
        die("Sql Connection Error" . mysqli_errno($conn));
    }

?>