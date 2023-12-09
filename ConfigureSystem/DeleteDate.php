<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $dateId = $_GET['date_id'];
    $deleteQuery = "DELETE FROM refill_dates WHERE date_id = $dateId";
    mysqli_query($connection,$deleteQuery);
?>