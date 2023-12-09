<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $date = $_GET['date'];
    $insertQuery = "INSERT INTO refill_dates (date) VALUES ('$date')";
    mysqli_query($connection,$insertQuery);
?>