<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "hcmut_ssps";

    $connection = mysqli_connect($serverName,$userName,$password,$database);

    if (!$connection){
        die ("Connection failed:" . mysqli_connect_error());
    }
?>