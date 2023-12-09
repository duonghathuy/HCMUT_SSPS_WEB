<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    
    $configurationQuery = "SELECT * FROM configuration";
    $configurationResult = mysqli_query($connection,$configurationQuery);
    $configurationData = mysqli_fetch_assoc($configurationResult);
?>